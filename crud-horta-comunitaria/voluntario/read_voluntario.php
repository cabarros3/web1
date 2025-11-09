<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once '../banco/db.php';

    // Obtém o ID do aluno a partir da URL usando o método GET
    $id = $_GET['id'];

    // Prepara a instrução SQL para selecionar o aluno pelo ID
    $stmt = $pdo->prepare("SELECT * FROM voluntario WHERE voluntario_id = ?");
    // Executa a instrução SQL, passando o ID do aluno como parâmetro
    $stmt->execute([$id]);

    // Recupera os dados do aluno como um array associativo
    $voluntario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Voluntário</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Gerenciamento de Voluntarios</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="index_voluntarios.php">Listar Voluntarios</a></li>
                <li><a href="create_voluntario.php">Adicionar Voluntarios</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Detalhes do Voluntarios</h2>
        <?php if ($voluntario): ?>
            <!-- Exibe os detalhes do aluno -->
            <p><strong>ID:</strong> <?= $voluntario['voluntario_id'] ?></p>
            <p><strong>Nome:</strong> <?= $voluntario['nome_voluntario'] ?></p>
            <p><strong>Função:</strong> <?= $voluntario['funcao'] ?></p>
            <p>
                <!-- Links para editar e excluir o aluno -->
                <a href="update_voluntario.php?id=<?= $voluntario['voluntario_id'] ?>">Editar</a>
                <a href="delete_voluntario.php?id=<?= $voluntario['voluntario_id'] ?>">Excluir</a>
            </p>
        <?php else: ?>
            <!-- Exibe uma mensagem caso o aluno não seja encontrado -->
            <p>Voluntario não encontrado.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 - Sistema de Gerenciamento de Alunos</p>
    </footer>
</body>
</html>
