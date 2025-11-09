<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../banco/db.php';

// Obtém o ID do voluntário a partir da URL usando o método GET
$id = $_GET['id'] ?? null;

// Busca os dados atuais do voluntário
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM voluntario WHERE voluntario_id = ?");
    $stmt->execute([$id]);
    $voluntario = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome_voluntario'];
    $funcao = $_POST['funcao'];

    // Atualiza os dados do voluntário
    $stmt = $pdo->prepare("UPDATE voluntario SET nome_voluntario = ?, funcao = ? WHERE voluntario_id = ?");
    $stmt->execute([$nome, $funcao, $id]);

    // Redireciona após a atualização
    header('Location: index_voluntarios.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Voluntário</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Gerenciamento de Voluntários</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="index_voluntarios.php">Listar Voluntários</a></li>
                <li><a href="create_voluntario.php">Adicionar Voluntário</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Editar Voluntário</h2>

        <?php if (!empty($voluntario)): ?>
            <form method="POST">
                <label for="nome_voluntario">Nome:</label>
                <input 
                    type="text" 
                    id="nome_voluntario" 
                    name="nome_voluntario" 
                    value="<?= htmlspecialchars($voluntario['nome_voluntario']) ?>" 
                    required
                >

                <label for="funcao">Função:</label>
                <input 
                    type="text" 
                    id="funcao" 
                    name="funcao" 
                    value="<?= htmlspecialchars($voluntario['funcao']) ?>" 
                    required
                >

                <button type="submit">Atualizar</button>
            </form>
        <?php else: ?>
            <p>Voluntário não encontrado.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 - Sistema de Gerenciamento da Horta Comunitária</p>
    </footer>
</body>
</html>
