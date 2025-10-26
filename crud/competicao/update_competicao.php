<?php
require_once("../config/db.php");

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    die("ID não informado!");
}

$id = $_GET['id'];

// Busca os dados da competição
$stmt = $pdo->prepare("SELECT * FROM competicao WHERE competicao_id = ?");
$stmt->execute([$id]);
$competicao = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$competicao) {
    die("Competição não encontrada!");
}

// Atualiza os dados se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $local_comp = $_POST['local_comp'];
    $data_comp = $_POST['data_comp'];
    $tema = $_POST['tema'];

    $sql = "UPDATE competicao 
            SET nome = ?, local_comp = ?, data_comp = ?, tema = ?
            WHERE competicao_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $local_comp, $data_comp, $tema, $id]);

    header("Location: read_competicao.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Competição</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Competição</h1>

    <form method="post" class="space-y-4">
        <div>
            <label class="block text-gray-700 font-medium mb-1">Nome:</label>
            <input type="text" name="nome" required 
                   value="<?= htmlspecialchars($competicao['nome']) ?>"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Local da Competição:</label>
            <input type="text" name="local_comp" 
                   value="<?= htmlspecialchars($competicao['local_comp']) ?>"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Data da Competição:</label>
            <input type="date" name="data_comp" 
                   value="<?= htmlspecialchars($competicao['data_comp']) ?>"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Tema:</label>
            <input type="text" name="tema" 
                   value="<?= htmlspecialchars($competicao['tema']) ?>"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" 
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded transition-colors">
            Atualizar
        </button>
    </form>

    <a href="read_competicao.php"
       class="mt-4 inline-block text-blue-500 hover:underline">Voltar</a>
</div>

</body>
</html>
