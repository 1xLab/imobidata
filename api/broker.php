<?php
declare(strict_types=1);
require dirname(__DIR__) . '/_app/bootstrap.php';

try {
    $data = request_json();
    $name = require_field($data, 'name', 'Nome', 120);
    $whatsapp = require_field($data, 'whatsapp', 'WhatsApp', 40);
    $city = require_field($data, 'city', 'Cidade de atuação', 120);
    $email = field($data, 'email', 180);
    $creci = field($data, 'creci', 60);
    $neighborhoods = field($data, 'neighborhoods', 500);
    $segments = field($data, 'segments', 500);
    $priceRange = field($data, 'price_range', 160);
    $collaboration = field($data, 'collaboration_profile', 1200);
    $consent = field($data, 'consent', 10) === '1';

    if (!$consent) {
        json_response(['ok' => false, 'error' => 'A autorização de contato é obrigatória.'], 422);
    }

    $stmt = db()->prepare('INSERT INTO broker_leads (name, whatsapp, email, creci, city, neighborhoods, segments, price_range, collaboration_profile, source, consent_at, ip_address, user_agent, created_at) VALUES (:name,:whatsapp,:email,:creci,:city,:neighborhoods,:segments,:price_range,:collaboration_profile,:source,NOW(),:ip,:ua,NOW())');
    $stmt->execute([
        ':name' => $name,
        ':whatsapp' => $whatsapp,
        ':email' => $email ?: null,
        ':creci' => $creci ?: null,
        ':city' => $city,
        ':neighborhoods' => $neighborhoods ?: null,
        ':segments' => $segments ?: null,
        ':price_range' => $priceRange ?: null,
        ':collaboration_profile' => $collaboration ?: null,
        ':source' => field($data, 'source', 60) ?: 'landing_broker',
        ':ip' => client_ip(),
        ':ua' => mb_substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 500),
    ]);

    json_response(['ok' => true], 201);
} catch (Throwable $e) {
    error_log('[imobidata broker] ' . $e->getMessage());
    json_response(['ok' => false, 'error' => 'Não foi possível registrar o corretor agora.'], 500);
}
