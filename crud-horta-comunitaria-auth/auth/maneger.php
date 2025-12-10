<?php
require_once '../banco/db.php';
session_start();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Gerenciamento de Alunos</h1>
        <nav>
            <ul>
                <li><a href="/index.php">Home</a></li>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <li><a href="/voluntario/index_voluntarios.php">Listar Voluntários</a></li>
                    <li><a href="/voluntario/create_voluntario.php">Adicionar voluntários</a></li>
                    <li><a href="/auth/logout.php">Logout (<?= htmlspecialchars($_SESSION['nome']) ?>)</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>