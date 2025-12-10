<?php
require_once '../db.php';

// Buscar médicos
$stmt = $pdo->query("SELECT id, nome FROM medico");
$medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar pacientes
$stmt = $pdo->query("SELECT id, nome FROM paciente");
$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_medico = $_POST['id_medico'];
    $id_paciente = $_POST['id_paciente'];
    $data_hora = $_POST['data_hora'];
    $observacoes = $_POST['observacoes'];

    $stmt = $pdo->prepare("
        INSERT INTO consulta (id_medico, id_paciente, data_hora, observacoes) 
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([$id_medico, $id_paciente, $data_hora, $observacoes]);

    header('Location: index.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Consulta</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Adicionar Consulta</h1>
    </header>

    <main>
        <form method="POST">

            <label for="id_medico">Médico:</label>
            <select id="id_medico" name="id_medico" required>
                <option value="">Selecione</option>
                <?php foreach ($medicos as $m): ?>
                    <option value="<?= $m['id'] ?>"><?= $m['nome'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="id_paciente">Paciente:</label>
            <select id="id_paciente" name="id_paciente" required>
                <option value="">Selecione</option>
                <?php foreach ($pacientes as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= $p['nome'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="data_hora">Data e Hora:</label>
            <input type="datetime-local" id="data_hora" name="data_hora" required>

            <label for="observacoes">Observações:</label>
            <textarea id="observacoes" name="observacoes"></textarea>

            <button type="submit">Adicionar</button>
        </form>
    </main>
</body>
</html>
