USE medicamentos_pediatricos;

-- Inserção de medicamentos básicos pediátricos
INSERT INTO medicamentos 
(codigo_catmat, principio_ativo, concentracao, forma_farmaceutica, unidade_fornecimento, uso_pediatrico, faixa_etaria_minima, faixa_etaria_maxima, dose_minima, dose_maxima, unidade_dose, observacoes) 
VALUES
-- Analgésicos/Antitérmicos
('BR0267502', 'Ácido Acetilsalicílico', '100 mg', 'Comprimido', 'Comprimido', true, '12 anos', '18 anos', 100, 500, 'mg', 'Não recomendado para crianças menores de 12 anos devido ao risco de Síndrome de Reye'),
('BR0267517', 'Paracetamol', '200 mg/ml', 'Solução Oral', 'Frasco 15ml', true, '0 meses', '12 anos', 10, 15, 'mg/kg', 'Medicamento de primeira escolha para febre em pediatria'),
('BR0267778', 'Ibuprofeno', '100 mg/ml', 'Suspensão Oral', 'Frasco 20ml', true, '6 meses', '12 anos', 5, 10, 'mg/kg', 'Administrar preferencialmente após alimentação');

-- Inserção de vias de administração
INSERT INTO vias_administracao (medicamento_id, via) VALUES
(1, 'Oral'),
(2, 'Oral'),
(3, 'Oral');

-- Inserção de efeitos colaterais comuns
INSERT INTO efeitos_colaterais (medicamento_id, efeito, frequencia) VALUES
(1, 'Irritação gástrica', 'Comum'),
(1, 'Sangramento aumentado', 'Incomum'),
(2, 'Náusea', 'Incomum'),
(2, 'Hepatotoxicidade em altas doses', 'Raro'),
(3, 'Dor abdominal', 'Comum'),
(3, 'Náusea', 'Comum');

-- Inserção de interações medicamentosas
INSERT INTO interacoes_medicamentosas (medicamento_id1, medicamento_id2, descricao, severidade) VALUES
(1, 2, 'Aumento do risco de sangramento', 'Moderada'),
(1, 3, 'Aumento do risco de úlcera gástrica', 'Grave'); 