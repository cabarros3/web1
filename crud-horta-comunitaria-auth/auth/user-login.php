<?php
require_once '..banco/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Captura os dados do formulário (agora Email e Senha)
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // 2. Busca o usuário pelo EMAIL na tabela 'usuarios'
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 3. Verifica a senha usando a coluna 'senha' do banco
    if ($user && password_verify($senha, $user['senha'])) {
        // Login com sucesso: define as variáveis de sessão
        // Supomos que existe uma coluna 'id' auto-increment (padrão)
        $_SESSION['user_id'] = $user['id']; 
        $_SESSION['nome'] = $user['nome']; // Salva o nome para exibir no menu
        
        header('Location: /index.php');
        exit;
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Gerenciamento de Alunos</h1>
        <nav>
            <ul>
                <li><a href="/index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/php/index-aluno.php">Listar Alunos</a></li>
                    <li><a href="/php/create-aluno.php">Adicionar Aluno</a></li>
                    <li><a href="/php/logout.php">Logout (<?= htmlspecialchars($_SESSION['nome']) ?>)</a></li>
                <?php else: ?>
                    <li><a href="auth/user-login.php">Login</a></li>
                    <li><a href="auth/user-register.php">Registrar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    
        <h1>Login</h1>
    </header>
    <main>
        <?php if (isset($erro)): ?>
            <p style="color: red;"><?= $erro; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required placeholder="Digite seu e-mail">
            
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            
            <button type="submit">Login</button>
        </form>
    </main>
</body>
</html>