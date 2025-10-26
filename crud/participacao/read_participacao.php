<?php
require_once("../config/db.php");

// Buscar participações com JOIN para nomes legíveis
$stmt = $pdo->query("
    SELECT p.*, g.nome AS grupo_nome, c.nome AS competicao_nome, m.titulo AS musica_titulo
    FROM participacao p
    JOIN grupo g ON p.grupo_id = g.grupo_id
    JOIN competicao c ON p.competicao_id = c.competicao_id
    JOIN musica m ON p.musica_id = m.musica_id
    ORDER BY p.participacao_id DESC
");
$participacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Participações</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<main class="my-10 mx-10">
<div class="cabecalho_page flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold">Participações</h2>
  <a class="button bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" href="create_participacao.php">Nova Participação</a>
</div>

<table class="min-w-full border border-gray-300">
    <tr class="bg-gray-100">
        <th class="border px-4 py-2">ID</th>
        <th class="border px-4 py-2">Grupo</th>
        <th class="border px-4 py-2">Competição</th>
        <th class="border px-4 py-2">Música</th>
        <th class="border px-4 py-2">Colocação</th>
        <th class="border px-4 py-2">Pontuação</th>
        <th class="border px-4 py-2">Ações</th>
    </tr>
    <?php foreach ($participacoes as $p): ?>
    <tr class="hover:bg-gray-50">
        <td class="border px-4 py-2"><?= $p['participacao_id'] ?></td>
        <td class="border px-4 py-2"><?= htmlspecialchars($p['grupo_nome']) ?></td>
        <td class="border px-4 py-2"><?= htmlspecialchars($p['competicao_nome']) ?></td>
        <td class="border px-4 py-2"><?= htmlspecialchars($p['musica_titulo']) ?></td>
        <td class="border px-4 py-2"><?= $p['colocacao'] ?? '-' ?></td>
        <td class="border px-4 py-2"><?= $p['pontuacao'] ?? '-' ?></td>
        <td class="border px-4 py-2">
            <a class="text-blue-400 hover:underline" href="update_participacao.php?id=<?= $p['participacao_id'] ?>">Editar</a> |
            <a class="text-red-400 hover:underline" href="delete_participacao.php?id=<?= $p['participacao_id'] ?>" 
               onclick="return confirm('Tem certeza que deseja excluir esta participação?');">
               Excluir
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</main>

</body>
</html>
