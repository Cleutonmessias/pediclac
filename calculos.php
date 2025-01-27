<?php

class PrescricoesPadrao {
    public static function gerarPrescricao($doenca, $peso = null, $idade = null) {
        $prescricao = "PRESCRIÇÃO MÉDICA\n\n";
        $prescricao .= "Diagnóstico: " . strtoupper($doenca) . "\n\n";
        
        if ($peso) {
            $prescricao .= "Peso: " . $peso . " kg\n";
        }
        if ($idade) {
            $prescricao .= "Idade: " . $idade . "\n\n";
        }

        switch (strtolower($doenca)) {
            case 'resfriado comum':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.6, 0) : "__") . " GOTAS DE 6/6H SE FEBRE\n\n";
                $prescricao .= "2) IBUPROFENO 50MG/ML GOTAS---------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.4, 0) : "__") . " GOTAS DE 8/8H SE DOR\n\n";
                $prescricao .= "3) SORO FISIOLÓGICO 0,9% NASAL------------------------------- 2 FRASCOS\n";
                $prescricao .= "   PINGAR 2-3 GOTAS EM CADA NARINA 3X AO DIA\n";
                break;

            case 'bronquiolite':
                $prescricao .= "USO INALATÓRIO\n";
                $prescricao .= "1) SALBUTAMOL SPRAY 100MCG/JATO----------------------------- 1 FRASCO\n";
                $prescricao .= "   APLICAR 2 JATOS DE 4/4H SE SIBILÂNCIA\n\n";
                $prescricao .= "USO ORAL\n";
                $prescricao .= "2) PREDNISOLONA 3MG/ML SOLUÇÃO------------------------------ 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.5, 1) : "__") . "ML 1X AO DIA POR 3 DIAS\n";
                break;

