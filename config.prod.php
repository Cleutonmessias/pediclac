<?php
// Configurações do banco de dados
$db_config = [
    'host' => getenv('DB_HOST'),
    'user' => getenv('DB_USER'),
    'pass' => getenv('DB_PASS'),
    'db'   => getenv('DB_NAME')
];

// Conexão com o banco
$conn = new mysqli(
    $db_config['host'],
    $db_config['user'],
    $db_config['pass'],
    $db_config['db']
);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Define charset
$conn->set_charset("utf8mb4"); 