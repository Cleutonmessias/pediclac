<?php
require_once 'config.php';
require_once 'calculos.php';

// Função para obter medicamentos com suas categorias
function getMedicamentos($conn) {
    $sql = "SELECT m.*, ct.nome as categoria_nome 
            FROM medicamentos m 
            LEFT JOIN categorias_terapeuticas ct ON m.categoria_id = ct.id
            ORDER BY m.principio_ativo";
    return $conn->query($sql);
}

// Função para obter estatísticas
function getEstatisticas($conn) {
    $stats = [];
    
    // Total de medicamentos
    $sql = "SELECT COUNT(*) as total FROM medicamentos";
    $result = $conn->query($sql)->fetch_assoc();
    $stats['total'] = $result['total'];
    
    // Total de medicamentos pediátricos
    $sql = "SELECT COUNT(*) as pediatricos FROM medicamentos WHERE uso_pediatrico = 1";
    $result = $conn->query($sql)->fetch_assoc();
    $stats['pediatricos'] = $result['pediatricos'];
    
    // Medicamentos por categoria
    $sql = "SELECT ct.nome, COUNT(*) as total 
            FROM medicamentos m 
            JOIN categorias_terapeuticas ct ON m.categoria_id = ct.id 
            GROUP BY ct.id";
    $stats['categorias'] = $conn->query($sql);
    
    return $stats;
}

// Função para buscar medicamento por ID ou nome
function buscarMedicamento($conn, $termo) {
    // Preparar a consulta usando ? como placeholder
    $sql = "SELECT m.* FROM medicamentos m 
            WHERE (m.principio_ativo LIKE ? 
            OR m.codigo_catmat LIKE ?)
            AND m.uso_pediatrico = 1 
            ORDER BY m.principio_ativo";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo '<script>
            window.addEventListener("load", function() {
                Swal.fire({
                    title: "Erro no Sistema",
                    html: "<i class=\"fas fa-info-circle me-2\"></i>Ocorreu um erro ao preparar a consulta. Por favor, tente novamente.",
                    icon: "error",
                    confirmButtonColor: "#FF69B4"
                });
            });
        </script>';
        return [];
    }

    // Criar o parâmetro com %
    $search_term = "%{$termo}%";
    
    // Fazer o bind dos parâmetros
    $stmt->bind_param("ss", $search_term, $search_term);
    
    // Executar a consulta
    if (!$stmt->execute()) {
        echo '<script>
            window.addEventListener("load", function() {
                Swal.fire({
                    title: "Erro na Execução",
                    html: "<i class=\"fas fa-info-circle me-2\"></i>Não foi possível realizar a busca no momento. Por favor, tente novamente.",
                    icon: "error",
                    confirmButtonColor: "#FF69B4"
                });
            });
        </script>';
        return [];
    }
    
    // Obter o resultado
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        echo '<script>
            window.addEventListener("load", function() {
                Swal.fire({
                    title: "Medicamento Não Encontrado",
                    html: "<i class=\"fas fa-info-circle me-2\"></i>Nenhum medicamento pediátrico encontrado com este nome. Por favor, verifique se este medicamento é recomendado para uso em crianças.",
                    icon: "warning",
                    confirmButtonColor: "#FF69B4"
                });
            });
        </script>';
        return [];
    }

    // Retornar todos os resultados
    return $result->fetch_all(MYSQLI_ASSOC);
}

$mensagem = '';
$resultados = null;
$prescricao = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['busca'])) {
        $resultados = buscarMedicamento($conn, $_POST['busca']);
    }
    
    if (isset($_POST['gerar_prescricao'])) {
        $med_id = $_POST['medicamento_id'];
        $peso = floatval($_POST['peso']);
        
        $sql = "SELECT * FROM medicamentos WHERE id = " . intval($med_id);
        $med = $conn->query($sql)->fetch_assoc();
        
        if ($med) {
            $dose = CalculadoraDoses::calcularDose($peso, $med['concentracao'], $med);
            $prescricao = "USO ORAL\n\n";
            $prescricao .= "1) " . strtoupper($med['principio_ativo']) . "\n";
            $prescricao .= "    " . $med['concentracao'] . " - " . $med['forma_farmaceutica'] . "\n";
            $prescricao .= "    " . $dose . "\n";
            $prescricao .= "\nPeso do paciente: " . $peso . " kg\n";
            
            // Adiciona observações específicas para cada tipo de medicamento
            $prescricao .= "\nObservações:\n";
            if (stripos($med['principio_ativo'], 'amoxicilina') !== false || 
                stripos($med['principio_ativo'], 'azitromicina') !== false) {
                $prescricao .= "- Completar TODO o tratamento conforme prescrito\n";
                $prescricao .= "- Tomar preferencialmente em jejum\n";
            }
            if (stripos($med['principio_ativo'], 'ibuprofeno') !== false) {
                $prescricao .= "- Tomar após as refeições\n";
                $prescricao .= "- Não usar por mais de 3 dias sem orientação médica\n";
            }
            
            // Observações gerais
            $prescricao .= "- Manter em local fresco e ao abrigo da luz\n";
            $prescricao .= "- Agitar bem antes de usar\n";
            $prescricao .= "- Em caso de sintomas graves, procure atendimento médico\n";
            
            // Adiciona data da prescrição
            $prescricao .= "\nData: " . date("d/m/Y");
        }
    }

    // Processar prescrição padrão
    if (isset($_POST['prescricao_padrao']) && !empty($_POST['prescricao_padrao'])) {
        $prescricao = PrescricoesPadrao::gerarPrescricao($_POST['prescricao_padrao']);
    }
}

