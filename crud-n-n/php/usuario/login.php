<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nome'] = $user['nome'];
        $_SESSION['usuario_foto'] = $user['foto']; 
        
        header("Location: ../../index.php"); 
        exit;
    } else {
        $erro = "Usuário ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema Hospitalar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-96">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Login</h2>
        
        <?php if(isset($erro)): ?>
            <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm border border-red-200"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form method="POST" class="space-y-5">
            <input type="email" name="email" placeholder="E-mail" required class="w-full border p-3 rounded-xl outline-none focus:border-blue-500 transition">
            <input type="password" name="senha" placeholder="Senha" required class="w-full border p-3 rounded-xl outline-none focus:border-blue-500 transition">
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold text-lg hover:bg-blue-700 transform active:scale-95 transition">Entrar</button>
        </form>
        <div class="mt-6 text-center text-sm text-gray-500">
            Ainda não tem acesso? <a href="create-usuario.php" class="text-blue-600 font-bold hover:underline">Solicitar Cadastro</a>
        </div>
    </div>
</body>
</html>