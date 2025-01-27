<?php
// Iniciar sessão
session_start();

// Carregar configurações
require_once __DIR__ . '/config.php';

// Funções de utilidade
require_once __DIR__ . '/includes/utils.php';

// Funções de cálculo
require_once __DIR__ . '/includes/calculos.php';

// Funções de busca
require_once __DIR__ . '/includes/buscar_doencas.php';

// Verificar e criar diretórios necessários
$directories = [
    LOG_PATH,
    CACHE_PATH,
    UPLOAD_PATH
];

foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Configurar handlers de erro
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        return false;
    }
    
    $error = date('Y-m-d H:i:s') . " [$errno] $errstr in $errfile on line $errline\n";
    error_log($error, 3, LOG_PATH . '/error.log');
    
    if (LOG_LEVEL === 'debug') {
        echo "<pre>$error</pre>";
    }
    
    return true;
});

// Configurar handler de exceções não capturadas
set_exception_handler(function($e) {
    $error = date('Y-m-d H:i:s') . " [Exception] " . $e->getMessage() . 
            " in " . $e->getFile() . " on line " . $e->getLine() . "\n";
    error_log($error, 3, LOG_PATH . '/error.log');
    
    if (LOG_LEVEL === 'debug') {
        echo "<pre>$error</pre>";
    } else {
        echo "Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.";
    }
});

// Função para limpar cache antigo
function cleanOldCache() {
    if (!CACHE_ENABLED) return;
    
    $files = glob(CACHE_PATH . '/*');
    $now = time();
    
    foreach ($files as $file) {
        if (is_file($file)) {
            if ($now - filemtime($file) > CACHE_LIFETIME) {
                unlink($file);
            }
        }
    }
}

// Limpar cache antigo
cleanOldCache();

// Configurar headers de segurança
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
header('Content-Security-Policy: default-src \'self\'; script-src \'self\' \'unsafe-inline\' \'unsafe-eval\' https://cdn.jsdelivr.net https://code.jquery.com; style-src \'self\' \'unsafe-inline\' https://cdn.jsdelivr.net; img-src \'self\' data:; font-src \'self\' https://cdn.jsdelivr.net;');

// Verificar autenticação se necessário
function checkAuth() {
    // Implementar verificação de autenticação se necessário
    return true;
}

// Função para sanitizar entrada
function sanitizeInput($data) {
    global $conn;
    if (is_array($data)) {
        return array_map('sanitizeInput', $data);
    }
    return $conn->real_escape_string(strip_tags(trim($data)));
}

// Função para validar CSRF token
function validateCSRFToken() {
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) ||
        $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Token CSRF inválido');
    }
}

// Gerar CSRF token para formulários
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Função para gerar token CSRF em formulários
function csrfField() {
    return '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
}

// Função para verificar se é uma requisição AJAX
function isAjaxRequest() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

// Função para resposta JSON
function jsonResponse($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
} 