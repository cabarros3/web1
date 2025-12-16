<?php

require_once '../db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $dataNascimento = $_POST['data_nascimento'];
    $tipo_sanguineo = $_POST['tipo_sanguineo'];

    
    $stmt = $pdo->prepare("INSERT INTO paciente (nome, data_nascimento, tipo_sanguineo) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $dataNascimento, $tipo_sanguineo]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Paciente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 max-w-lg">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Adicionar Paciente</h1>
            
            <form method="POST">
                <div class="mb-4">
                    <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                    <input type="text" id="nome" name="nome" required 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>

                <div class="mb-4">
                    <label for="data_nascimento" class="block text-gray-700 text-sm font-bold mb-2">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" required 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>

                <div class="mb-6">
                    <label for="tipo_sanguineo" class="block text-gray-700 text-sm font-bold mb-2">Tipo Sanguíneo:</label>
                    <input type="text" id="tipo_sanguineo" name="tipo_sanguineo" maxlength="3" placeholder="Ex: O+" required 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" 
                            class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                        Salvar
                    </button>
                    <a href="index.php" class="inline-block align-baseline font-bold text-sm text-teal-600 hover:text-teal-800">
                        Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>