            case 'amigdalite bacteriana':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) AMOXICILINA 250MG/5ML SUSPENSÃO-------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.1, 1) : "__") . "ML DE 8/8H POR 10 DIAS\n\n";
                $prescricao .= "2) IBUPROFENO 50MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.4, 0) : "__") . " GOTAS DE 8/8H SE DOR\n\n";
                $prescricao .= "USO IM\n";
                $prescricao .= "3) PENICILINA G BENZATINA----------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . ($peso < 27 ? "600.000UI" : "1.200.000UI") . " IM DOSE ÚNICA\n";
                }
                break;

            case 'dermatite atópica':
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "1) DEXAMETASONA CREME 0,1%--------------------------------- 1 BISNAGA\n";
                $prescricao .= "   APLICAR NAS LESÕES 2X AO DIA POR 5-7 DIAS\n\n";
                $prescricao .= "2) HIDRATANTE HIPOALERGÊNICO------------------------------- 1 FRASCO\n";
                $prescricao .= "   APLICAR NO CORPO TODO 2-3X AO DIA\n\n";
                $prescricao .= "USO ORAL\n";
                $prescricao .= "3) HIDROXIZINA 2MG/ML SOLUÇÃO----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 1) . "ML DE 8/8H SE PRURIDO\n";
                }
                break;

            case 'impetigo':
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "1) MUPIROCINA POMADA 2%------------------------------------ 1 BISNAGA\n";
                $prescricao .= "   APLICAR NAS LESÕES 3X AO DIA POR 7 DIAS\n\n";
                $prescricao .= "USO ORAL\n";
                $prescricao .= "2) CEFALEXINA 250MG/5ML SUSPENSÃO------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.15, 1) . "ML DE 6/6H POR 7 DIAS\n";
                }
                break;

            case 'furúnculos':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) CEFALEXINA 250MG/5ML SUSPENSÃO------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.15, 1) . "ML DE 6/6H POR 7 DIAS\n\n";
                }
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "2) CLOREXIDINA DEGERMANTE 2%------------------------------ 1 FRASCO\n";
                $prescricao .= "   LAVAR AS LESÕES 2X AO DIA\n\n";
                $prescricao .= "3) COMPRESSAS MORNAS-------------------------------------- VÁRIAS\n";
                $prescricao .= "   APLICAR NAS LESÕES 3-4X AO DIA\n";
                break;

            case 'escabiose (sarna)':
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "1) PERMETRINA LOÇÃO 5%------------------------------------- 2 FRASCOS\n";
                $prescricao .= "   APLICAR EM TODO O CORPO (EXCETO CABEÇA) À NOITE E LAVAR APÓS 8-12H\n";
                $prescricao .= "   REPETIR APÓS 7 DIAS\n\n";
                $prescricao .= "USO ORAL\n";
                $prescricao .= "2) IVERMECTINA 6MG COMPRIMIDO----------------------------- 2 COMPRIMIDOS\n";
                if ($peso >= 15) {
                    $prescricao .= "   TOMAR 1 COMPRIMIDO HOJE E REPETIR EM 7 DIAS\n\n";
                } else {
                    $prescricao .= "   TOMAR 1/2 COMPRIMIDO HOJE E REPETIR EM 7 DIAS\n\n";
                }
                $prescricao .= "3) HIDROXIZINA 2MG/ML SOLUÇÃO---------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 1) . "ML DE 8/8H SE PRURIDO\n";
                }
                break;

            case 'pediculose (piolhos)':
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "1) PERMETRINA LOÇÃO 1%------------------------------------- 2 FRASCOS\n";
                $prescricao .= "   APLICAR NO COURO CABELUDO E CABELOS, DEIXAR AGIR POR 10 MINUTOS E LAVAR\n";
                $prescricao .= "   REPETIR APÓS 7 DIAS\n\n";
                $prescricao .= "2) PENTE FINO---------------------------------------------- 1 UNIDADE\n";
                $prescricao .= "   PASSAR NO CABELO MOLHADO DIARIAMENTE POR 7 DIAS\n";
                break;

            case 'pneumonia bacteriana':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) AMOXICILINA 250MG/5ML SUSPENSÃO-------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.15, 1) : "__") . "ML DE 8/8H POR 7-10 DIAS\n\n";
                $prescricao .= "2) DIPIRONA 500MG/ML GOTAS---------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.6, 0) : "__") . " GOTAS DE 6/6H SE FEBRE\n\n";
                $prescricao .= "3) SORO FISIOLÓGICO 0,9% NASAL------------------------------ 2 FRASCOS\n";
                $prescricao .= "   PINGAR 2-3 GOTAS EM CADA NARINA 3X AO DIA\n";
                break;

            case 'pneumonia viral':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS------------------------------ 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.6, 0) : "__") . " GOTAS DE 6/6H SE FEBRE\n\n";
                $prescricao .= "2) SORO FISIOLÓGICO 0,9% NASAL----------------------------- 2 FRASCOS\n";
                $prescricao .= "   PINGAR 2-3 GOTAS EM CADA NARINA 3X AO DIA\n";
                break;

            case 'asma exacerbada':
                $prescricao .= "USO INALATÓRIO\n";
                $prescricao .= "1) SALBUTAMOL SPRAY 100MCG/JATO---------------------------- 1 FRASCO\n";
                $prescricao .= "   APLICAR 2 JATOS DE 4/4H SE SIBILÂNCIA\n\n";
                $prescricao .= "USO ORAL\n";
                $prescricao .= "2) PREDNISOLONA 3MG/ML SOLUÇÃO----------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 1.5, 1) : "__") . "ML 1X AO DIA POR 5 DIAS\n";
                break;

            case 'sinusite bacteriana':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) AMOXICILINA 250MG/5ML SUSPENSÃO------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.15, 1) : "__") . "ML DE 8/8H POR 10 DIAS\n\n";
                $prescricao .= "2) IBUPROFENO 50MG/ML GOTAS------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.4, 0) : "__") . " GOTAS DE 8/8H SE DOR\n\n";
                $prescricao .= "3) SORO FISIOLÓGICO 0,9% NASAL---------------------------- 2 FRASCOS\n";
                $prescricao .= "   PINGAR 2-3 GOTAS EM CADA NARINA 3X AO DIA\n";
                break;

            case 'rinossinusite viral':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS----------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.6, 0) : "__") . " GOTAS DE 6/6H SE FEBRE\n\n";
                $prescricao .= "2) SORO FISIOLÓGICO 0,9% NASAL---------------------------- 2 FRASCOS\n";
                $prescricao .= "   PINGAR 2-3 GOTAS EM CADA NARINA 3X AO DIA\n";
                break;

            case 'faringite estreptocócica':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) AMOXICILINA 250MG/5ML SUSPENSÃO------------------------ 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.15, 1) : "__") . "ML DE 8/8H POR 10 DIAS\n\n";
                $prescricao .= "2) IBUPROFENO 50MG/ML GOTAS------------------------------ 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.4, 0) : "__") . " GOTAS DE 8/8H SE DOR\n\n";
                $prescricao .= "USO IM\n";
                $prescricao .= "3) PENICILINA G BENZATINA--------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . ($peso < 27 ? "600.000UI" : "1.200.000UI") . " IM DOSE ÚNICA\n";
                }
                break;

            case 'amigdalite viral':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS---------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.6, 0) : "__") . " GOTAS DE 6/6H SE FEBRE\n\n";
                $prescricao .= "2) IBUPROFENO 50MG/ML GOTAS----------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.4, 0) : "__") . " GOTAS DE 8/8H SE DOR\n";
                break;

            case 'tuberculose pediátrica':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) RIFAMPICINA + ISONIAZIDA + PIRAZINAMIDA-------------- 1 CAIXA\n";
                if ($peso) {
                    if ($peso < 20) {
                        $prescricao .= "   TOMAR 1 COMPRIMIDO 75/50/150MG 1X AO DIA POR 2 MESES\n";
                    } else if ($peso < 35) {
                        $prescricao .= "   TOMAR 2 COMPRIMIDOS 75/50/150MG 1X AO DIA POR 2 MESES\n";
                    } else {
                        $prescricao .= "   TOMAR 3 COMPRIMIDOS 75/50/150MG 1X AO DIA POR 2 MESES\n";
                    }
                }
                $prescricao .= "\n2) RIFAMPICINA + ISONIAZIDA---------------------------- 1 CAIXA\n";
                if ($peso) {
                    if ($peso < 20) {
                        $prescricao .= "   TOMAR 1 COMPRIMIDO 75/50MG 1X AO DIA POR 4 MESES\n";
                    } else if ($peso < 35) {
                        $prescricao .= "   TOMAR 2 COMPRIMIDOS 75/50MG 1X AO DIA POR 4 MESES\n";
                    } else {
                        $prescricao .= "   TOMAR 3 COMPRIMIDOS 75/50MG 1X AO DIA POR 4 MESES\n";
                    }
                }
                break;

            case 'coqueluche':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) AZITROMICINA 200MG/5ML SUSPENSÃO------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.125, 1) : "__") . "ML 1X AO DIA POR 5 DIAS\n\n";
                $prescricao .= "2) PREDNISOLONA 3MG/ML SOLUÇÃO----------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.5, 1) : "__") . "ML 1X AO DIA POR 5 DIAS\n\n";
                $prescricao .= "3) SALBUTAMOL SPRAY 100MCG/JATO---------------------------- 1 FRASCO\n";
                $prescricao .= "   APLICAR 2 JATOS DE 4/4H SE SIBILÂNCIA\n";
                break;

            case 'corpo estranho em vias aéreas':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) NÃO TENTAR REMOVER O CORPO ESTRANHO EM CASA\n";
                $prescricao .= "3) MANTER CALMA E OBSERVAR SINAIS DE DIFICULDADE RESPIRATÓRIA\n";
                break;

            case 'epiglotite':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) MANTER PACIENTE SENTADO\n";
                $prescricao .= "3) NÃO MANIPULAR OROFARINGE\n\n";
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) CEFTRIAXONA 1G------------------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 50, 0) . "MG EV 12/12H\n";
                }
                $prescricao .= "\n2) DEXAMETASONA 4MG/ML------------------------------------- 1 AMPOLA\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 0.15, 1) . "ML EV 6/6H\n";
                }
                break;

            case 'apneia do lactente':
                $prescricao .= "CONDUTA:\n";
                $prescricao .= "1) MONITORIZAÇÃO CARDIORRESPIRATÓRIA CONTÍNUA\n";
                $prescricao .= "2) POSICIONAMENTO ADEQUADO DURANTE O SONO\n";
                $prescricao .= "3) EVITAR EXPOSIÇÃO AO FUMO\n\n";
                $prescricao .= "USO ORAL (SE INDICADO)\n";
                $prescricao .= "1) CAFEÍNA BASE 20MG/ML------------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.25, 1) . "ML 1X AO DIA\n";
                }
                break;

            case 'gastroenterite aguda (viral)':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) SORO DE REIDRATAÇÃO ORAL--------------------------------- 2 ENVELOPES\n";
                $prescricao .= "   DILUIR 1 ENVELOPE EM 1L DE ÁGUA FILTRADA E OFERECER APÓS CADA EVACUAÇÃO\n\n";
                $prescricao .= "2) ONDANSETRONA 4MG/ML SOLUÇÃO----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.15, 1) . "ML DE 8/8H SE VÔMITOS\n";
                }
                break;

            case 'gastroenterite bacteriana':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) SORO DE REIDRATAÇÃO ORAL--------------------------------- 2 ENVELOPES\n";
                $prescricao .= "   DILUIR 1 ENVELOPE EM 1L DE ÁGUA FILTRADA E OFERECER APÓS CADA EVACUAÇÃO\n\n";
                $prescricao .= "2) AZITROMICINA 200MG/5ML SUSPENSÃO------------------------ 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.125, 1) : "__") . "ML 1X AO DIA POR 3 DIAS\n\n";
                $prescricao .= "3) ONDANSETRONA 4MG/ML SOLUÇÃO----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.15, 1) . "ML DE 8/8H SE VÔMITOS\n";
                }
                break;

            case 'cólica do lactente':
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) MASSAGEM ABDOMINAL SUAVE\n";
                $prescricao .= "2) POSIÇÃO VERTICAL APÓS MAMADAS\n";
                $prescricao .= "3) COMPRESSAS MORNAS NO ABDOME\n\n";
                $prescricao .= "USO ORAL (SE NECESSÁRIO)\n";
                $prescricao .= "1) SIMETICONA GOTAS 75MG/ML--------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR 5 GOTAS ANTES DAS MAMADAS\n";
                break;

            case 'obstipação intestinal funcional':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) LACTULOSE 667MG/ML XAROPE------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.07, 1) . "ML 2X AO DIA\n";
                }
                $prescricao .= "\nMEDIDAS GERAIS:\n";
                $prescricao .= "1) AUMENTAR INGESTÃO DE LÍQUIDOS\n";
                $prescricao .= "2) AUMENTAR CONSUMO DE FIBRAS\n";
                $prescricao .= "3) ESTABELECER HORÁRIO REGULAR PARA EVACUAR\n";
                break;

            case 'refluxo gastroesofágico exacerbado':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) DOMPERIDONA 1MG/ML SUSPENSÃO---------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.25, 1) . "ML 3X AO DIA ANTES DAS REFEIÇÕES\n\n";
                }
                $prescricao .= "2) RANITIDINA 15MG/ML XAROPE------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.13, 1) . "ML 2X AO DIA\n";
                }
                break;

            case 'desidratação grave':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) INICIAR HIDRATAÇÃO VENOSA\n\n";
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) SORO FISIOLÓGICO 0,9%------------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   INFUNDIR " . number_format($peso * 20, 0) . "ML/KG NA 1ª HORA\n";
                }
                break;

            case 'parasitoses intestinais':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) ALBENDAZOL 400MG COMPRIMIDO----------------------------- 1 COMPRIMIDO\n";
                if ($peso >= 10) {
                    $prescricao .= "   TOMAR 1 COMPRIMIDO DOSE ÚNICA\n\n";
                } else {
                    $prescricao .= "   TOMAR 1/2 COMPRIMIDO DOSE ÚNICA\n\n";
                }
                $prescricao .= "2) METRONIDAZOL 40MG/ML SUSPENSÃO-------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.25, 1) . "ML DE 8/8H POR 5 DIAS\n";
                }
                break;

            case 'doença celíaca descompensada':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PROBIÓTICO SACHÊ----------------------------------------- 1 CAIXA\n";
                $prescricao .= "   TOMAR 1 SACHÊ 1X AO DIA\n\n";
                $prescricao .= "2) POLIVITAMÍNICO GOTAS------------------------------------ 1 FRASCO\n";
                $prescricao .= "   TOMAR 10 GOTAS 1X AO DIA\n\n";
                $prescricao .= "MEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) DIETA TOTALMENTE ISENTA DE GLÚTEN\n";
                $prescricao .= "2) CONSULTA COM NUTRICIONISTA\n";
                break;

            case 'hepatite viral':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) ONDANSETRONA 4MG/ML SOLUÇÃO----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.15, 1) . "ML DE 8/8H SE VÔMITOS\n\n";
                }
                $prescricao .= "2) PARACETAMOL 200MG/ML GOTAS----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n";
                }
                $prescricao .= "\nMEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) REPOUSO RELATIVO\n";
                $prescricao .= "2) DIETA LEVE E FRACIONADA\n";
                $prescricao .= "3) EVITAR MEDICAMENTOS HEPATOTÓXICOS\n";
                break;

            case 'alergia à proteína do leite de vaca':
                $prescricao .= "CONDUTA NUTRICIONAL:\n";
                $prescricao .= "1) FÓRMULA EXTENSAMENTE HIDROLISADA------------------------ 4 LATAS\n";
                if ($peso) {
                    $prescricao .= "   OFERECER " . number_format($peso * 150 / 100, 0) . "ML A CADA 3 HORAS\n";
                }
                $prescricao .= "\nMEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) EXCLUSÃO TOTAL DE LEITE E DERIVADOS\n";
                $prescricao .= "2) CONSULTA COM NUTRICIONISTA\n";
                $prescricao .= "3) LEITURA ATENTA DOS RÓTULOS\n";
                break;

            case 'síndrome do vômito cíclico':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) ONDANSETRONA 4MG/ML SOLUÇÃO----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.15, 1) . "ML DE 8/8H SE VÔMITOS\n\n";
                }
                $prescricao .= "2) OMEPRAZOL 2MG/ML SUSPENSÃO----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.7, 1) . "ML 1X AO DIA EM JEJUM\n";
                }
                break;

            case 'invaginação intestinal':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) JEJUM ABSOLUTO\n";
                $prescricao .= "3) ACESSO VENOSO\n\n";
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) SORO FISIOLÓGICO 0,9%----------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   INFUNDIR " . number_format($peso * 20, 0) . "ML/KG/HORA\n";
                }
                break;

            case 'apendicite aguda':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) JEJUM ABSOLUTO\n";
                $prescricao .= "3) AVALIAÇÃO CIRÚRGICA\n\n";
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) CEFTRIAXONA 1G------------------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 50, 0) . "MG EV 12/12H\n\n";
                }
                $prescricao .= "2) METRONIDAZOL 5MG/ML------------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   INFUNDIR " . number_format($peso * 7.5, 0) . "MG/KG EV 8/8H\n";
                }
                break;

            case 'perfuração intestinal':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) JEJUM ABSOLUTO\n";
                $prescricao .= "3) AVALIAÇÃO CIRÚRGICA\n\n";
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) CEFTRIAXONA 1G------------------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 50, 0) . "MG EV 12/12H\n\n";
                }
                $prescricao .= "2) METRONIDAZOL 5MG/ML------------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   INFUNDIR " . number_format($peso * 7.5, 0) . "MG/KG EV 8/8H\n\n";
                }
                $prescricao .= "3) MORFINA 10MG/ML---------------------------------------- 1 AMPOLA\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 0.05, 2) . "ML EV 4/4H SE DOR\n";
                }
                break;

            case 'urticária aguda':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) DESLORATADINA 0,5MG/ML SOLUÇÃO-------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.1, 1) . "ML 1X AO DIA POR 5-7 DIAS\n\n";
                }
                $prescricao .= "2) PREDNISOLONA 3MG/ML SOLUÇÃO---------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.5, 1) . "ML 1X AO DIA POR 3-5 DIAS\n";
                }
                break;

            case 'psoríase pediátrica':
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "1) BETAMETASONA POMADA 0,1%-------------------------------- 1 BISNAGA\n";
                $prescricao .= "   APLICAR NAS LESÕES 2X AO DIA\n\n";
                $prescricao .= "2) HIDRATANTE CORPORAL UREIA 10%-------------------------- 1 FRASCO\n";
                $prescricao .= "   APLICAR NO CORPO TODO 2X AO DIA\n\n";
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) EXPOSIÇÃO SOLAR MODERADA\n";
                $prescricao .= "2) BANHOS CURTOS E MORNOS\n";
                break;

            case 'dermatite de contato':
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "1) DEXAMETASONA CREME 0,1%--------------------------------- 1 BISNAGA\n";
                $prescricao .= "   APLICAR NAS LESÕES 2X AO DIA POR 5-7 DIAS\n\n";
                $prescricao .= "USO ORAL\n";
                $prescricao .= "2) HIDROXIZINA 2MG/ML SOLUÇÃO----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 1) . "ML DE 8/8H SE PRURIDO\n";
                }
                break;

            case 'eritema tóxico neonatal':
                $prescricao .= "CONDUTA:\n";
                $prescricao .= "1) CONDIÇÃO BENIGNA E AUTOLIMITADA\n";
                $prescricao .= "2) APENAS OBSERVAÇÃO CLÍNICA\n";
                $prescricao .= "3) EVITAR MEDICAÇÕES TÓPICAS\n\n";
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) BANHOS CURTOS COM ÁGUA MORNA\n";
                $prescricao .= "2) ROUPAS LEVES DE ALGODÃO\n";
                break;

            case 'eritema infeccioso (parvovírus b19)':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) REPOUSO RELATIVO\n";
                $prescricao .= "2) HIDRATAÇÃO ORAL ADEQUADA\n";
                $prescricao .= "3) ISOLAMENTO NÃO NECESSÁRIO\n";
                break;

            case 'miliária (brotoeja)':
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) BANHOS FRESCOS\n";
                $prescricao .= "2) ROUPAS LEVES DE ALGODÃO\n";
                $prescricao .= "3) AMBIENTE VENTILADO\n\n";
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "1) LOÇÃO DE CALAMINA-------------------------------------- 1 FRASCO\n";
                $prescricao .= "   APLICAR NAS LESÕES 3X AO DIA\n";
                break;

            case 'pitiríase rósea':
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) CONDIÇÃO AUTOLIMITADA\n";
                $prescricao .= "2) EVITAR CALOR EXCESSIVO\n";
                $prescricao .= "3) ROUPAS LEVES\n\n";
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) HIDROXIZINA 2MG/ML SOLUÇÃO----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 1) . "ML DE 8/8H SE PRURIDO\n";
                }
                break;

            case 'tinea capitis (micose de couro cabeludo)':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) TERBINAFINA 250MG COMPRIMIDO-------------------------- 1 CAIXA\n";
                if ($peso >= 40) {
                    $prescricao .= "   TOMAR 1 COMPRIMIDO 1X AO DIA POR 4 SEMANAS\n";
                } else if ($peso >= 20) {
                    $prescricao .= "   TOMAR 1/2 COMPRIMIDO 1X AO DIA POR 4 SEMANAS\n";
                } else {
                    $prescricao .= "   TOMAR 1/4 COMPRIMIDO 1X AO DIA POR 4 SEMANAS\n";
                }
                $prescricao .= "\nUSO TÓPICO\n";
                $prescricao .= "2) CETOCONAZOL SHAMPOO 2%-------------------------------- 1 FRASCO\n";
                $prescricao .= "   LAVAR O COURO CABELUDO 2X POR SEMANA\n";
                break;

            case 'candidíase de dobras (área da fralda)':
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "1) NISTATINA CREME 100.000UI/G---------------------------- 1 BISNAGA\n";
                $prescricao .= "   APLICAR NAS LESÕES A CADA TROCA DE FRALDA\n\n";
                $prescricao .= "2) ÓXIDO DE ZINCO POMADA---------------------------------- 1 BISNAGA\n";
                $prescricao .= "   APLICAR APÓS A NISTATINA PARA PROTEÇÃO\n\n";
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) TROCAS FREQUENTES DE FRALDA\n";
                $prescricao .= "2) LIMPEZA ADEQUADA A CADA TROCA\n";
                $prescricao .= "3) DEIXAR A ÁREA AREJADA\n";
                break;

            case 'celulite bacteriana':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) CEFALEXINA 250MG/5ML SUSPENSÃO------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.15, 1) . "ML DE 6/6H POR 7-10 DIAS\n\n";
                }
                $prescricao .= "2) IBUPROFENO 50MG/ML GOTAS----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 0) . " GOTAS DE 8/8H SE DOR\n\n";
                }
                $prescricao .= "MEDIDAS LOCAIS:\n";
                $prescricao .= "1) COMPRESSAS MORNAS 3X AO DIA\n";
                $prescricao .= "2) MANTER O MEMBRO ELEVADO\n";
                $prescricao .= "3) REPOUSO RELATIVO\n";
                break;

            case 'convulsões febris':
                $prescricao .= "USO RETAL\n";
                $prescricao .= "1) DIAZEPAM 5MG/ML SOLUÇÃO---------------------------------- 2 AMPOLAS\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 0.1, 1) . "ML VIA RETAL SE CRISE > 5 MIN\n\n";
                }
                $prescricao .= "USO ORAL\n";
                $prescricao .= "2) PARACETAMOL 200MG/ML GOTAS------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) MANTER CRIANÇA EM DECÚBITO LATERAL\n";
                $prescricao .= "2) REMOVER OBJETOS PRÓXIMOS\n";
                $prescricao .= "3) NÃO COLOCAR OBJETOS NA BOCA\n";
                break;

            case 'epilepsia diagnosticada':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) VALPROATO DE SÓDIO 50MG/ML XAROPE----------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.5, 1) . "ML DE 12/12H\n\n";
                }
                $prescricao .= "USO RETAL (SE CRISE)\n";
                $prescricao .= "2) DIAZEPAM 5MG/ML SOLUÇÃO---------------------------------- 2 AMPOLAS\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 0.1, 1) . "ML VIA RETAL SE CRISE > 5 MIN\n\n";
                }
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) MANTER DIÁRIO DE CRISES\n";
                $prescricao .= "2) EVITAR FATORES DESENCADEANTES\n";
                $prescricao .= "3) MANTER SONO REGULAR\n";
                break;

            case 'crises de ausência':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) ETOSSUXIMIDA 50MG/ML XAROPE----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.5, 1) . "ML DE 12/12H\n\n";
                }
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) REGISTRAR FREQUÊNCIA DOS EPISÓDIOS\n";
                $prescricao .= "2) INFORMAR ESCOLA\n";
                $prescricao .= "3) EVITAR ATIVIDADES DE RISCO\n";
                break;

            case 'cefaleia tensional':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) IBUPROFENO 50MG/ML GOTAS-------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 0) . " GOTAS DE 8/8H SE DOR\n\n";
                }
                $prescricao .= "2) PARACETAMOL 200MG/ML GOTAS----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE DOR\n\n";
                }
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) IDENTIFICAR FATORES DESENCADEANTES\n";
                $prescricao .= "2) MANTER BOA HIDRATAÇÃO\n";
                $prescricao .= "3) REGULAR CICLO SONO-VIGÍLIA\n";
                break;

            case 'enxaqueca pediátrica':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) IBUPROFENO 50MG/ML GOTAS-------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 0) . " GOTAS DE 8/8H SE DOR\n\n";
                }
                $prescricao .= "2) SUMATRIPTANA 25MG COMPRIMIDO--------------------------- 1 CAIXA\n";
                if ($peso >= 30) {
                    $prescricao .= "   TOMAR 1 COMPRIMIDO NO INÍCIO DA CRISE. REPETIR APÓS 2H SE NECESSÁRIO\n\n";
                }
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) REPOUSO EM AMBIENTE ESCURO E SILENCIOSO\n";
                $prescricao .= "2) EVITAR FATORES DESENCADEANTES\n";
                $prescricao .= "3) MANTER DIÁRIO DE CRISES\n";
                break;

            case 'meningite viral':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "2) ONDANSETRONA 4MG/ML SOLUÇÃO---------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.15, 1) . "ML DE 8/8H SE VÔMITOS\n\n";
                }
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) REPOUSO ABSOLUTO\n";
                $prescricao .= "2) HIDRATAÇÃO ADEQUADA\n";
                $prescricao .= "3) AMBIENTE CALMO E POUCO ILUMINADO\n";
                break;

            case 'meningite bacteriana':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) INICIAR ANTIBIOTICOTERAPIA VENOSA\n\n";
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) CEFTRIAXONA 1G------------------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 100, 0) . "MG EV 12/12H\n\n";
                }
                $prescricao .= "2) DEXAMETASONA 4MG/ML------------------------------------ 1 AMPOLA\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 0.15, 1) . "ML EV 6/6H\n";
                }
                break;

            case 'traumatismo craniano leve':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE DOR\n\n";
                }
                $prescricao .= "OBSERVAÇÃO DOMICILIAR:\n";
                $prescricao .= "1) DESPERTAR A CADA 2H NAS PRIMEIRAS 6H\n";
                $prescricao .= "2) AVALIAR NÍVEL DE CONSCIÊNCIA\n";
                $prescricao .= "3) OBSERVAR VÔMITOS OU SONOLÊNCIA EXCESSIVA\n";
                break;

            case 'hematoma subgaleal':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE DOR\n\n";
                }
                $prescricao .= "MEDIDAS LOCAIS:\n";
                $prescricao .= "1) COMPRESSAS FRIAS NAS PRIMEIRAS 24H\n";
                $prescricao .= "2) COMPRESSAS MORNAS APÓS 24H\n";
                $prescricao .= "3) NÃO COMPRIMIR O LOCAL\n";
                break;

            case 'ataxia aguda pós-viral':
                $prescricao .= "CONDUTA:\n";
                $prescricao .= "1) OBSERVAÇÃO CLÍNICA\n";
                $prescricao .= "2) SUPORTE PARA DEAMBULAÇÃO\n";
                $prescricao .= "3) EVITAR ATIVIDADES COM RISCO DE QUEDA\n\n";
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) REPOUSO RELATIVO\n";
                $prescricao .= "2) AMBIENTE SEGURO\n";
                $prescricao .= "3) RETORNO GRADUAL ÀS ATIVIDADES\n";
                break;

            case 'encefalite viral':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) INICIAR TRATAMENTO ANTIVIRAL\n\n";
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) ACICLOVIR 250MG------------------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 10, 0) . "MG/KG EV 8/8H\n\n";
                }
                $prescricao .= "2) DEXAMETASONA 4MG/ML------------------------------------ 1 AMPOLA\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 0.15, 1) . "ML EV 6/6H\n";
                }
                break;

            case 'paralisia facial periférica':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PREDNISOLONA 3MG/ML SOLUÇÃO----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.5, 1) . "ML 1X AO DIA POR 7 DIAS\n\n";
                }
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "2) LÁGRIMAS ARTIFICIAIS------------------------------------ 1 FRASCO\n";
                $prescricao .= "   PINGAR 1 GOTA NO OLHO AFETADO DE 3/3H\n\n";
                $prescricao .= "3) POMADA OFTÁLMICA LUBRIFICANTE-------------------------- 1 BISNAGA\n";
                $prescricao .= "   APLICAR NO OLHO AFETADO AO DEITAR\n";
                break;

            case 'neuralgia pós-trauma':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) DIPIRONA 500MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE DOR\n\n";
                }
                $prescricao .= "2) AMITRIPTILINA 25MG COMPRIMIDO-------------------------- 1 CAIXA\n";
                if ($peso >= 30) {
                    $prescricao .= "   TOMAR 1/2 COMPRIMIDO À NOITE\n";
                }
                break;

            case 'síndrome de guillain-barré':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) MONITORIZAÇÃO RESPIRATÓRIA\n\n";
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) IMUNOGLOBULINA HUMANA 5G------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   INFUNDIR " . number_format($peso * 400, 0) . "MG/KG/DIA POR 5 DIAS\n";
                }
                break;

            case 'hidrocefalia descompensada':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) AVALIAÇÃO NEUROCIRÚRGICA\n\n";
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) MANITOL 20%-------------------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   INFUNDIR " . number_format($peso * 0.5, 1) . "G/KG EV DOSE ÚNICA\n\n";
                }
                $prescricao .= "2) DEXAMETASONA 4MG/ML----------------------------------- 1 AMPOLA\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 0.15, 1) . "ML EV 6/6H\n";
                }
                break;
            
            case 'dengue':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) DIPIRONA 500MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "2) ONDANSETRONA 4MG/ML SOLUÇÃO---------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.15, 1) . "ML DE 8/8H SE VÔMITOS\n\n";
                }
                $prescricao .= "MEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) HIDRATAÇÃO ORAL ABUNDANTE\n";
                $prescricao .= "2) REPOUSO\n";
                $prescricao .= "3) NÃO USAR AAS OU ANTI-INFLAMATÓRIOS\n";
                $prescricao .= "4) RETORNAR IMEDIATAMENTE SE SINAIS DE ALARME\n";
                break;

            case 'zika vírus':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) DIPIRONA 500MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "MEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) HIDRATAÇÃO ORAL ADEQUADA\n";
                $prescricao .= "2) REPOUSO\n";
                $prescricao .= "3) PROTEÇÃO CONTRA MOSQUITOS\n";
                $prescricao .= "4) ACOMPANHAMENTO DO PERÍMETRO CEFÁLICO EM LACTENTES\n";
                break;

            case 'chikungunya':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) DIPIRONA 500MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "2) IBUPROFENO 50MG/ML GOTAS------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 0) . " GOTAS DE 8/8H SE DOR\n\n";
                }
                $prescricao .= "MEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) HIDRATAÇÃO ORAL ADEQUADA\n";
                $prescricao .= "2) REPOUSO\n";
                $prescricao .= "3) COMPRESSAS FRIAS NAS ARTICULAÇÕES\n";
                break;

            case 'febre sem foco':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) DIPIRONA 500MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "2) PARACETAMOL 200MG/ML GOTAS----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "MEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) HIDRATAÇÃO ORAL ADEQUADA\n";
                $prescricao .= "2) ROUPAS LEVES\n";
                $prescricao .= "3) AMBIENTE AREJADO\n";
                $prescricao .= "4) RETORNO EM 24H SE PERSISTÊNCIA DA FEBRE\n";
                break;

            case 'sepse neonatal':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) INICIAR ANTIBIOTICOTERAPIA VENOSA\n\n";
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) AMPICILINA 500MG----------------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 50, 0) . "MG EV 6/6H\n\n";
                }
                $prescricao .= "2) GENTAMICINA 40MG/ML------------------------------------ 1 AMPOLA\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 2.5, 1) . "MG EV 1X AO DIA\n";
                }
                break;
            
            case 'sepse pediátrica':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) INICIAR ANTIBIOTICOTERAPIA VENOSA\n\n";
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) CEFTRIAXONA 1G------------------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 100, 0) . "MG EV 12/12H\n\n";
                }
                $prescricao .= "2) SORO FISIOLÓGICO 0,9%---------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   INFUNDIR " . number_format($peso * 20, 0) . "ML/KG EM 1 HORA\n";
                }
                break;

            case 'varicela (catapora)':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "2) HIDROXIZINA 2MG/ML SOLUÇÃO---------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 1) . "ML DE 8/8H SE PRURIDO\n\n";
                }
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "3) LOÇÃO DE CALAMINA------------------------------------- 1 FRASCO\n";
                $prescricao .= "   APLICAR NAS LESÕES 3X AO DIA\n\n";
                $prescricao .= "MEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) ISOLAMENTO ATÉ SECAREM TODAS AS LESÕES\n";
                $prescricao .= "2) CORTAR UNHAS E EVITAR COÇAR\n";
                $prescricao .= "3) BANHOS MORNOS\n";
                break;

            case 'doença mão-pé-boca':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE OU DOR\n\n";
                }
                $prescricao .= "MEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) HIDRATAÇÃO ORAL ADEQUADA\n";
                $prescricao .= "2) DIETA LÍQUIDA/PASTOSA FRIA\n";
                $prescricao .= "3) ISOLAMENTO ATÉ RESOLUÇÃO DAS LESÕES\n";
                $prescricao .= "4) HIGIENE ORAL APÓS ALIMENTAÇÃO\n";
                break;

            case 'mononucleose infecciosa':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "2) IBUPROFENO 50MG/ML GOTAS------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 0) . " GOTAS DE 8/8H SE DOR\n\n";
                }
                $prescricao .= "MEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) REPOUSO ABSOLUTO\n";
                $prescricao .= "2) EVITAR ATIVIDADES FÍSICAS POR 4 SEMANAS\n";
                $prescricao .= "3) HIDRATAÇÃO ORAL ADEQUADA\n";
                break;

            case 'herpangina':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE OU DOR\n\n";
                }
                $prescricao .= "MEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) DIETA LÍQUIDA/PASTOSA FRIA\n";
                $prescricao .= "2) HIDRATAÇÃO ORAL ADEQUADA\n";
                $prescricao .= "3) HIGIENE ORAL APÓS ALIMENTAÇÃO\n";
                break;
            
            case 'roseola infantil':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) DIPIRONA 500MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "MEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) HIDRATAÇÃO ORAL ADEQUADA\n";
                $prescricao .= "2) REPOUSO\n";
                $prescricao .= "3) OBSERVAR SURGIMENTO DO EXANTEMA APÓS FEBRE\n";
                break;

            case 'escarlatina':
                $prescricao .= "USO IM\n";
                $prescricao .= "1) PENICILINA G BENZATINA---------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . ($peso < 27 ? "600.000UI" : "1.200.000UI") . " IM DOSE ÚNICA\n\n";
                }
                $prescricao .= "USO ORAL\n";
                $prescricao .= "2) PARACETAMOL 200MG/ML GOTAS----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "MEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) ISOLAMENTO POR 24H APÓS INÍCIO DO ANTIBIÓTICO\n";
                $prescricao .= "2) HIDRATAÇÃO ORAL ADEQUADA\n";
                $prescricao .= "3) HIGIENE ORAL RIGOROSA\n";
                break;

            case 'tétano (casos raros)':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) INTERNAÇÃO EM UTI\n\n";
                $prescricao .= "USO IM\n";
                $prescricao .= "1) IMUNOGLOBULINA ANTITETÂNICA---------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 20, 0) . "UI/KG IM DOSE ÚNICA\n\n";
                }
                $prescricao .= "USO EV\n";
                $prescricao .= "2) METRONIDAZOL 5MG/ML------------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   INFUNDIR " . number_format($peso * 7.5, 0) . "MG/KG EV 8/8H\n";
                }
                break;

            case 'doença de kawasaki':
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) IMUNOGLOBULINA HUMANA 5G------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   INFUNDIR " . number_format($peso * 2000, 0) . "MG/KG DOSE ÚNICA\n\n";
                }
                $prescricao .= "USO ORAL\n";
                $prescricao .= "2) AAS 100MG COMPRIMIDO----------------------------------- 1 CAIXA\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 80/100, 1) . " COMPRIMIDO 6/6H\n";
                }
                break;

            case 'síndrome inflamatória multissistêmica pediátrica (pims)':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) INTERNAÇÃO EM UTI\n\n";
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) METILPREDNISOLONA 500MG-------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 2, 0) . "MG/KG/DIA DIVIDIDO 2X\n\n";
                }
                $prescricao .= "2) IMUNOGLOBULINA HUMANA 5G------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   INFUNDIR " . number_format($peso * 2000, 0) . "MG/KG DOSE ÚNICA\n";
                }
                break;

            case 'entorse':
            case 'entorses':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) IBUPROFENO 50MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 0) . " GOTAS DE 8/8H SE DOR\n\n";
                }
                $prescricao .= "MEDIDAS LOCAIS:\n";
                $prescricao .= "1) GELO LOCAL NAS PRIMEIRAS 48H\n";
                $prescricao .= "2) ELEVAÇÃO DO MEMBRO\n";
                $prescricao .= "3) REPOUSO RELATIVO\n";
                $prescricao .= "4) ENFAIXAMENTO COMPRESSIVO\n";
                break;

            case 'fratura simples':
            case 'fraturas simples':
            case 'fraturas simples (ex.: antebraço)':
            case 'fratura simples (ex.: antebraço)':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) DIPIRONA 500MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE DOR\n\n";
                }
                $prescricao .= "2) IBUPROFENO 50MG/ML GOTAS------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 0) . " GOTAS DE 8/8H SE DOR\n\n";
                }
                $prescricao .= "CONDUTA:\n";
                $prescricao .= "1) IMOBILIZAÇÃO CONFORME ORIENTAÇÃO\n";
                $prescricao .= "2) GELO LOCAL NAS PRIMEIRAS 48H\n";
                $prescricao .= "3) ELEVAÇÃO DO MEMBRO\n";
                $prescricao .= "4) RETORNO IMEDIATO SE SINAIS DE ALERTA\n";
                break;

            case 'luxação':
            case 'luxações':
            case 'luxações (ombro, cotovelo)':
            case 'luxação (ombro, cotovelo)':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) NÃO TENTAR REDUZIR A LUXAÇÃO\n";
                $prescricao .= "3) IMOBILIZAR NO ESTADO ENCONTRADO\n\n";
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) DIPIRONA 500MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE DOR\n";
                }
                break;

            case 'contusão muscular':
            case 'contusões musculares':
            case 'trauma muscular':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) IBUPROFENO 50MG/ML GOTAS-------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 0) . " GOTAS DE 8/8H SE DOR\n\n";
                }
                $prescricao .= "MEDIDAS LOCAIS:\n";
                $prescricao .= "1) GELO LOCAL NAS PRIMEIRAS 48H\n";
                $prescricao .= "2) REPOUSO DO MEMBRO AFETADO\n";
                $prescricao .= "3) COMPRESSÃO ELÁSTICA SE NECESSÁRIO\n";
                break;

            case 'parasitose intestinal':
            case 'parasitoses intestinais':
            case 'parasitoses intestinais (oxiúros, giardíase)':
            case 'parasitose intestinal (oxiúros, giardíase)':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) ALBENDAZOL 400MG COMPRIMIDO----------------------------- 1 COMPRIMIDO\n";
                if ($peso >= 10) {
                    $prescricao .= "   TOMAR 1 COMPRIMIDO DOSE ÚNICA\n\n";
                } else {
                    $prescricao .= "   TOMAR 1/2 COMPRIMIDO DOSE ÚNICA\n\n";
                }
                $prescricao .= "2) METRONIDAZOL 40MG/ML SUSPENSÃO-------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.25, 1) . "ML DE 8/8H POR 5 DIAS\n";
                }
                break;

            case 'furúnculo':
            case 'furúnculos':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) CEFALEXINA 250MG/5ML SUSPENSÃO------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.15, 1) . "ML DE 6/6H POR 7 DIAS\n\n";
                }
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "2) CLOREXIDINA DEGERMANTE 2%------------------------------ 1 FRASCO\n";
                $prescricao .= "   LAVAR AS LESÕES 2X AO DIA\n\n";
                $prescricao .= "3) COMPRESSAS MORNAS-------------------------------------- VÁRIAS\n";
                $prescricao .= "   APLICAR NAS LESÕES 3-4X AO DIA\n";
                break;

            case 'cardiopatia congênita descompensada':
            case 'cardiopatias congênitas descompensadas':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) ENCAMINHAR IMEDIATAMENTE AO PRONTO-SOCORRO\n";
                $prescricao .= "2) OXIGENIOTERAPIA\n";
                $prescricao .= "3) MONITORIZAÇÃO CARDÍACA\n\n";
                $prescricao .= "USO EV (HOSPITALAR)\n";
                $prescricao .= "1) FUROSEMIDA 10MG/ML-------------------------------------- 1 AMPOLA\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 0.5, 1) . "ML EV\n";
                }
                break;

            case 'conjuntivite viral':
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "1) SORO FISIOLÓGICO 0,9% COLÍRIO---------------------------- 2 FRASCOS\n";
                $prescricao .= "   PINGAR 1-2 GOTAS EM CADA OLHO DE 2/2H\n\n";
                $prescricao .= "2) LÁGRIMAS ARTIFICIAIS------------------------------------ 1 FRASCO\n";
                $prescricao .= "   PINGAR 1 GOTA EM CADA OLHO 4X AO DIA\n\n";
                $prescricao .= "MEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) LAVAR AS MÃOS FREQUENTEMENTE\n";
                $prescricao .= "2) LIMPAR OS OLHOS COM GAZE E SF 0,9%\n";
                $prescricao .= "3) NÃO COMPARTILHAR OBJETOS PESSOAIS\n";
                $prescricao .= "4) AFASTAMENTO ESCOLAR POR 5-7 DIAS\n";
                break;

            case 'conjuntivite bacteriana':
                $prescricao .= "USO TÓPICO\n";
                $prescricao .= "1) TOBRAMICINA 0,3% COLÍRIO--------------------------------- 1 FRASCO\n";
                $prescricao .= "   PINGAR 1-2 GOTAS EM CADA OLHO DE 4/4H NOS PRIMEIROS 2 DIAS\n";
                $prescricao .= "   APÓS, PINGAR 1-2 GOTAS EM CADA OLHO DE 6/6H POR 5 DIAS\n\n";
                $prescricao .= "2) SORO FISIOLÓGICO 0,9% COLÍRIO---------------------------- 2 FRASCOS\n";
                $prescricao .= "   PINGAR 1-2 GOTAS EM CADA OLHO DE 2/2H PARA LIMPEZA\n\n";
                $prescricao .= "MEDIDAS ESSENCIAIS:\n";
                $prescricao .= "1) LAVAR AS MÃOS FREQUENTEMENTE\n";
                $prescricao .= "2) LIMPAR OS OLHOS COM GAZE E SF 0,9% ANTES DE CADA APLICAÇÃO\n";
                $prescricao .= "3) NÃO COMPARTILHAR OBJETOS PESSOAIS\n";
                $prescricao .= "4) AFASTAMENTO ESCOLAR ATÉ 24H APÓS INÍCIO DO TRATAMENTO\n";
                $prescricao .= "5) TROCAR FRONHAS DIARIAMENTE\n";
                break;

            case 'osteomielite':
                $prescricao .= "1. ANTIBIOTICOTERAPIA:\n\n";
                $prescricao .= "   a) Primeira escolha:\n";
                $prescricao .= "      Oxacilina 100mg/kg/dia\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 100, 0) : "__") . "mg\n";
                $prescricao .= "      Via: ENDOVENOSA\n";
                $prescricao .= "      Dividido em 4 doses (6/6h)\n\n";
                $prescricao .= "   b) Alternativa:\n";
                $prescricao .= "      Ceftriaxona 100mg/kg/dia\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 100, 0) : "__") . "mg\n";
                $prescricao .= "      Via: ENDOVENOSA\n";
                $prescricao .= "      1x/dia\n\n";
                $prescricao .= "2. ANALGESIA:\n\n";
                $prescricao .= "   a) Dipirona 20mg/kg/dose\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 20, 0) : "__") . "mg\n";
                $prescricao .= "      Via: ENDOVENOSA\n";
                $prescricao .= "      6/6h\n\n";
                $prescricao .= "   b) Ibuprofeno 10mg/kg/dose\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 10, 0) : "__") . "mg\n";
                $prescricao .= "      Via: ORAL\n";
                $prescricao .= "      8/8h\n\n";
                $prescricao .= "3. EXAMES SOLICITADOS:\n";
                $prescricao .= "   - Hemograma completo\n";
                $prescricao .= "   - PCR/VHS\n";
                $prescricao .= "   - Hemocultura (2 amostras)\n";
                $prescricao .= "   - RX do local afetado\n";
                $prescricao .= "   - RNM (se disponível)\n\n";
                $prescricao .= "4. CUIDADOS LOCAIS:\n";
                $prescricao .= "   - Imobilização do membro\n";
                $prescricao .= "   - Elevação\n";
                $prescricao .= "   - Compressas frias\n";
                $prescricao .= "   - Repouso absoluto\n";
                $prescricao .= "   - Monitorização dos pulsos\n\n";
                $prescricao .= "INTERNAÇÃO NECESSÁRIA\n\n";
                $prescricao .= "Observações:\n";
                $prescricao .= "- Duração do tratamento: 4-6 semanas\n";
                $prescricao .= "- Transição para VO após melhora clínica\n";
                $prescricao .= "- Seguimento ambulatorial semanal\n";
                $prescricao .= "- Controle radiológico em 2-3 semanas\n";
                break;

            case 'artrite séptica':
                $prescricao .= "1. ANTIBIOTICOTERAPIA:\n\n";
                $prescricao .= "   a) Primeira escolha:\n";
                $prescricao .= "      Oxacilina 150mg/kg/dia\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 150, 0) : "__") . "mg\n";
                $prescricao .= "      Via: ENDOVENOSA\n";
                $prescricao .= "      Dividido em 4 doses (6/6h)\n\n";
                $prescricao .= "   b) Alternativa:\n";
                $prescricao .= "      Ceftriaxona 100mg/kg/dia\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 100, 0) : "__") . "mg\n";
                $prescricao .= "      Via: ENDOVENOSA\n";
                $prescricao .= "      1x/dia\n\n";
                $prescricao .= "2. ANALGESIA:\n\n";
                $prescricao .= "   a) Morfina 0,1mg/kg/dose\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 0.1, 2) : "__") . "mg\n";
                $prescricao .= "      Via: ENDOVENOSA\n";
                $prescricao .= "      4/4h se dor intensa\n\n";
                $prescricao .= "   b) Dipirona 20mg/kg/dose\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 20, 0) : "__") . "mg\n";
                $prescricao .= "      Via: ENDOVENOSA\n";
                $prescricao .= "      6/6h\n\n";
                $prescricao .= "3. EXAMES SOLICITADOS:\n";
                $prescricao .= "   - Hemograma completo\n";
                $prescricao .= "   - PCR/VHS\n";
                $prescricao .= "   - Hemocultura (2 amostras)\n";
                $prescricao .= "   - Cultura do líquido sinovial\n";
                $prescricao .= "   - RX da articulação\n";
                $prescricao .= "   - USG articular\n\n";
                $prescricao .= "4. CUIDADOS LOCAIS:\n";
                $prescricao .= "   - Imobilização\n";
                $prescricao .= "   - Elevação do membro\n";
                $prescricao .= "   - Gelo local\n";
                $prescricao .= "   - Repouso absoluto\n";
                $prescricao .= "   - Drenagem cirúrgica se indicado\n\n";
                $prescricao .= "INTERNAÇÃO NECESSÁRIA\n\n";
                $prescricao .= "Observações:\n";
                $prescricao .= "- Avaliação ortopédica imediata\n";
                $prescricao .= "- Considerar drenagem cirúrgica\n";
                $prescricao .= "- Antibioticoterapia por 3-4 semanas\n";
                $prescricao .= "- Fisioterapia precoce\n";
                $prescricao .= "- Seguimento prolongado\n";
                break;

            case 'laringite estridulosa':
            case 'laringite':
                $prescricao .= "1. MEDICAÇÕES:\n\n";
                $prescricao .= "   a) Dexametasona 0,15mg/kg IMEDIATA:\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 0.15, 1) : "__") . "mg\n";
                $prescricao .= "      Via: INTRAMUSCULAR\n";
                $prescricao .= "      Dose única\n\n";
                $prescricao .= "   b) Prednisolona 2mg/kg:\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 2, 1) : "__") . "mg\n";
                $prescricao .= "      Via: ORAL\n";
                $prescricao .= "      1x/dia por 3 dias\n\n";
                $prescricao .= "2. MEDIDAS NÃO FARMACOLÓGICAS:\n";
                $prescricao .= "   - Umidificação do ambiente\n";
                $prescricao .= "   - Exposição ao ar frio/umido\n";
                $prescricao .= "   - Posição sentada\n";
                $prescricao .= "   - Manter calma\n";
                $prescricao .= "   - Hidratação adequada\n\n";
                $prescricao .= "3. SINAIS DE ALERTA:\n";
                $prescricao .= "   - Piora do estridor\n";
                $prescricao .= "   - Dificuldade respiratória\n";
                $prescricao .= "   - Cianose\n";
                $prescricao .= "   - Prostração\n";
                $prescricao .= "   - Recusa alimentar\n\n";
                $prescricao .= "Retorno: Em 24h para reavaliação\n\n";
                $prescricao .= "Observações:\n";
                $prescricao .= "- Pode recorrer\n";
                $prescricao .= "- Manter observação\n";
                $prescricao .= "- Retorno imediato se piora\n";
                break;

            case 'intussuscepção':
                $prescricao .= "1. CONDUTA IMEDIATA:\n";
                $prescricao .= "   - Jejum absoluto\n";
                $prescricao .= "   - Acesso venoso\n";
                $prescricao .= "   - Hidratação EV\n";
                $prescricao .= "   - Sonda nasogástrica aberta\n";
                $prescricao .= "   - Avaliação cirúrgica\n\n";
                $prescricao .= "2. HIDRATAÇÃO:\n";
                $prescricao .= "   SG5% + SF0,9% (1:1)\n";
                $prescricao .= "   Volume: " . ($peso ? number_format($peso * 20, 0) : "__") . "ml/h\n";
                $prescricao .= "   Manter até avaliação cirúrgica\n\n";
                $prescricao .= "3. ANALGESIA:\n\n";
                $prescricao .= "   Morfina 0,1mg/kg:\n";
                $prescricao .= "   Dose: " . ($peso ? number_format($peso * 0.1, 2) : "__") . "mg\n";
                $prescricao .= "   Via: ENDOVENOSA\n";
                $prescricao .= "   Se dor intensa\n\n";
                $prescricao .= "4. EXAMES SOLICITADOS:\n";
                $prescricao .= "   - Hemograma\n";
                $prescricao .= "   - Eletrólitos\n";
                $prescricao .= "   - Gasometria\n";
                $prescricao .= "   - RX abdome\n";
                $prescricao .= "   - USG abdome\n\n";
                $prescricao .= "5. SINAIS VITAIS:\n";
                $prescricao .= "   - PA cada 2h\n";
                $prescricao .= "   - FC cada 2h\n";
                $prescricao .= "   - Tax cada 4h\n";
                $prescricao .= "   - Diurese horária\n\n";
                $prescricao .= "INTERNAÇÃO NECESSÁRIA\n\n";
                $prescricao .= "Observações:\n";
                $prescricao .= "- Emergência cirúrgica\n";
                $prescricao .= "- Monitorização contínua\n";
                $prescricao .= "- Reavaliações frequentes\n";
                break;

            case 'doença de legg':
                $prescricao .= "1. MEDICAÇÕES:\n\n";
                $prescricao .= "   a) Anti-inflamatório:\n";
                $prescricao .= "      Ibuprofeno 10mg/kg/dose\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 10, 0) : "__") . "mg\n";
                $prescricao .= "      Via: ORAL\n";
                $prescricao .= "      8/8h por 5-7 dias\n\n";
                $prescricao .= "   b) Analgésico (se necessário):\n";
                $prescricao .= "      Dipirona Gotas 500mg/ml\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 10, 0) : "__") . "mg\n";
                $prescricao .= "      Via: ORAL\n";
                $prescricao .= "      6/6h se dor\n\n";
                $prescricao .= "2. RESTRIÇÕES:\n";
                $prescricao .= "   - Repouso relativo\n";
                $prescricao .= "   - Evitar impacto\n";
                $prescricao .= "   - Evitar sobrecarga\n";
                $prescricao .= "   - Uso de muletas\n";
                $prescricao .= "   - Restrição de atividades físicas\n\n";
                $prescricao .= "3. FISIOTERAPIA:\n";
                $prescricao .= "   - 2-3x por semana\n";
                $prescricao .= "   - Exercícios isométricos\n";
                $prescricao .= "   - Manutenção ADM\n";
                $prescricao .= "   - Fortalecimento muscular\n\n";
                $prescricao .= "4. EXAMES SOLICITADOS:\n";
                $prescricao .= "   - RX quadril AP e Lauenstein\n";
                $prescricao .= "   - RNM quadril\n";
                $prescricao .= "   - Artrograma (se indicado)\n\n";
                $prescricao .= "Retorno: Em 15 dias com exames\n\n";
                $prescricao .= "Observações:\n";
                $prescricao .= "- Acompanhamento prolongado\n";
                $prescricao .= "- Controle radiológico periódico\n";
                $prescricao .= "- Avaliar necessidade de órtese\n";
                $prescricao .= "- Prognóstico depende da idade\n";
                break;

            case 'sinovite do quadril':
                $prescricao .= "1. MEDICAÇÕES:\n\n";
                $prescricao .= "   a) Anti-inflamatório:\n";
                $prescricao .= "      Ibuprofeno 10mg/kg/dose\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 10, 0) : "__") . "mg\n";
                $prescricao .= "      Via: ORAL\n";
                $prescricao .= "      8/8h por 5 dias\n\n";
                $prescricao .= "   b) Analgésico (se necessário):\n";
                $prescricao .= "      Dipirona Gotas 500mg/ml\n";
                $prescricao .= "      Dose: " . ($peso ? number_format($peso * 10, 0) : "__") . "mg\n";
                $prescricao .= "      Via: ORAL\n";
                $prescricao .= "      6/6h se dor\n\n";
                $prescricao .= "2. RESTRIÇÕES:\n";
                $prescricao .= "   - Repouso relativo\n";
                $prescricao .= "   - Evitar sobrecarga\n";
                $prescricao .= "   - Uso de muletas se necessário\n\n";
                $prescricao .= "3. MEDIDAS LOCAIS:\n";
                $prescricao .= "   - Compressa fria local\n";
                $prescricao .= "   - 3x ao dia por 15-20 min\n";
                $prescricao .= "   - Elevação do membro\n\n";
                $prescricao .= "4. EXAMES SOLICITADOS:\n";
                $prescricao .= "   - RX quadril AP e Lauenstein\n";
                $prescricao .= "   - USG quadril\n";
                $prescricao .= "   - Hemograma\n";
                $prescricao .= "   - PCR\n";
                $prescricao .= "   - VHS\n\n";
                $prescricao .= "5. SINAIS DE ALERTA:\n";
                $prescricao .= "   - Febre alta\n";
                $prescricao .= "   - Dor intensa\n";
                $prescricao .= "   - Limitação severa\n";
                $prescricao .= "   - Piora progressiva\n\n";
                $prescricao .= "Retorno: Em 48-72h para reavaliação\n\n";
                $prescricao .= "Observações:\n";
                $prescricao .= "- Condição autolimitada\n";
                $prescricao .= "- Duração média 7-10 dias\n";
                $prescricao .= "- Retorno imediato se piora\n";
                break;

            case 'displasia do quadril':
                $prescricao .= "DIAGNÓSTICO: DISPLASIA DO DESENVOLVIMENTO DO QUADRIL (DDQ)\n\n";
                $prescricao .= "CONDUTA:\n";
                $prescricao .= "1) USO DE SUSPENSÓRIO DE PAVLIK\n";
                $prescricao .= "   - Manter por 23 horas por dia\n";
                $prescricao .= "   - Retirar apenas para o banho\n\n";
                $prescricao .= "2) FISIOTERAPIA\n";
                $prescricao .= "   - 2 sessões por semana\n\n";
                $prescricao .= "USO ORAL (SE DOR)\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.6, 0) : "__") . " GOTAS DE 6/6H SE DOR\n\n";
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "1) Ultrassonografia de quadril (menores de 6 meses)\n";
                $prescricao .= "2) Radiografia de bacia (maiores de 6 meses)\n\n";
                $prescricao .= "ORIENTAÇÕES:\n";
                $prescricao .= "- Manter acompanhamento regular com ortopedista\n";
                $prescricao .= "- Observar sinais de desconforto ou irritabilidade\n";
                $prescricao .= "- Retornar em 7 dias para reavaliação\n";
                break;

            case 'escoliose dolorosa':
                $prescricao .= "DIAGNÓSTICO: ESCOLIOSE DOLOROSA\n\n";
                $prescricao .= "USO ORAL:\n";
                $prescricao .= "1) NAPROXENO 25MG/ML SUSPENSÃO------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.2, 1) . "ML DE 12/12H POR 5 DIAS\n\n";
                }
                $prescricao .= "2) DIPIRONA 500MG/ML GOTAS----------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.6, 0) : "__") . " GOTAS DE 6/6H SE DOR\n\n";
                $prescricao .= "FISIOTERAPIA:\n";
                $prescricao .= "- 2-3 sessões por semana\n\n";
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "1) Radiografia panorâmica da coluna em AP e Perfil\n";
                $prescricao .= "2) Ressonância Magnética da coluna (se necessário)\n\n";
                $prescricao .= "ORIENTAÇÕES:\n";
                $prescricao .= "- Evitar carregar peso excessivo\n";
                $prescricao .= "- Manter boa postura\n";
                $prescricao .= "- Praticar exercícios conforme orientação do fisioterapeuta\n";
                $prescricao .= "- Retorno em 15 dias\n";
                break;

            case 'pé torto congênito':
                $prescricao .= "DIAGNÓSTICO: PÉ TORTO CONGÊNITO\n\n";
                $prescricao .= "CONDUTA:\n";
                $prescricao .= "1) MÉTODO PONSETI\n";
                $prescricao .= "   - Trocas semanais de gesso\n";
                $prescricao .= "   - Duração aproximada do tratamento: 6-8 semanas\n\n";
                $prescricao .= "USO ORAL (SE DOR/DESCONFORTO):\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.6, 0) : "__") . " GOTAS DE 6/6H SE DOR\n\n";
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "1) Radiografia dos pés em AP e Perfil\n\n";
                $prescricao .= "ORIENTAÇÕES:\n";
                $prescricao .= "- Não remover o gesso em casa\n";
                $prescricao .= "- Observar coloração e temperatura dos dedos\n";
                $prescricao .= "- Manter retornos semanais para troca do gesso\n";
                $prescricao .= "- Após fase de gessos, usar órtese de abdução\n";
                break;

            case 'sinovite transitória do quadril':
                $prescricao .= "DIAGNÓSTICO: SINOVITE TRANSITÓRIA DO QUADRIL\n\n";
                $prescricao .= "USO ORAL:\n";
                $prescricao .= "1) IBUPROFENO 50MG/ML GOTAS----------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.4, 0) : "__") . " GOTAS DE 8/8H POR 5 DIAS\n\n";
                $prescricao .= "2) DIPIRONA 500MG/ML GOTAS----------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.6, 0) : "__") . " GOTAS DE 6/6H SE DOR\n\n";
                $prescricao .= "CONDUTA:\n";
                $prescricao .= "- Repouso relativo por 48-72h\n";
                $prescricao .= "- Aplicar compressa fria local\n";
                $prescricao .= "- Evitar sobrecarga no membro afetado\n\n";
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "1) Ultrassonografia de quadril\n";
                $prescricao .= "2) Radiografia de bacia\n\n";
                $prescricao .= "SINAIS DE ALERTA:\n";
                $prescricao .= "- Febre alta persistente\n";
                $prescricao .= "- Dor intensa que não melhora com medicação\n";
                $prescricao .= "- Limitação severa dos movimentos\n\n";
                $prescricao .= "RETORNO:\n";
                $prescricao .= "- Em 48-72h para reavaliação\n";
                $prescricao .= "- Imediatamente se sinais de alerta\n";
                break;

            case 'corpo estranho no ouvido':
                $prescricao .= "DIAGNÓSTICO: CORPO ESTRANHO EM CONDUTO AUDITIVO\n\n";
                $prescricao .= "USO TÓPICO:\n";
                $prescricao .= "1) CIPROFLOXACINO + HIDROCORTISONA GOTAS OTOLÓGICAS--------- 1 FRASCO\n";
                $prescricao .= "   PINGAR 3 GOTAS NO OUVIDO AFETADO 3X AO DIA POR 7 DIAS\n\n";
                $prescricao .= "USO ORAL:\n";
                $prescricao .= "1) IBUPROFENO 50MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.4, 0) : "__") . " GOTAS DE 8/8H SE DOR\n\n";
                $prescricao .= "CUIDADOS:\n";
                $prescricao .= "- Manter ouvido seco\n";
                $prescricao .= "- Evitar manipulação\n";
                $prescricao .= "- Proteger durante o banho\n";
                $prescricao .= "- Retorno em 24h para reavaliação\n";
                break;

            case 'corpo estranho no nariz':
                $prescricao .= "DIAGNÓSTICO: CORPO ESTRANHO EM FOSSA NASAL\n\n";
                $prescricao .= "USO NASAL:\n";
                $prescricao .= "1) SORO FISIOLÓGICO 0,9% NASAL------------------------------- 2 FRASCOS\n";
                $prescricao .= "   LAVAR A FOSSA NASAL 3-4X AO DIA\n\n";
                $prescricao .= "2) NEOMICINA + BACITRACINA POMADA--------------------------- 1 TUBO\n";
                $prescricao .= "   APLICAR NA FOSSA NASAL 2X AO DIA POR 5 DIAS\n\n";
                $prescricao .= "USO ORAL:\n";
                $prescricao .= "1) AMOXICILINA 250MG/5ML SUSPENSÃO-------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.15, 0) : "__") . " ML DE 8/8H POR 7 DIAS\n\n";
                $prescricao .= "CUIDADOS:\n";
                $prescricao .= "- Evitar assoar o nariz com força\n";
                $prescricao .= "- Manter boa hidratação\n";
                $prescricao .= "- Observar sinais de infecção\n";
                $prescricao .= "- Retorno em 24h para reavaliação\n";
                break;

            case 'epistaxe':
                $prescricao .= "DIAGNÓSTICO: EPISTAXE\n\n";
                $prescricao .= "CONDUTA IMEDIATA:\n";
                $prescricao .= "1) Compressão digital das narinas por 10-15 minutos\n";
                $prescricao .= "2) Manter cabeça levemente inclinada para frente\n";
                $prescricao .= "3) Aplicar compressa fria local\n\n";
                $prescricao .= "USO NASAL:\n";
                $prescricao .= "1) SORO FISIOLÓGICO 0,9% NASAL------------------------------- 2 FRASCOS\n";
                $prescricao .= "   LAVAR AS FOSSAS NASAIS 4-6X AO DIA\n\n";
                $prescricao .= "2) NEOMICINA + BACITRACINA POMADA--------------------------- 1 TUBO\n";
                $prescricao .= "   APLICAR NAS FOSSAS NASAIS 3X AO DIA POR 5 DIAS\n\n";
                $prescricao .= "CUIDADOS:\n";
                $prescricao .= "- Evitar assoar o nariz com força\n";
                $prescricao .= "- Manter boa hidratação\n";
                $prescricao .= "- Umidificação do ambiente\n";
                $prescricao .= "- Elevação da cabeceira ao dormir\n\n";
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "1) Hemograma completo\n";
                $prescricao .= "2) Coagulograma\n\n";
                $prescricao .= "RETORNO:\n";
                $prescricao .= "- Em 24-48h para reavaliação\n";
                $prescricao .= "- Imediatamente se sangramento volumoso ou sinais de choque\n";
                break;

            case 'vulvovaginite':
                $prescricao .= "DIAGNÓSTICO: VULVOVAGINITE\n\n";
                $prescricao .= "USO TÓPICO:\n";
                $prescricao .= "1) MICONAZOL CREME 2%--------------------------------------- 1 TUBO\n";
                $prescricao .= "   APLICAR NA REGIÃO GENITAL 2X AO DIA POR 7-10 DIAS\n\n";
                $prescricao .= "USO ORAL:\n";
                $prescricao .= "1) LORATADINA 1MG/ML XAROPE--------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.1, 0) : "__") . " ML 1X AO DIA SE PRURIDO INTENSO\n\n";
                $prescricao .= "2) DIPIRONA 500MG/ML GOTAS---------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.4, 0) : "__") . " GOTAS DE 6/6H SE DOR\n\n";
                $prescricao .= "CUIDADOS DE HIGIENE:\n";
                $prescricao .= "- Lavar a região com água e sabonete neutro\n";
                $prescricao .= "- Secar bem após o banho\n";
                $prescricao .= "- Trocar roupas íntimas diariamente\n";
                $prescricao .= "- Evitar roupas apertadas\n";
                $prescricao .= "- Evitar sabonetes íntimos\n\n";
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "1) Urina tipo I\n";
                $prescricao .= "2) Cultura de secreção vaginal (se necessário)\n\n";
                $prescricao .= "RETORNO:\n";
                $prescricao .= "- Em 7-10 dias para reavaliação\n";
                $prescricao .= "- Antes se piora dos sintomas\n";
                break;

            case 'balanopostite':
                $prescricao .= "DIAGNÓSTICO: BALANOPOSTITE\n\n";
                $prescricao .= "USO TÓPICO:\n";
                $prescricao .= "1) MUPIROCINA 2% POMADA------------------------------------- 1 TUBO\n";
                $prescricao .= "   APLICAR NA REGIÃO AFETADA 3X AO DIA POR 7 DIAS\n\n";
                $prescricao .= "2) MICONAZOL CREME 2%--------------------------------------- 1 TUBO\n";
                $prescricao .= "   APLICAR NA REGIÃO AFETADA 2X AO DIA POR 7-10 DIAS\n\n";
                $prescricao .= "USO ORAL:\n";
                $prescricao .= "1) LORATADINA 1MG/ML XAROPE--------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . ($peso ? number_format($peso * 0.1, 0) : "__") . " ML 1X AO DIA SE PRURIDO INTENSO\n\n";
                $prescricao .= "CUIDADOS DE HIGIENE:\n";
                $prescricao .= "- Lavar a região com água e sabonete neutro\n";
                $prescricao .= "- Secar bem após o banho\n";
                $prescricao .= "- Trocar roupas íntimas diariamente\n";
                $prescricao .= "- Evitar roupas apertadas\n\n";
                $prescricao .= "RETORNO:\n";
                $prescricao .= "- Em 7 dias para reavaliação\n";
                $prescricao .= "- Antes se piora dos sintomas\n";
                break;

            case 'hipoglicemia em lactentes':
                $prescricao .= "DIAGNÓSTICO: HIPOGLICEMIA EM LACTENTE\n\n";
                $prescricao .= "CONDUTA IMEDIATA:\n";
                $prescricao .= "1) GLICOSE 25% AMPOLA---------------------------------------- 4 AMPOLAS\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 2, 0) . "ML EV EM BOLUS\n\n";
                }
                $prescricao .= "2) SORO GLICOSADO 10%--------------------------------------- CONFORME NECESSÁRIO\n";
                if ($peso) {
                    $prescricao .= "   MANTER " . number_format($peso * 100, 0) . "ML/KG/DIA EM BIC\n\n";
                }
                $prescricao .= "MONITORIZAÇÃO:\n";
                $prescricao .= "- Glicemia capilar a cada 30 min na 1ª hora\n";
                $prescricao .= "- Após, a cada 2h até estabilização\n";
                $prescricao .= "- Sinais vitais a cada 2h\n\n";
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "1) Glicemia\n";
                $prescricao .= "2) Gasometria\n";
                $prescricao .= "3) Eletrólitos\n";
                $prescricao .= "4) Hemograma\n\n";
                $prescricao .= "ORIENTAÇÕES:\n";
                $prescricao .= "- Manter jejum\n";
                $prescricao .= "- Monitorar nível de consciência\n";
                $prescricao .= "- Avaliar sinais de desidratação\n";
                $prescricao .= "- Investigar causa base\n";
                break;

            case 'síndrome nefrótica pediátrica':
                $prescricao .= "DIAGNÓSTICO: SÍNDROME NEFRÓTICA PEDIÁTRICA\n\n";
                $prescricao .= "USO ORAL:\n";
                $prescricao .= "1) PREDNISOLONA 3MG/ML SOLUÇÃO ORAL------------------------- 3 FRASCOS\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 2, 0) . "MG/DIA DIVIDIDO EM 2 DOSES\n";
                    $prescricao .= "   DURAÇÃO: 4-6 SEMANAS\n\n";
                }
                $prescricao .= "2) FUROSEMIDA 40MG COMPRIMIDOS------------------------------ 30 COMP\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 2, 0) . "MG/DIA DIVIDIDO EM 2 DOSES\n\n";
                }
                $prescricao .= "3) ESPIRONOLACTONA 25MG COMPRIMIDOS------------------------- 30 COMP\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 2, 0) . "MG/DIA DIVIDIDO EM 2 DOSES\n\n";
                }
                $prescricao .= "4) AAS 100MG COMPRIMIDOS------------------------------------ 30 COMP\n";
                $prescricao .= "   TOMAR 1 COMPRIMIDO 1X AO DIA\n\n";
                $prescricao .= "SUPLEMENTAÇÃO:\n";
                $prescricao .= "1) CÁLCIO ELEMENTAR 500MG COMPRIMIDOS----------------------- 30 COMP\n";
                $prescricao .= "   TOMAR 1 COMPRIMIDO 2X AO DIA\n\n";
                $prescricao .= "2) VITAMINA D3 50.000 UI CÁPSULA---------------------------- 4 CAPS\n";
                $prescricao .= "   TOMAR 1 CÁPSULA POR SEMANA\n\n";
                $prescricao .= "RESTRIÇÕES E CUIDADOS:\n";
                $prescricao .= "- Dieta hipossódica\n";
                $prescricao .= "- Restrição hídrica\n";
                $prescricao .= "- Controle de peso diário\n";
                $prescricao .= "- Repouso relativo\n\n";
                $prescricao .= "EXAMES DE CONTROLE:\n";
                $prescricao .= "1) Proteinúria 24h\n";
                $prescricao .= "2) Albumina\n";
                $prescricao .= "3) Função renal\n";
                $prescricao .= "4) Colesterol\n";
                $prescricao .= "5) Hemograma\n\n";
                $prescricao .= "RETORNO:\n";
                $prescricao .= "- Semanal no primeiro mês\n";
                $prescricao .= "- Antes se edema importante ou sinais de alarme\n";
                break;

            case 'convulsão febril':
                $prescricao .= "DIAGNÓSTICO: CONVULSÃO FEBRIL\n\n";
                $prescricao .= "CONDUTA IMEDIATA:\n";
                $prescricao .= "1) POSICIONAR EM DECÚBITO LATERAL\n";
                $prescricao .= "2) PROTEGER DE TRAUMAS\n";
                $prescricao .= "3) MANTER VIAS AÉREAS PÉRVIAS\n\n";
                $prescricao .= "USO RETAL:\n";
                $prescricao .= "1) DIAZEPAM 10MG/2ML AMPOLA--------------------------------- 2 AMPOLAS\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 0.5, 1) . "MG VIA RETAL SE CRISE > 5 MIN\n\n";
                }
                $prescricao .= "USO ORAL:\n";
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "2) IBUPROFENO 50MG/ML GOTAS-------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.4, 0) . " GOTAS DE 8/8H SE FEBRE\n\n";
                }
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "1) Hemograma completo\n";
                $prescricao .= "2) PCR\n";
                $prescricao .= "3) Eletrólitos\n";
                $prescricao .= "4) Glicemia\n\n";
                $prescricao .= "SINAIS DE ALERTA:\n";
                $prescricao .= "- Crise > 15 minutos\n";
                $prescricao .= "- Múltiplas crises em 24h\n";
                $prescricao .= "- Alteração neurológica pós-ictal prolongada\n";
                break;

            case 'cefaleia':
                $prescricao .= "DIAGNÓSTICO: CEFALEIA\n\n";
                $prescricao .= "USO ORAL:\n";
                $prescricao .= "1) DIPIRONA 500MG/ML GOTAS---------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.6, 0) . " GOTAS DE 6/6H SE DOR\n\n";
                }
                $prescricao .= "2) METOCLOPRAMIDA 4MG/ML GOTAS----------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.15, 1) . "ML SE NÁUSEA\n\n";
                }
                $prescricao .= "MEDIDAS NÃO FARMACOLÓGICAS:\n";
                $prescricao .= "1) Repouso em ambiente calmo e escuro\n";
                $prescricao .= "2) Compressas frias na testa\n";
                $prescricao .= "3) Evitar telas e ruídos\n";
                $prescricao .= "4) Boa hidratação\n\n";
                $prescricao .= "SINAIS DE ALERTA:\n";
                $prescricao .= "- Cefaleia que acorda à noite\n";
                $prescricao .= "- Vômitos em jato\n";
                $prescricao .= "- Alteração neurológica\n";
                $prescricao .= "- Rigidez de nuca\n";
                break;

            case 'meningite':
                $prescricao .= "DIAGNÓSTICO: MENINGITE\n\n";
                $prescricao .= "CONDUTA:\n";
                $prescricao .= "1) INTERNAÇÃO IMEDIATA\n";
                $prescricao .= "2) ISOLAMENTO RESPIRATÓRIO\n\n";
                $prescricao .= "USO ENDOVENOSO (HOSPITALAR):\n";
                $prescricao .= "1) CEFTRIAXONA 1G------------------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 100, 0) . "MG EV 12/12H\n\n";
                }
                $prescricao .= "2) DEXAMETASONA 4MG/ML-------------------------------------- 1 AMPOLA\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 0.15, 1) . "MG EV 6/6H\n\n";
                }
                $prescricao .= "3) DIPIRONA 1G/2ML------------------------------------------ 1 AMPOLA\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 20, 0) . "MG EV 6/6H SE FEBRE\n\n";
                }
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "1) Hemograma completo\n";
                $prescricao .= "2) PCR\n";
                $prescricao .= "3) Hemocultura (2 amostras)\n";
                $prescricao .= "4) Líquor completo\n";
                $prescricao .= "5) TC de crânio se sinais de hipertensão intracraniana\n\n";
                $prescricao .= "MONITORIZAÇÃO:\n";
                $prescricao .= "- Sinais vitais a cada 2h\n";
                $prescricao .= "- Escala de Glasgow\n";
                $prescricao .= "- Sinais de hipertensão intracraniana\n";
                break;

            case 'paralisia facial':
                $prescricao .= "DIAGNÓSTICO: PARALISIA FACIAL\n\n";
                $prescricao .= "USO ORAL:\n";
                $prescricao .= "1) PREDNISOLONA 3MG/ML SOLUÇÃO------------------------------ 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 1, 1) . "ML 1X AO DIA POR 7 DIAS\n\n";
                }
                $prescricao .= "USO TÓPICO:\n";
                $prescricao .= "1) COLÍRIO LUBRIFICANTE------------------------------------- 1 FRASCO\n";
                $prescricao .= "   PINGAR 1 GOTA NO OLHO AFETADO DE 3/3H\n\n";
                $prescricao .= "CUIDADOS:\n";
                $prescricao .= "1) Proteção ocular noturna\n";
                $prescricao .= "2) Fisioterapia facial\n";
                $prescricao .= "3) Exercícios de mímica facial\n\n";
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "1) Hemograma completo\n";
                $prescricao .= "2) PCR\n";
                $prescricao .= "3) Sorologia para Herpes simplex\n";
                $prescricao .= "4) RNM de crânio se necessário\n\n";
                $prescricao .= "RETORNO:\n";
                $prescricao .= "- Em 7 dias para reavaliação\n";
                $prescricao .= "- Antes se piora dos sintomas\n";
                break;

            case 'sopro cardíaco':
                $prescricao .= "DIAGNÓSTICO: SOPRO CARDÍACO\n\n";
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "1) Ecocardiograma\n";
                $prescricao .= "2) Eletrocardiograma\n";
                $prescricao .= "3) Radiografia de tórax\n";
                $prescricao .= "4) Hemograma completo\n\n";
                $prescricao .= "MEDIDAS GERAIS:\n";
                $prescricao .= "1) Avaliação com cardiologista pediátrico\n";
                $prescricao .= "2) Monitorar crescimento e desenvolvimento\n";
                $prescricao .= "3) Profilaxia para endocardite se indicado\n\n";
                $prescricao .= "SINAIS DE ALERTA:\n";
                $prescricao .= "- Cianose\n";
                $prescricao .= "- Dificuldade para mamar/alimentar\n";
                $prescricao .= "- Sudorese excessiva\n";
                $prescricao .= "- Taquipneia\n";
                break;

            case 'arritmia':
                $prescricao .= "DIAGNÓSTICO: ARRITMIA CARDÍACA\n\n";
                $prescricao .= "CONDUTA:\n";
                $prescricao .= "1) MONITORIZAÇÃO CARDÍACA CONTÍNUA\n";
                $prescricao .= "2) ACESSO VENOSO\n\n";
                $prescricao .= "USO ORAL (SE TAQUICARDIA SUPRAVENTRICULAR):\n";
                $prescricao .= "1) PROPRANOLOL 10MG COMPRIMIDO------------------------------- 30 COMP\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.5, 1) . "MG 3X AO DIA\n\n";
                }
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "1) Eletrocardiograma\n";
                $prescricao .= "2) Holter 24h\n";
                $prescricao .= "3) Ecocardiograma\n";
                $prescricao .= "4) Eletrólitos\n";
                $prescricao .= "5) Função tireoidiana\n\n";
                $prescricao .= "SINAIS DE ALERTA:\n";
                $prescricao .= "- Síncope\n";
                $prescricao .= "- Palpitações intensas\n";
                $prescricao .= "- Dor torácica\n";
                $prescricao .= "- Dispneia\n";
                break;

            case 'cardiopatia congênita':
                $prescricao .= "DIAGNÓSTICO: CARDIOPATIA CONGÊNITA\n\n";
                $prescricao .= "CONDUTA:\n";
                $prescricao .= "1) INTERNAÇÃO EM UTI PEDIÁTRICA\n";
                $prescricao .= "2) MONITORIZAÇÃO CONTÍNUA\n";
                $prescricao .= "3) OXIGENIOTERAPIA\n\n";
                $prescricao .= "USO ORAL:\n";
                $prescricao .= "1) FUROSEMIDA 40MG COMPRIMIDO-------------------------------- 30 COMP\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 1, 1) . "MG 2X AO DIA\n\n";
                }
                $prescricao .= "2) CAPTOPRIL 25MG COMPRIMIDO--------------------------------- 30 COMP\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.5, 1) . "MG 3X AO DIA\n\n";
                }
                $prescricao .= "3) ESPIRONOLACTONA 25MG COMPRIMIDO-------------------------- 30 COMP\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 1, 1) . "MG 2X AO DIA\n\n";
                }
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "1) Ecocardiograma\n";
                $prescricao .= "2) Cateterismo cardíaco\n";
                $prescricao .= "3) Radiografia de tórax\n";
                $prescricao .= "4) Gasometria arterial\n";
                $prescricao .= "5) BNP\n\n";
                $prescricao .= "MONITORIZAÇÃO:\n";
                $prescricao .= "- Saturação de O2 contínua\n";
                $prescricao .= "- Sinais vitais a cada 2h\n";
                $prescricao .= "- Balanço hídrico rigoroso\n";
                $prescricao .= "- Peso diário\n";
                break;

            case 'diabetes tipo 1':
                $prescricao .= "CONDUTA INICIAL:\n";
                $prescricao .= "1) INSULINA REGULAR (AÇÃO RÁPIDA)--------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   DOSE INICIAL: " . number_format($peso * 0.5, 1) . " UI SC 4X AO DIA\n";
                }
                $prescricao .= "\n2) INSULINA NPH (AÇÃO INTERMEDIÁRIA)----------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   DOSE INICIAL: " . number_format($peso * 0.3, 1) . " UI SC 2X AO DIA\n";
                }
                $prescricao .= "\nMONITORIZAÇÃO:\n";
                $prescricao .= "- Glicemia capilar 4x ao dia\n";
                $prescricao .= "- Diário alimentar\n";
                $prescricao .= "- Retorno em 7 dias para ajuste\n";
                break;

            case 'hipotireoidismo':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) LEVOTIROXINA-------------------------------------------- 1 CAIXA\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 2, 1) . "MCG 1X AO DIA EM JEJUM\n";
                }
                $prescricao .= "\nEXAMES DE CONTROLE:\n";
                $prescricao .= "- TSH e T4 livre em 6-8 semanas\n";
                $prescricao .= "- Retorno com resultados\n";
                break;

            case 'puberdade precoce':
                $prescricao .= "CONDUTA:\n";
                $prescricao .= "1) ENCAMINHAR PARA ENDOCRINOLOGIA PEDIÁTRICA\n\n";
                $prescricao .= "EXAMES INICIAIS:\n";
                $prescricao .= "- LH, FSH, Estradiol/Testosterona\n";
                $prescricao .= "- Idade óssea\n";
                $prescricao .= "- Ultrassom pélvico (meninas)\n";
                break;

            case 'anemia ferropriva':
                $prescricao .= "USO ORAL\n";
                $prescricao .= "1) SULFATO FERROSO 25MG/ML GOTAS--------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 0.3, 0) . " GOTAS 1X AO DIA\n";
                }
                $prescricao .= "\nORIENTAÇÕES:\n";
                $prescricao .= "- Tomar com suco de laranja\n";
                $prescricao .= "- Evitar leite/café 2h antes e depois\n";
                $prescricao .= "- Retorno em 30 dias com hemograma\n";
                break;

            case 'púrpura trombocitopênica':
                $prescricao .= "CONDUTA INICIAL:\n";
                $prescricao .= "1) PREDNISONA 20MG COMPRIMIDO----------------------------- 1 CAIXA\n";
                if ($peso) {
                    $prescricao .= "   TOMAR " . number_format($peso * 2, 0) . "MG/DIA DIVIDIDO EM 2 DOSES\n";
                }
                $prescricao .= "\nMONITORIZAÇÃO:\n";
                $prescricao .= "- Hemograma semanal\n";
                $prescricao .= "- Evitar traumas\n";
                $prescricao .= "- Retorno em 7 dias\n";
                break;

            case 'neutropenia febril':
                $prescricao .= "CONDUTA DE EMERGÊNCIA:\n";
                $prescricao .= "1) INTERNAÇÃO HOSPITALAR\n\n";
                $prescricao .= "USO EV:\n";
                $prescricao .= "1) CEFEPIME 1G/FRASCO-------------------------------------- 1 FRASCO\n";
                if ($peso) {
                    $prescricao .= "   APLICAR " . number_format($peso * 50, 0) . "MG EV 8/8H\n";
                }
                $prescricao .= "\nMONITORIZAÇÃO:\n";
                $prescricao .= "- Hemograma diário\n";
                $prescricao .= "- Culturas (sangue, urina)\n";
                break;

            case 'sopro cardíaco':
                $prescricao .= "CONDUTA:\n";
                $prescricao .= "1) AVALIAÇÃO COM CARDIOLOGISTA PEDIÁTRICO\n\n";
                $prescricao .= "EXAMES SOLICITADOS:\n";
                $prescricao .= "- Ecocardiograma\n";
                $prescricao .= "- Eletrocardiograma\n";
                $prescricao .= "- Raio-X de tórax\n";
                break;

            case 'arritmia':
                $prescricao .= "CONDUTA:\n";
                $prescricao .= "1) ENCAMINHAR PARA CARDIOLOGIA PEDIÁTRICA\n\n";
                $prescricao .= "EXAMES INICIAIS:\n";
                $prescricao .= "- Eletrocardiograma\n";
                $prescricao .= "- Holter 24h\n";
                $prescricao .= "- Ecocardiograma\n";
                break;

            default:
                $prescricao .= "Prescrição em desenvolvimento. Por favor, consulte o médico para orientações específicas.\n";
        }
        
        $prescricao .= "\nData: " . date("d/m/Y") . "\n";
        $prescricao .= "\nRetorno: Em 24-48h se não houver melhora ou imediatamente se houver piora.\n";
        
        return $prescricao;
    }
}

