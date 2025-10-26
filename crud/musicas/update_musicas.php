<?php
require_once("../config/db.php");

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    die("ID da música não informado!");
}

$id = $_GET['id'];

// Buscar a música para preencher o formulário
$stmt = $pdo->prepare("SELECT * FROM musica WHERE musica_id = ?");
$stmt->execute([$id]);
$musica = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$musica) {
    die("Música não encontrada!");
}

// Buscar todos os grupos para o select
$stmt2 = $pdo->query("SELECT * FROM grupo");
$grupos = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// Atualizar música quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grupo_id = $_POST['grupo_id'];
    $titulo = $_POST['titulo'];
    $ano_lancamento = $_POST['ano_lancamento'];
    $album = $_POST['album'];

    $sql = "UPDATE musica SET grupo_id = ?, titulo = ?, ano_lancamento = ?, album = ? WHERE musica_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$grupo_id, $titulo, $ano_lancamento, $album, $id]);

    header("Location: read_musica.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Música</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Música</h1>

    <form method="post" class="space-y-4">
        <div>
            <label class="block text-gray-700 font-medium mb-1">Grupo:</label>
            <select name="grupo_id" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Selecione o grupo</option>
                <?php foreach ($grupos as $grupo): ?>
                    <option value="<?= $grupo['grupo_id'] ?>" <?= $grupo['grupo_id'] == $musica['grupo_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($grupo['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Título da Música:</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($musica['titulo']) ?>" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Ano de Lançamento:</label>
            <input type="number" name="ano_lancamento" min="1900" max="<?= date('Y') ?>"
                   value="<?= htmlspecialchars($musica['ano_lancamento']) ?>"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Álbum:</label>
            <input type="text" name="album" value="<?= htmlspecialchars($musica['album']) ?>"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded transition-colors">
            Atualizar
        </button>
    </form>
</div>

</body>
</html>
