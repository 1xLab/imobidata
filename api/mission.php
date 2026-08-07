<?php
declare(strict_types=1);
require dirname(__DIR__) . '/_app/bootstrap.php';

try {
    $data = request_json();
    $mission = require_field($data, 'mission', 'Missão', 2200);
    $name = require_field($data, 'name', 'Nome', 120);
    $whatsapp = require_field($data, 'whatsapp', 'WhatsApp', 40);
    $email = field($data, 'email', 180);
    $consent = field($data, 'consent', 10) === '1';

    if (mb_strlen($mission) < 20) json_response(['ok' => false, 'error' => 'Descreva um pouco mais a missão.'], 422);
    if (!$consent) json_response(['ok' => false, 'error' => 'A autorização de contato é obrigatória.'], 422);
    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) json_response(['ok' => false, 'error' => 'E-mail inválido.'], 422);

    $stmt = db()->prepare('INSERT INTO missions (public_id, mission_text, name, whatsapp, email, source, consent_at, ip_address, user_agent, created_at) VALUES (:public_id,:mission_text,:name,:whatsapp,:email,:source,NOW(),:ip,:ua,NOW())');
    $publicId = 'MIS-' . strtoupper(bin2hex(random_bytes(4)));
    $stmt->execute([
        ':public_id' => $publicId,
        ':mission_text' => $mission,
        ':name' => $name,
        ':whatsapp' => $whatsapp,
        ':email' => $email ?: null,
        ':source' => field($data, 'source', 60) ?: 'landing',
        ':ip' => client_ip(),
        ':ua' => mb_substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 500),
    ]);

    json_response(['ok' => true, 'id' => $publicId], 201);
} catch (Throwable $e) {
    error_log('[imobidata mission] ' . $e->getMessage());
    json_response(['ok' => false, 'error' => 'Não foi possível salvar sua missão agora.'], 500);
}
