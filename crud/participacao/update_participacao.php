<?php
require_once("../config/db.php");

// Verifica se o ID da participação foi passado
if (!isset($_GET['id'])) {
    die("ID da participação não informado!");
}

$id = $_GET['id'];

// Buscar a participação para preencher o formulário
$stmt = $pdo->prepare("SELECT * FROM participacao WHERE participacao_id = ?");
$stmt->execute([$id]);
$participacao = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$participacao) {
    die("Participação não encontrada!");
}

// Popula os selects
$grupos = $pdo->query("SELECT * FROM grupo")->fetchAll(PDO::FETCH_ASSOC);
$competicoes = $pdo->query("SELECT * FROM competicao")->fetchAll(PDO::FETCH_ASSOC);
$musicas = $pdo->query("SELECT * FROM musica")->fetchAll(PDO::FETCH_ASSOC);

// Atualizar participação quando o formulário for enviado
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

    $sql = "UPDATE participacao 
            SET grupo_id = ?, competicao_id = ?, musica_id = ?, colocacao = ?, pontuacao = ? 
            WHERE participacao_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$grupo_id, $competicao_id, $musica_id, $colocacao, $pontuacao, $id]);

    header("Location: read_participacao.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Participação</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Participação</h1>

    <form method="post" class="space-y-4">
        <div>
            <label class="block text-gray-700 font-medium mb-1">Grupo:</label>
            <select name="grupo_id" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Selecione o grupo</option>
                <?php foreach ($grupos as $grupo): ?>
                    <option value="<?= $grupo['grupo_id'] ?>" <?= $grupo['grupo_id'] == $participacao['grupo_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($grupo['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Competição:</label>
            <select name="competicao_id" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Selecione a competição</option>
                <?php foreach ($competicoes as $comp): ?>
                    <option value="<?= $comp['competicao_id'] ?>" <?= $comp['competicao_id'] == $participacao['competicao_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($comp['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Música:</label>
            <select name="musica_id" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Selecione a música</option>
                <?php foreach ($musicas as $musica): ?>
                    <option value="<?= $musica['musica_id'] ?>" <?= $musica['musica_id'] == $participacao['musica_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($musica['titulo']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Colocação:</label>
            <input type="number" name="colocacao" min="1"
                   value="<?= htmlspecialchars($participacao['colocacao']) ?>"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Pontuação:</label>
            <input type="number" step="0.01" name="pontuacao" min="0"
                   value="<?= htmlspecialchars($participacao['pontuacao']) ?>"
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
