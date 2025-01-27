USE medicamentos_pediatricos;

-- Tabela de categorias terapêuticas
CREATE TABLE IF NOT EXISTS categorias_terapeuticas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    descricao TEXT
);

-- Adicionar campo de categoria na tabela medicamentos
ALTER TABLE medicamentos
ADD COLUMN categoria_id INT,
ADD COLUMN peso_minimo DECIMAL(10,2),
ADD COLUMN peso_maximo DECIMAL(10,2),
ADD COLUMN idade_minima_meses INT,
ADD COLUMN idade_maxima_meses INT,
ADD COLUMN restricoes TEXT,
ADD COLUMN fonte_dados VARCHAR(255),
ADD FOREIGN KEY (categoria_id) REFERENCES categorias_terapeuticas(id);

-- Inserir categorias terapêuticas básicas
INSERT INTO categorias_terapeuticas (nome, descricao) VALUES
('Analgésicos/Antitérmicos', 'Medicamentos para dor e febre'),
('Antibióticos', 'Medicamentos para tratamento de infecções bacterianas'),
('Anti-histamínicos', 'Medicamentos para alergias e reações alérgicas'),
('Antieméticos', 'Medicamentos para náusea e vômito'),
('Broncodilatadores', 'Medicamentos para asma e problemas respiratórios'),
('Corticosteroides', 'Anti-inflamatórios esteroidais'),
('Vitaminas', 'Suplementos vitamínicos'),
('Antiparasitários', 'Medicamentos para parasitas e vermes'),
('Antitussígenos', 'Medicamentos para tosse'),
('Probióticos', 'Suplementos para flora intestinal'); 