class CalculadoraDoses {
    // Constantes para conversão
    const MG_POR_ML = 'mg/ml';
    const MG_POR_GOTA = 'mg/gota';
    const ML_POR_GOTA = 20; // Padrão: 20 gotas = 1ml

    /**
     * Calcula a dose baseada no peso e concentração
     */
    public static function calcularDose($peso, $concentracao, $medicamento) {
        // Verifica se o medicamento é de uso pediátrico
        if (!isset($medicamento['uso_pediatrico']) || !$medicamento['uso_pediatrico']) {
            return "Medicamento não recomendado para uso pediátrico - consulte um médico";
        }

        // Verifica se o peso está dentro dos limites aceitáveis
        if ($peso < 2 || $peso > 100) {
            return "Peso fora dos limites aceitáveis para cálculo pediátrico - consulte um médico";
        }

        $principio_ativo = strtolower(trim($medicamento['principio_ativo']));
        $forma = strtolower(trim($medicamento['forma_farmaceutica']));

        // Cálculo específico para cada medicamento
        switch(true) {
            case stripos($principio_ativo, 'paracetamol') !== false:
                return self::calcularParacetamol($peso, $medicamento);

            case stripos($principio_ativo, 'dipirona') !== false:
                return self::calcularDipirona($peso, $medicamento);

            case stripos($principio_ativo, 'ibuprofeno') !== false:
                return self::calcularIbuprofeno($peso, $medicamento);

            case stripos($principio_ativo, 'amoxicilina') !== false:
                return self::calcularAmoxicilina($peso, $medicamento);

            case stripos($principio_ativo, 'azitromicina') !== false:
                return self::calcularAzitromicina($peso, $medicamento);

            default:
                return "Medicamento sem protocolo de dosagem pediátrica definido - consulte um médico";
        }
    }

