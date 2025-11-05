<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'db.php';

// Obtém o ID do aluno a partir da URL usando o método GET
$id = $_GET['id'];

// Prepara a instrução SQL para selecionar o aluno pelo ID
$stmt = $pdo->prepare("SELECT * FROM voluntario WHERE voluntario_id = ?");

// Executa a instrução SQL, passando o ID do aluno como parâmetro
$stmt->execute([$id]);

// Recupera os dados do aluno como um array associativo
$voluntario = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o formulário foi submetido através do método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados enviados pelo formulário
    $nome = $_POST['nome_voluntario'];
    
    // Prepara a instrução SQL para atualizar os dados do aluno
    $stmt = $pdo->prepare("UPDATE voluntario SET nome_voluntario = ? WHERE id = ?");
    
    // Executa a instrução SQL com os novos dados do formulário
    $stmt->execute([$nome, $id]);
    
    // Redireciona para a página de listagem de alunos após a atualização
    header('Location: index_voluntarios.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Voluntarios</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Gerenciamento de Voluntarios</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="index_voluntarios.php">Listar Voluntarios</a></li>
                <li><a href="create_voluntario.php">Adicionar Voluntario</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Editar Aluno</h2>
        <!-- Formulário para editar os dados do aluno -->
        <form method="POST">
            <label for="nome_voluntario">Nome:</label>
            <!-- Campo para inserir o nome do aluno -->
            <input type="text" id="nome_voluntario" name="nome_voluntario" value="<?= $voluntario['nome_voluntario'] ?>" required>
            
            <!-- Botão para submeter o formulário -->
            <button type="submit">Atualizar</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 - Sistema de Gerenciamento de Alunos</p>
    </footer>
</body>
</html>
