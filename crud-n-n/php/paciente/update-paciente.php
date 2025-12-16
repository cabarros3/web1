<?php

require_once '../db.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $dataNascimento = $_POST['data_nascimento'];
    $tipoSanguineo = $_POST['tipo_sanguineo'];

    $stmt = $pdo->prepare("UPDATE paciente SET nome = ?, data_nascimento = ?, tipo_sanguineo = ? WHERE id = ?");
    $stmt->execute([$nome, $dataNascimento, $tipoSanguineo, $id]);

    header('Location: index.php');
    exit;
}


$stmt = $pdo->prepare("SELECT * FROM paciente WHERE id = ?");
$stmt->execute([$id]);
$paciente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$paciente) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Paciente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 max-w-lg">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Paciente</h1>
            
            <form method="POST">
                <div class="mb-4">
                    <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                    <input type="text" id="nome" name="nome" 
                           value="<?= htmlspecialchars($paciente['nome']); ?>" required 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>

                <div class="mb-4">
                    <label for="data_nascimento" class="block text-gray-700 text-sm font-bold mb-2">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" 
                           value="<?= $paciente['data_nascimento']; ?>" required 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>

                <div class="mb-6">
                    <label for="tipo_sanguineo" class="block text-gray-700 text-sm font-bold mb-2">Tipo Sanguíneo:</label>
                    <input type="text" id="tipo_sanguineo" name="tipo_sanguineo" maxlength="3"
                           value="<?= htmlspecialchars($paciente['tipo_sanguineo']); ?>" required 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" 
                            class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                        Atualizar
                    </button>
                    <a href="index.php" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>