$medicamentos = getMedicamentos($conn);
$estatisticas = getEstatisticas($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PediCalc - Calculadora de Medicamentos Pediátricos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="styles.css?v=<?php echo time(); ?>" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <!-- Mensagem de Boas-vindas -->
        <div class="welcome-message text-center mb-5">
            <h1 class="display-4 text-primary mb-3">
                <i class="fas fa-stethoscope me-2"></i>
                Bem-vindo ao PediCalc!
            </h1>
            <p class="lead">
                Calcule doses pediátricas de forma rápida e segura
                <i class="fas fa-heart text-danger ms-2"></i>
            </p>
        </div>

        <!-- Formulário de Busca -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-search me-2"></i>
                    Encontre o Medicamento ou Prescrição
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" class="mt-4">
                            <div class="search-box">
                                <i class="fas fa-pills search-icon"></i>
                                <input type="text" name="busca" class="form-control search-input" 
                                       placeholder="Digite o nome do medicamento..." 
                                       autocomplete="off">
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>
                                    Buscar Medicamento
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mt-3">
                            <span class="input-group-text">📋</span>
                            <select id="grupo-doencas" class="form-select" onchange="buscarDoencas(this.value)">
                                <option value="">Selecione um grupo de doenças...</option>
                                <option value="respiratorias">Infecções Respiratórias</option>
                                <option value="gastrointestinais">Doenças Gastrointestinais</option>
                                <option value="dermatologicas">Condições Dermatológicas</option>
                                <option value="neurologicas">Problemas Neurológicos</option>
                                <option value="infecciosas">Doenças Infecciosas e Febris</option>
                                <option value="ortopedicas">Condições Ortopédicas e Traumáticas</option>
                                <option value="outras">Outras Condições Pediátricas</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Área para resultados das doenças -->
                <div id="resultado-doencas" class="mt-4"></div>

                <!-- Área para resultados de medicamentos -->
                <div id="resultado" class="mt-4"></div>

                <!-- Área para prescrição -->
                <div class="prescricao mt-3"></div>
            </div>
        </div>

        <?php if ($resultados && count($resultados) > 0): ?>
        <!-- Resultados da Busca -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-list me-2"></i>
                    Medicamentos Encontrados
                    <span class="badge bg-primary ms-2"><?php echo count($resultados); ?></span>
                </h5>
                <div class="mt-4">
                    <?php foreach ($resultados as $med): ?>
                    <div class="result-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box">
                                <i class="fas fa-capsules"></i>
                            </div>
                            <h6 class="mb-0"><?php echo htmlspecialchars($med['principio_ativo']); ?></h6>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <small class="text-muted">
                                    <i class="fas fa-flask me-1"></i>
                                    Concentração:
                                </small>
                                <p class="mb-0"><?php echo htmlspecialchars($med['concentracao']); ?></p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">
                                    <i class="fas fa-prescription-bottle me-1"></i>
                                    Forma:
                                </small>
                                <p class="mb-0"><?php echo htmlspecialchars($med['forma_farmaceutica']); ?></p>
                            </div>
                            <div class="col-md-4">
                                <form method="POST" class="d-flex align-items-center calculate-form">
                                    <input type="hidden" name="medicamento_id" value="<?php echo $med['id']; ?>">
                                    <div class="input-group">
                                        <input type="number" name="peso" class="form-control weight-input" 
                                               placeholder="Peso" required step="0.1" min="0">
                                        <span class="input-group-text">kg</span>
                                    </div>
                                    <button type="submit" name="gerar_prescricao" class="btn btn-success ms-2" 
                                            data-bs-toggle="tooltip" title="Calcular dose">
                                        <i class="fas fa-calculator"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($prescricao): ?>
        <!-- Prescrição Gerada -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-file-medical me-2"></i>
                    Prescrição Médica
                </h5>
                <div class="prescricao">
                    <?php echo htmlspecialchars($prescricao); ?>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary me-2" onclick="copiarPrescricao()">
                        <i class="fas fa-copy me-2"></i>
                        Copiar Prescrição
                    </button>
                    <button class="btn btn-outline-primary" onclick="location.reload()">
                        <i class="fas fa-redo me-2"></i>
                        Nova Prescrição
                    </button>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($mensagem): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?php echo htmlspecialchars($mensagem); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
    </div>

    <!-- Mascote -->
    <img src="https://cdn-icons-png.flaticon.com/512/2373/2373307.png" alt="Mascote" class="mascote" id="mascote">

    <!-- Loading Overlay -->
    <div class="loading-overlay" style="display: none;">
        <div class="loading"></div>
    </div>

    <!-- Scripts - Mova para o final do body -->
    <script src="scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html> 