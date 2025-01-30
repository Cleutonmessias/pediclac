<?php
// Configurações do banco de dados para produção
$db_config = [
    'host' => getenv('DB_HOST'),
    'user' => getenv('DB_USER'),
    'pass' => getenv('DB_PASS'),
    'db'   => getenv('DB_NAME')
];

// Configurações gerais
define('APP_NAME', 'PediCalc');
define('APP_VERSION', '1.0.0');
define('APP_URL', getenv('APP_URL'));
define('APP_TIMEZONE', 'America/Sao_Paulo');

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