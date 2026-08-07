<?php
declare(strict_types=1);

function json_response(array $payload, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function request_json(): array
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        json_response(['ok' => false, 'error' => 'Método não permitido.'], 405);
    }

    $contentType = strtolower((string)($_SERVER['CONTENT_TYPE'] ?? ''));
    if (!str_contains($contentType, 'application/json')) {
        json_response(['ok' => false, 'error' => 'Content-Type inválido.'], 415);
    }

    $raw = file_get_contents('php://input') ?: '';
    if (strlen($raw) > 12000) {
        json_response(['ok' => false, 'error' => 'Payload muito grande.'], 413);
    }

    $data = json_decode($raw, true);
    if (!is_array($data)) {
        json_response(['ok' => false, 'error' => 'JSON inválido.'], 400);
    }

    return $data;
}

function field(array $data, string $key, int $max = 255): string
{
    $value = trim((string)($data[$key] ?? ''));
    return mb_substr($value, 0, $max);
}

function require_field(array $data, string $key, string $label, int $max = 255): string
{
    $value = field($data, $key, $max);
    if ($value === '') {
        json_response(['ok' => false, 'error' => "{$label} é obrigatório."], 422);
    }
    return $value;
}

function client_ip(): string
{
    $candidate = (string)($_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? '');
    return mb_substr($candidate, 0, 64);
}

function db(): PDO
{
    static $pdo;
    if ($pdo instanceof PDO) return $pdo;

    $configFile = dirname(__DIR__) . '/_app/config.php';
    if (!is_file($configFile)) {
        throw new RuntimeException('Configuração do banco não encontrada.');
    }
    $config = require $configFile;

    $dsn = sprintf(
        'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
        $config['db_host'] ?? 'localhost',
        (int)($config['db_port'] ?? 3306),
        $config['db_name'] ?? ''
    );

    $pdo = new PDO($dsn, $config['db_user'] ?? '', $config['db_pass'] ?? '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_PERSISTENT => false,
    ]);
    return $pdo;
}
