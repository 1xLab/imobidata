<?php
declare(strict_types=1);
require dirname(__DIR__) . '/_app/bootstrap.php';

try {
    $data = request_json();
    $name = require_field($data, 'name', 'Nome', 120);
    $whatsapp = require_field($data, 'whatsapp', 'WhatsApp', 40);
    $creci = field($data, 'creci', 60);
    $sourcesRaw = require_field($data, 'source_urls', 'Fontes de anúncios', 12000);
    $indexingAuthorized = field($data, 'indexing_authorization', 10) === '1';
    $consent = field($data, 'consent', 10) === '1';

    if (!$indexingAuthorized) {
        json_response(['ok' => false, 'error' => 'A autorização para analisar as fontes indicadas é obrigatória.'], 422);
    }
    if (!$consent) {
        json_response(['ok' => false, 'error' => 'A autorização de contato é obrigatória.'], 422);
    }

    $parts = preg_split('/[\r\n\t ,;]+/u', $sourcesRaw, -1, PREG_SPLIT_NO_EMPTY) ?: [];
    $urls = [];
    foreach ($parts as $candidate) {
        $candidate = trim($candidate);
        if ($candidate === '') continue;
        if (!preg_match('#^https?://#i', $candidate)) {
            $candidate = 'https://' . $candidate;
        }
        if (!filter_var($candidate, FILTER_VALIDATE_URL)) continue;
        $scheme = strtolower((string) parse_url($candidate, PHP_URL_SCHEME));
        $host = strtolower((string) parse_url($candidate, PHP_URL_HOST));
        if (!in_array($scheme, ['http', 'https'], true) || $host === '') continue;
        $urls[$candidate] = $host;
        if (count($urls) >= 10) break;
    }

    if (!$urls) {
        json_response(['ok' => false, 'error' => 'Informe pelo menos um link válido onde seus imóveis estão publicados.'], 422);
    }

    $db = db();
    $db->beginTransaction();

    try {
        $publicId = 'IDX-' . strtoupper(bin2hex(random_bytes(4)));
        $stmt = $db->prepare('INSERT INTO broker_index_requests (public_id, name, creci, whatsapp, source, status, indexing_authorized_at, consent_at, ip_address, user_agent, created_at, updated_at) VALUES (:public_id,:name,:creci,:whatsapp,:source,\'pending\',NOW(),NOW(),:ip,:ua,NOW(),NOW())');
        $stmt->execute([
            ':public_id' => $publicId,
            ':name' => $name,
            ':creci' => $creci ?: null,
            ':whatsapp' => $whatsapp,
            ':source' => field($data, 'source', 60) ?: 'landing_broker_index',
            ':ip' => client_ip(),
            ':ua' => mb_substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 500),
        ]);

        $requestId = (int) $db->lastInsertId();
        $sourceStmt = $db->prepare('INSERT INTO broker_listing_sources (broker_index_request_id, source_url, source_host, status, created_at, updated_at) VALUES (:request_id,:source_url,:source_host,\'pending\',NOW(),NOW())');

        foreach ($urls as $url => $host) {
            $sourceStmt->execute([
                ':request_id' => $requestId,
                ':source_url' => $url,
                ':source_host' => $host,
            ]);
        }

        $db->commit();
        json_response([
            'ok' => true,
            'id' => $publicId,
            'source_count' => count($urls),
        ], 201);
    } catch (Throwable $e) {
        if ($db->inTransaction()) $db->rollBack();
        throw $e;
    }
} catch (Throwable $e) {
    error_log('[imobidata broker indexing] ' . $e->getMessage());
    json_response(['ok' => false, 'error' => 'Não foi possível registrar as fontes para indexação agora.'], 500);
}