    /**
     * Cálculo específico para Paracetamol
     */
    private static function calcularParacetamol($peso, $medicamento) {
        $forma = strtolower($medicamento['forma_farmaceutica']);
        $concentracao = strtolower($medicamento['concentracao']);
        $prescricao = "USO ORAL\n";

        // Dose recomendada: 10-15 mg/kg/dose
        $dose_mg = $peso * 12; // usando 12mg/kg
        $dose_mg = min($dose_mg, 750); // Limite máximo por dose

        if (stripos($forma, 'gotas') !== false) {
            // Paracetamol Gotas 200mg/ml
            if (stripos($concentracao, '200') !== false) {
                $gotas = ceil($dose_mg / 200 * self::ML_POR_GOTA);
                $prescricao .= "1) PARACETAMOL 200MG/ML GOTAS--------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . $gotas . " GOTAS DE 6/6H SE DOR OU FEBRE\n";
            }
        }
        elseif (stripos($forma, 'xarope') !== false || stripos($forma, 'suspensão') !== false) {
            // Paracetamol Xarope/Suspensão 32mg/ml
            if (stripos($concentracao, '32') !== false) {
                $ml = number_format($dose_mg / 32, 1, ',', '');
                $prescricao .= "1) PARACETAMOL 32MG/ML SUSPENSÃO----------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . $ml . "ML DE 6/6H SE DOR OU FEBRE\n";
            }
        }
        elseif (stripos($forma, 'comprimido') !== false) {
            // Paracetamol Comprimido 500mg ou 750mg
            if (stripos($concentracao, '500') !== false) {
                $comp = ceil($dose_mg / 500);
                $prescricao .= "1) PARACETAMOL 500MG COMPRIMIDO----------------------------- 1 CAIXA\n";
                if ($comp <= 0.5) {
                    $prescricao .= "   TOMAR 1/2 COMPRIMIDO DE 6/6H SE DOR OU FEBRE\n";
                } else {
                    $prescricao .= "   TOMAR " . $comp . " COMPRIMIDO(S) DE 6/6H SE DOR OU FEBRE\n";
                }
            }
        }

        return $prescricao;
    }

