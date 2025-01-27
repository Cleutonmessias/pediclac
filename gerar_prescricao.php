<?php
require_once 'calculos.php';

if (!isset($_POST['doenca']) || !isset($_POST['peso'])) {
    exit('Parâmetros insuficientes');
}

$doenca = $_POST['doenca'];
$peso = floatval($_POST['peso']);
$idade = $_POST['idade'] ?? '';

// Gerar a prescrição usando a classe PrescricoesPadrao
$prescricao = PrescricoesPadrao::gerarPrescricao($doenca, $peso);

// Formatar a prescrição para HTML
echo nl2br(htmlspecialchars($prescricao)); 