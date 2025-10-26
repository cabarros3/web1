<?php
require_once("../config/db.php");

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    die("ID não informado!");
}

$id = $_GET['id'];

// Busca os dados do grupo
$stmt = $pdo->prepare("SELECT * FROM grupo WHERE grupo_id = ?");
$stmt->execute([$id]);
$grupo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$grupo) {
    die("Grupo não encontrado!");
}

// Atualiza os dados se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $ano = $_POST['ano_debut'];
    $empresa = $_POST['empresa'];
    $pais = $_POST['pais'];
    $membros = $_POST['membros'];

    $sql = "UPDATE grupo 
            SET nome = ?, ano_debut = ?, empresa = ?, pais = ?, membros = ?
            WHERE grupo_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $ano, $empresa, $pais, $membros, $id]);

    header("Location: read_grupos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Grupo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Grupo</h1>

    <form method="post" class="space-y-4">
        <div>
            <label class="block text-gray-700 font-medium mb-1">Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($grupo['nome']) ?>" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Ano de debut:</label>
            <input type="number" name="ano_debut" value="<?= htmlspecialchars($grupo['ano_debut']) ?>"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Empresa:</label>
            <input type="text" name="empresa" value="<?= htmlspecialchars($grupo['empresa']) ?>"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">País:</label>
            <input type="text" name="pais" value="<?= htmlspecialchars($grupo['pais']) ?>"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Membros:</label>
            <input type="number" name="membros" value="<?= htmlspecialchars($grupo['membros']) ?>"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded transition-colors">
            Atualizar
        </button>
    </form>

    <a href="read_grupos.php"
       class="mt-4 inline-block text-blue-500 hover:underline">Voltar</a>
</div>

</body>
</html>