    /**
     * Cálculo específico para Dipirona
     */
    private static function calcularDipirona($peso, $medicamento) {
        $forma = strtolower($medicamento['forma_farmaceutica']);
        $concentracao = strtolower($medicamento['concentracao']);
        $prescricao = "USO ORAL\n";

        // Dose recomendada: 10-15 mg/kg/dose
        $dose_mg = $peso * 15;
        $dose_mg = min($dose_mg, 1000); // Limite máximo por dose

        if (stripos($forma, 'gotas') !== false) {
            // Dipirona Gotas 500mg/ml
            if (stripos($concentracao, '500') !== false) {
                $gotas = ceil($dose_mg / 500 * self::ML_POR_GOTA);
                $prescricao .= "1) DIPIRONA 500MG/ML GOTAS----------------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . $gotas . " GOTAS DE 6/6H SE DOR OU FEBRE\n";
            }
        }
        elseif (stripos($forma, 'solução oral') !== false) {
            // Dipirona Solução Oral 50mg/ml
            if (stripos($concentracao, '50') !== false) {
                $ml = number_format($dose_mg / 50, 1, ',', '');
                $prescricao .= "1) DIPIRONA 50MG/ML SOLUÇÃO ORAL---------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . $ml . "ML DE 6/6H SE DOR OU FEBRE\n";
            }
        }

        return $prescricao;
    }

