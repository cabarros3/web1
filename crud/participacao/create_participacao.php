<?php
require_once("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validação básica
    if (empty($_POST['grupo_id']) || empty($_POST['competicao_id']) || empty($_POST['musica_id'])) {
        die("Todos os campos obrigatórios devem ser preenchidos!");
    }

    $grupo_id = $_POST['grupo_id'];
    $competicao_id = $_POST['competicao_id'];
    $musica_id = $_POST['musica_id'];
    $colocacao = $_POST['colocacao'] ?: null;
    $pontuacao = $_POST['pontuacao'] ?: null;

    $sql = "INSERT INTO participacao (grupo_id, competicao_id, musica_id, colocacao, pontuacao) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$grupo_id, $competicao_id, $musica_id, $colocacao, $pontuacao]);

    header("Location: read_participacao.php");
    exit;
}

// Popula os selects
$grupos = $pdo->query("SELECT * FROM grupo")->fetchAll(PDO::FETCH_ASSOC);
$competicoes = $pdo->query("SELECT * FROM competicao")->fetchAll(PDO::FETCH_ASSOC);
$musicas = $pdo->query("SELECT * FROM musica")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Participação</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Cadastrar Participação</h1>

    <form method="post" class="space-y-4">
        <div>
            <label class="block text-gray-700 font-medium mb-1">Grupo:</label>
            <select name="grupo_id" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="" disabled selected>Selecione o grupo</option>
                <?php foreach ($grupos as $grupo): ?>
                    <option value="<?= $grupo['grupo_id'] ?>"><?= htmlspecialchars($grupo['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Competição:</label>
            <select name="competicao_id" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="" disabled selected>Selecione a competição</option>
                <?php foreach ($competicoes as $comp): ?>
                    <option value="<?= $comp['competicao_id'] ?>"><?= htmlspecialchars($comp['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Música:</label>
            <select name="musica_id" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="" disabled selected>Selecione a música</option>
                <?php foreach ($musicas as $musica): ?>
                    <option value="<?= $musica['musica_id'] ?>"><?= htmlspecialchars($musica['titulo']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Colocação:</label>
            <input type="number" name="colocacao" min="1"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Pontuação:</label>
            <input type="number" step="0.01" name="pontuacao" min="0"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded transition-colors">
            Cadastrar
        </button>
    </form>
</div>

</body>
</html>
