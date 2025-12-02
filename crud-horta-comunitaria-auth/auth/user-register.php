<?php
require_once './banco/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Captura os dados correspondentes às colunas do seu banco
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Criptografa a senha

    // 2. Verifica se o EMAIL já existe (pois ele é Unique/UNI no banco)
    // Nota: Padronizei o nome da tabela para 'usuarios'. Verifique se está correto.
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo "Este email já está cadastrado!";
    } else {
        // 3. Insere o novo usuário com as colunas corretas (nome, email, senha)
        $stmt = $pdo->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
        
        if ($stmt->execute([$nome, $email, $senha])) {
            echo "Usuário registrado com sucesso!";
            // Redireciona para o login após sucesso
            header('Location: user-login.php');
            exit; // É boa prática colocar exit após header
        } else {
            echo "Erro ao registrar usuário.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuário</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Registrar Usuário</h1>
    </header>
    <main>
        <form method="POST">
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required placeholder="Digite seu nome">
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required placeholder="Digite seu e-mail">

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required placeholder="Crie uma senha">

            <button type="submit">Registrar</button>
        </form>
    </main>
</body>
</html>