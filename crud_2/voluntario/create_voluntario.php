<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'db.php';

// Verifica se o formulário foi submetido através do método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados enviados pelo formulário
    $nome = $_POST['nome_voluntario'];
   
    
    // Prepara a instrução SQL para inserir um novo aluno no banco de dados
    $stmt = $pdo->prepare("INSERT INTO voluntario (nome_voluntario) VALUES (?)");
    
    // Executa a instrução SQL com os dados do formulário
    $stmt->execute([$nome]);
    
    // Redireciona para a página de listagem de alunos após a inserção
    header('Location: index_voluntarios.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Voluntário</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Gerenciamento de Voluntário da Horta Comunitária</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="index_voluntarios.php">Listar Voluntários</a></li>
                <li><a href="create_voluntario.php">Adicionar Voluntários</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Adicionar Volutário</h2>
        <!-- Formulário para adicionar um novo aluno -->
        <form method="POST">
            <label for="nome_voluntario">Nome:</label>
            <!-- Campo para inserir o nome do aluno -->
            <input type="text" id="nome_voluntario" name="nome_voluntario" required>
            
            <!-- Botão para submeter o formulário -->
            <button type="submit">Adicionar</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 - Sistema de Gerenciamento da Horta Comunitária</p>
    </footer>
</body>
</html>
