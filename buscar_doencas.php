<?php
require_once 'calculos.php';

if (!isset($_POST['grupo'])) {
    die('Grupo não especificado');
}

$grupo = $_POST['grupo'];

$doencas = [
    'respiratorias' => [
        'titulo' => 'Infecções Respiratórias',
        'items' => [
            'Resfriado comum',
            'Bronquiolite',
            'Laringite estridulosa (crupe)',
            'Pneumonia bacteriana',
            'Pneumonia viral',
            'Asma exacerbada',
            'Sinusite bacteriana',
            'Rinossinusite viral',
            'Faringite estreptocócica',
            'Amigdalite viral',
            'Tuberculose pediátrica',
            'Coqueluche (pertussis)',
            'Corpo estranho em vias aéreas',
            'Epiglotite',
            'Apneia do lactente',
            'Epistaxe (sangramento nasal)',
            'Corpo estranho no nariz'
        ]
    ],
    'gastrointestinais' => [
        'titulo' => 'Doenças Gastrointestinais',
        'items' => [
            'Gastroenterite aguda (viral)',
            'Gastroenterite bacteriana',
            'Intussuscepção',
            'Cólica do lactente',
            'Obstipação intestinal funcional',
            'Refluxo gastroesofágico exacerbado',
            'Desidratação grave',
            'Parasitoses intestinais (oxiúros, giardíase)',
            'Doença celíaca descompensada',
            'Hepatite viral (A, B, ou C)',
            'Alergia à proteína do leite de vaca (APLV)',
            'Síndrome do vômito cíclico',
            'Invaginação intestinal',
            'Apendicite aguda',
            'Perfuração intestinal'
        ]
    ],
    'dermatologicas' => [
        'titulo' => 'Condições Dermatológicas',
        'items' => [
            'Impetigo',
            'Furúnculos',
            'Escabiose (sarna)',
            'Pediculose (piolhos)',
            'Dermatite atópica (eczema)',
            'Urticária aguda',
            'Psoríase pediátrica',
            'Dermatite de contato',
            'Eritema tóxico neonatal',
            'Eritema infeccioso (parvovírus B19)',
            'Miliária (brotoeja)',
            'Pitiríase rósea',
            'Tinea capitis (micose de couro cabeludo)',
            'Candidíase de dobras (área da fralda)',
            'Celulite bacteriana'
        ]
    ],
    'neurologicas' => [
        'titulo' => 'Problemas Neurológicos',
        'items' => [
            'Convulsões febris',
            'Epilepsia diagnosticada',
            'Crises de ausência',
            'Cefaleia tensional',
            'Enxaqueca pediátrica',
            'Meningite viral',
            'Meningite bacteriana',
            'Traumatismo craniano leve',
            'Hematoma subgaleal',
            'Ataxia aguda pós-viral',
            'Encefalite viral',
            'Paralisia facial periférica',
            'Neuralgia pós-trauma',
            'Síndrome de Guillain-Barré',
            'Hidrocefalia descompensada'
        ]
    ],
    'infecciosas' => [
        'titulo' => 'Doenças Infecciosas e Febris',
        'items' => [
            'Dengue',
            'Zika vírus',
            'Chikungunya',
            'Febre sem foco',
            'Sepse neonatal',
            'Sepse pediátrica',
            'Varicela (catapora)',
            'Doença mão-pé-boca',
            'Mononucleose infecciosa',
            'Herpangina',
            'Roseola infantil',
            'Escarlatina',
            'Tétano (casos raros)',
            'Doença de Kawasaki',
            'Síndrome inflamatória multissistêmica pediátrica (PIMS)',
            'Neutropenia febril'
        ]
    ],
    'ortopedicas' => [
        'titulo' => 'Condições Ortopédicas e Traumáticas',
        'items' => [
            'Entorses',
            'Fraturas simples (ex.: antebraço)',
            'Luxações (ombro, cotovelo)',
            'Contusões musculares',
            'Deslocamento do cotovelo (pronation dolorosa)',
            'Osteomielite',
            'Artrite séptica',
            'Doença de Legg-Calvé-Perthes',
            'Sinovite transitória do quadril',
            'Displasia do desenvolvimento do quadril',
            'Escoliose dolorosa',
            'Pé torto congênito',
            'Síndrome do chicote cervical (whiplash)',
            'Corpo estranho em tecidos moles',
            'Abscessos profundos (ex.: abscesso glúteo)'
        ]
    ],
    'outras' => [
        'titulo' => 'Outras Condições Pediátricas',
        'items' => [
            'Conjuntivite viral',
            'Conjuntivite bacteriana',
            'Corpo estranho no ouvido',
            'Vulvovaginite infecciosa',
            'Balanopostite',
            'Hipoglicemia em lactentes',
            'Diabetes tipo 1',
            'Hipotireoidismo',
            'Puberdade precoce',
            'Anemia ferropriva',
            'Púrpura trombocitopênica',
            'Cardiopatias congênitas descompensadas',
            'Sopro cardíaco',
            'Arritmia',
            'Síndrome nefrótica pediátrica'
        ]
    ]
];

if (!isset($doencas[$grupo])) {
    die('Grupo não encontrado');
}

echo '<div class="card shadow-sm mb-4">';
echo '<div class="card-header bg-primary text-white">';
echo '<h5 class="card-title mb-0"><i class="fas fa-folder-open me-2"></i>' . htmlspecialchars($doencas[$grupo]['titulo']) . '</h5>';
echo '</div>';
echo '<div class="card-body">';
echo '<div class="table-responsive">';
echo '<table class="table table-hover">';
echo '<thead class="table-light">';
echo '<tr>';
echo '<th>Doença</th>';
echo '<th class="text-end">Ação</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

foreach ($doencas[$grupo]['items'] as $doenca) {
    echo '<tr>';
    echo '<td class="align-middle">';
    echo '<i class="fas fa-file-medical text-primary me-2"></i>';
    echo htmlspecialchars($doenca);
    echo '</td>';
    echo '<td class="text-end">';
    echo '<button class="btn btn-primary btn-sm" onclick="gerarPrescricaoPadrao(\'' . htmlspecialchars($doenca) . '\')">';
    echo '<i class="fas fa-prescription me-2"></i>Gerar Prescrição';
    echo '</button>';
    echo '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';
echo '</div>';
echo '</div>';

// Adiciona um botão para voltar
echo '<div class="text-center mt-3">';
echo '<button class="btn btn-outline-primary" onclick="window.location.reload()">';
echo '<i class="fas fa-arrow-left me-2"></i>Voltar para Grupos';
echo '</button>';
echo '</div>';
?> 