    /**
     * Cálculo específico para Ibuprofeno
     */
    private static function calcularIbuprofeno($peso, $medicamento) {
        $forma = strtolower($medicamento['forma_farmaceutica']);
        $concentracao = strtolower($medicamento['concentracao']);
        $prescricao = "USO ORAL\n";

        // Dose recomendada: 5-10 mg/kg/dose
        $dose_mg = $peso * 10;
        $dose_mg = min($dose_mg, 400); // Limite máximo por dose

        if (stripos($forma, 'suspensão') !== false || stripos($forma, 'gotas') !== false) {
            // Ibuprofeno Suspensão/Gotas 50mg/ml
            if (stripos($concentracao, '50') !== false) {
                $ml = number_format($dose_mg / 50, 1, ',', '');
                $prescricao .= "1) IBUPROFENO 50MG/ML SUSPENSÃO----------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . $ml . "ML DE 8/8H SE DOR OU FEBRE\n";
            }
        }
        elseif (stripos($forma, 'comprimido') !== false) {
            // Ibuprofeno Comprimido 100mg
            if (stripos($concentracao, '100') !== false) {
                $comp = ceil($dose_mg / 100);
                $prescricao .= "1) IBUPROFENO 100MG COMPRIMIDO------------------------------ 1 CAIXA\n";
                $prescricao .= "   TOMAR " . $comp . " COMPRIMIDO(S) DE 8/8H SE DOR OU FEBRE\n";
            }
        }

        return $prescricao;
    }

