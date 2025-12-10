INSERT INTO medico (nome, especialidade) VALUES
('Dr. João Almeida', 'Cardiologia'),
('Dra. Maria Silva', 'Pediatria'),
('Dr. Ricardo Torres', 'Ortopedia'),
('Dra. Helena Duarte', 'Dermatologia');


INSERT INTO paciente (nome, data_nascimento, tipo_sanguineo) VALUES
('Ana Barbosa', '1990-03-12', 'A+'),
('Carlos Mendes', '1985-11-22', 'O-'),
('Fernanda Costa', '2005-07-01', 'B+'),
('Rafael Gomes', '1978-02-18', 'AB-');


INSERT INTO consulta (id_medico, id_paciente, data_hora, observacoes) VALUES
(1, 1, '2025-01-10 14:00:00', 'Avaliação inicial de rotina.'),
(1, 2, '2025-01-11 10:30:00', 'Paciente com dor no peito; solicitado ECG.'),
(2, 3, '2025-01-12 09:00:00', 'Acompanhamento pediátrico anual.'),
(3, 2, '2025-01-15 16:00:00', 'Dor no joelho; recomendado raio-X.'),
(4, 1, '2025-01-20 13:40:00', 'Tratamento para alergia na pele.'),
(2, 4, '2025-01-21 11:15:00', 'Check-up infantil tardio.'),
(3, 4, '2025-01-22 15:00:00', 'Lesão no ombro; fisioterapia recomendada.');
