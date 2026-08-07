<?php
declare(strict_types=1);
require dirname(__DIR__) . '/_app/bootstrap.php';

try {
    $data = request_json();
    $company = require_field($data, 'company', 'Imobiliária / empresa', 160);
    $name = require_field($data, 'name', 'Responsável', 120);
    $whatsapp = require_field($data, 'whatsapp', 'WhatsApp', 40);
    $region = require_field($data, 'region', 'Região de atuação', 180);
    $profile = field($data, 'profile', 600);
    $consent = field($data, 'consent', 10) === '1';
    if (!$consent) json_response(['ok' => false, 'error' => 'A autorização de contato é obrigatória.'], 422);

    $stmt = db()->prepare('INSERT INTO partner_leads (company, contact_name, whatsapp, region, profile, source, consent_at, ip_address, user_agent, created_at) VALUES (:company,:contact_name,:whatsapp,:region,:profile,:source,NOW(),:ip,:ua,NOW())');
    $stmt->execute([
        ':company' => $company,
        ':contact_name' => $name,
        ':whatsapp' => $whatsapp,
        ':region' => $region,
        ':profile' => $profile ?: null,
        ':source' => field($data, 'source', 60) ?: 'landing_partner',
        ':ip' => client_ip(),
        ':ua' => mb_substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 500),
    ]);

    json_response(['ok' => true], 201);
} catch (Throwable $e) {
    error_log('[imobidata partner] ' . $e->getMessage());
    json_response(['ok' => false, 'error' => 'Não foi possível registrar a parceria agora.'], 500);
}
