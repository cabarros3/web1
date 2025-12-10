<?php
require_once '../db.php';


$stmt = $pdo->query("SELECT id, nome, data_nascimento, tipo_sanguineo FROM paciente");
$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $dataNascimento = $_POST['data_nascimento'];
    $tipo_sanguineo = $_POST['tipo_sanguineo'];

   
    $stmt = $pdo->prepare("INSERT INTO paciente (nome, data_nascimento, tipo_sanguineo) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $dataNascimento, $tipo_sanguineo ,$id]);

    header('Location: index-aluno.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Paciente</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Adicionar Paciente</h1>
    </header>
    <main>
        <form method="POST">
            
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>

            <label for="tipo_sanguineo">Tipo Sanguíneo:</label>
            <input type="text" id="tipo_sanguineo" name="tipo_sanguineo" maxlength="3" placeholder="Ex: O+, A-, AB+" required>

            <button type="submit">Adicionar</button>
        </form>
    </main>
</body>
</html>
