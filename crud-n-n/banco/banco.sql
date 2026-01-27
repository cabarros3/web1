CREATE DATABASE hospital;
use hospital;


-- Tabela Médico
CREATE TABLE medico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especialidade VARCHAR(100)
);

-- Tabela Paciente
CREATE TABLE paciente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    tipo_sanguineo VARCHAR(3)
);

-- Tabela Consulta (relacionamento N:N)
CREATE TABLE consulta (
    id_medico INT NOT NULL,
    id_paciente INT NOT NULL,
    data_hora DATETIME NOT NULL,
    observacoes TEXT,

    -- Chave primária composta
    PRIMARY KEY (id_medico, id_paciente, data_hora),

    -- Chaves estrangeiras
    CONSTRAINT fk_consulta_medico
        FOREIGN KEY (id_medico) REFERENCES medico(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_consulta_paciente
        FOREIGN KEY (id_paciente) REFERENCES paciente(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);


CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    foto VARCHAR(255) DEFAULT 'default-adm.png',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);