    /**
     * Cálculo específico para Amoxicilina
     */
    private static function calcularAmoxicilina($peso, $medicamento) {
        $forma = strtolower($medicamento['forma_farmaceutica']);
        $concentracao = strtolower($medicamento['concentracao']);
        $prescricao = "USO ORAL\n";

        // Dose recomendada: 50 mg/kg/dia dividido em 3 doses
        $dose_dia_mg = $peso * 50;
        $dose_mg = $dose_dia_mg / 3;
        $dose_mg = min($dose_mg, 500); // Limite máximo por dose

        if (stripos($forma, 'suspensão') !== false) {
            // Amoxicilina Suspensão 250mg/5ml ou 400mg/5ml
            if (stripos($concentracao, '250') !== false) {
                $ml = number_format($dose_mg / 50, 1, ',', '');
                $prescricao .= "1) AMOXICILINA 250MG/5ML SUSPENSÃO-------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . $ml . "ML DE 8/8H POR 7-10 DIAS\n";
            }
        }
        elseif (stripos($forma, 'cápsula') !== false || stripos($forma, 'comprimido') !== false) {
            // Amoxicilina Cápsula/Comprimido 500mg
            if (stripos($concentracao, '500') !== false) {
                $comp = ceil($dose_mg / 500);
                $prescricao .= "1) AMOXICILINA 500MG CÁPSULA-------------------------------- 1 CAIXA\n";
                if ($comp <= 0.5) {
                    $prescricao .= "   TOMAR 1/2 CÁPSULA DE 8/8H POR 7-10 DIAS\n";
                } else {
                    $prescricao .= "   TOMAR " . $comp . " CÁPSULA(S) DE 8/8H POR 7-10 DIAS\n";
                }
            }
        }

        return $prescricao;
    }

