<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'db.php';

// Executa a consulta para obter todos os alunos
$stmt = $pdo->query("SELECT * FROM voluntario");
// Recupera todos os resultados da consulta como um array associativo
$voluntarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Voluntarios</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Gerenciamento de Voluntários</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="index_voluntarios.php">Listar Voluntários</a></li>
                <li><a href="create_voluntario.php">Adicionar Voluntários</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Lista de Voluntários</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <!-- Itera sobre os alunos e cria uma linha para cada aluno na tabela -->
                <?php foreach ($voluntarios as $voluntario): ?>
                    <tr>
                        <!-- Exibe os dados do aluno -->
                        <td><?= $voluntario['voluntario_id'] ?></td>
                        <td><?= $voluntario['nome_voluntario'] ?></td>
                        <td>
                            <!-- Links para visualizar, editar e excluir o voluntario$voluntario -->
                            <a href="read_voluntario.php?id=<?= $voluntario['voluntario_id'] ?>">Visualizar</a>
                            <a href="update_voluntario.php?id=<?= $voluntario['voluntario_id'] ?>">Editar</a>
                            <a href="delete_voluntario.php?id=<?= $voluntario['voluntario_id'] ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2024 - Sistema de Gerenciamento de Alunos</p>
    </footer>
</body>
</html>
