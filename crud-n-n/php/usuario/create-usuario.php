<?php
include '../db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    
    
    $diretorio_storage = __DIR__ . '/../storage/';
    $foto_nome = 'profile.jpg';

   
    if (!is_dir($diretorio_storage)) {
        mkdir($diretorio_storage, 0777, true);
    }

    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $extensao = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $novo_nome = bin2hex(random_bytes(10)) . "." . $extensao;
        
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio_storage . $novo_nome)) {
            $foto_nome = $novo_nome;
        }
    }

    $sql = "INSERT INTO usuarios (nome, email, senha, foto) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$nome, $email, $senha, $foto_nome])) {
        header("Location: login.php?sucesso=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Sistema Hospitalar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Criar Conta ADM</h2>
        
        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nome Completo</label>
                <input type="text" name="nome" required class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" name="email" required class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Senha</label>
                <input type="password" name="senha" required class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Foto de Perfil</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition shadow-md">Cadastrar</button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-600">Já tem conta? <a href="login.php" class="text-blue-600 hover:underline">Faça login</a></p>
    </div>
</body>
</html>