    /**
     * Cálculo específico para Azitromicina
     */
    private static function calcularAzitromicina($peso, $medicamento) {
        $forma = strtolower($medicamento['forma_farmaceutica']);
        $concentracao = strtolower($medicamento['concentracao']);
        $prescricao = "USO ORAL\n";

        // Dose recomendada: 10 mg/kg uma vez ao dia
        $dose_mg = $peso * 10;
        $dose_mg = min($dose_mg, 500); // Limite máximo por dose

        if (stripos($forma, 'suspensão') !== false) {
            // Azitromicina Suspensão 200mg/5ml
            if (stripos($concentracao, '200') !== false) {
                $ml = number_format($dose_mg * 5 / 200, 1, ',', '');
                $prescricao .= "1) AZITROMICINA 200MG/5ML SUSPENSÃO------------------------- 1 FRASCO\n";
                $prescricao .= "   TOMAR " . $ml . "ML 1X AO DIA POR 3-5 DIAS\n";
            }
        }
        elseif (stripos($forma, 'comprimido') !== false) {
            // Azitromicina Comprimido 500mg
            if (stripos($concentracao, '500') !== false) {
                $comp = ceil($dose_mg / 500);
                $prescricao .= "1) AZITROMICINA 500MG COMPRIMIDO---------------------------- 1 CAIXA\n";
                $prescricao .= "   TOMAR " . $comp . " COMPRIMIDO(S) 1X AO DIA POR 3-5 DIAS\n";
            }
        }

        return $prescricao;
    }
} 