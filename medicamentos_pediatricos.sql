CREATE DATABASE IF NOT EXISTS medicamentos_pediatricos;
USE medicamentos_pediatricos;

CREATE TABLE IF NOT EXISTS medicamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_catmat VARCHAR(10),
    principio_ativo VARCHAR(255),
    concentracao VARCHAR(100),
    forma_farmaceutica VARCHAR(100),
    unidade_fornecimento VARCHAR(100),
    uso_pediatrico BOOLEAN,
    faixa_etaria_minima VARCHAR(50),
    faixa_etaria_maxima VARCHAR(50),
    dose_minima DECIMAL(10,2),
    dose_maxima DECIMAL(10,2),
    unidade_dose VARCHAR(20),
    observacoes TEXT,
    contraindicacoes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS vias_administracao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    medicamento_id INT,
    via VARCHAR(50),
    FOREIGN KEY (medicamento_id) REFERENCES medicamentos(id)
);

CREATE TABLE IF NOT EXISTS interacoes_medicamentosas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    medicamento_id1 INT,
    medicamento_id2 INT,
    descricao TEXT,
    severidade ENUM('Leve', 'Moderada', 'Grave'),
    FOREIGN KEY (medicamento_id1) REFERENCES medicamentos(id),
    FOREIGN KEY (medicamento_id2) REFERENCES medicamentos(id)
);

CREATE TABLE IF NOT EXISTS efeitos_colaterais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    medicamento_id INT,
    efeito VARCHAR(255),
    frequencia ENUM('Muito comum', 'Comum', 'Incomum', 'Raro', 'Muito raro'),
    FOREIGN KEY (medicamento_id) REFERENCES medicamentos(id)
);

-- Índices para otimização de consultas
CREATE INDEX idx_codigo_catmat ON medicamentos(codigo_catmat);
CREATE INDEX idx_principio_ativo ON medicamentos(principio_ativo);
CREATE INDEX idx_uso_pediatrico ON medicamentos(uso_pediatrico); 