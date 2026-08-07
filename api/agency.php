<?php
declare(strict_types=1);
require dirname(__DIR__) . '/_app/bootstrap.php';

try {
    $data = request_json();
    $company = require_field($data, 'company', 'Imobiliária / empresa', 160);
    $name = require_field($data, 'name', 'Responsável', 120);
    $whatsapp = require_field($data, 'whatsapp', 'WhatsApp', 40);
    $region = require_field($data, 'region', 'Região de atuação', 180);
    $roleTitle = field($data, 'role_title', 120);
    $email = field($data, 'email', 180);
    $portfolio = field($data, 'portfolio_profile', 1200);
    $teamSize = field($data, 'team_size', 60);
    $integrationInterest = field($data, 'integration_interest', 60);
    $consent = field($data, 'consent', 10) === '1';

    if (!$consent) {
        json_response(['ok' => false, 'error' => 'A autorização de contato é obrigatória.'], 422);
    }

    $stmt = db()->prepare('INSERT INTO agency_leads (company, contact_name, role_title, whatsapp, email, region, portfolio_profile, team_size, integration_interest, source, consent_at, ip_address, user_agent, created_at) VALUES (:company,:contact_name,:role_title,:whatsapp,:email,:region,:portfolio_profile,:team_size,:integration_interest,:source,NOW(),:ip,:ua,NOW())');
    $stmt->execute([
        ':company' => $company,
        ':contact_name' => $name,
        ':role_title' => $roleTitle ?: null,
        ':whatsapp' => $whatsapp,
        ':email' => $email ?: null,
        ':region' => $region,
        ':portfolio_profile' => $portfolio ?: null,
        ':team_size' => $teamSize ?: null,
        ':integration_interest' => $integrationInterest ?: null,
        ':source' => field($data, 'source', 60) ?: 'landing_agency',
        ':ip' => client_ip(),
        ':ua' => mb_substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 500),
    ]);

    json_response(['ok' => true], 201);
} catch (Throwable $e) {
    error_log('[imobidata agency] ' . $e->getMessage());
    json_response(['ok' => false, 'error' => 'Não foi possível registrar a imobiliária agora.'], 500);
}
