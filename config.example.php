<?php
// Configurações do banco de dados
$db_config = [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'db'   => 'medicamentos_pediatricos'
];

// Configurações gerais
define('APP_NAME', 'PediCalc');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/pedicalc');
define('APP_TIMEZONE', 'America/Sao_Paulo');

// Configurações de email (opcional)
define('MAIL_HOST', 'smtp.example.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'seu-email@example.com');
define('MAIL_PASSWORD', 'sua-senha');
define('MAIL_FROM_ADDRESS', 'noreply@example.com');
define('MAIL_FROM_NAME', 'PediCalc');

// Configurações de segurança
define('SESSION_LIFETIME', 7200); // 2 horas
define('ENCRYPTION_KEY', 'sua-chave-de-criptografia');

// Configurações de log
define('LOG_ENABLED', true);
define('LOG_PATH', __DIR__ . '/logs');
define('LOG_LEVEL', 'debug'); // debug, info, warning, error

// Configurações de cache
define('CACHE_ENABLED', true);
define('CACHE_PATH', __DIR__ . '/cache');
define('CACHE_LIFETIME', 3600); // 1 hora

// Configurações de upload
define('UPLOAD_PATH', __DIR__ . '/uploads');
define('MAX_UPLOAD_SIZE', 5242880); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'pdf']);

// Não modificar após esta linha
date_default_timezone_set(APP_TIMEZONE);
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Criar conexão com o banco de dados
try {
    $conn = new mysqli(
        $db_config['host'],
        $db_config['user'],
        $db_config['pass'],
        $db_config['db']
    );
    
    if ($conn->connect_error) {
        throw new Exception("Falha na conexão: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    error_log($e->getMessage());
    die("Erro ao conectar ao banco de dados. Por favor, tente novamente mais tarde.");
} 