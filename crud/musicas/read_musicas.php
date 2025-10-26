<?php
require_once("../config/db.php");

// Buscar músicas com o nome do grupo (JOIN)
$stmt = $pdo->query("
    SELECT m.*, g.nome AS grupo_nome
    FROM musica m
    JOIN grupo g ON m.grupo_id = g.grupo_id
");
$musicas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Músicas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<main class="my-10 mx-10">
<div class="cabecalho_page flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold">Músicas</h2>
  <a class="button bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" href="create_musicas.php">Nova Música</a>
</div>

<table class="min-w-full border border-gray-300">
    <tr class="bg-gray-100">
        <th class="border px-4 py-2">ID</th>
        <th class="border px-4 py-2">Título</th>
        <th class="border px-4 py-2">Ano</th>
        <th class="border px-4 py-2">Álbum</th>
        <th class="border px-4 py-2">Grupo</th>
        <th class="border px-4 py-2">Ações</th>
    </tr>
    <?php foreach ($musicas as $m): ?>
    <tr class="hover:bg-gray-50">
        <td class="border px-4 py-2"><?= $m['musica_id'] ?></td>
        <td class="border px-4 py-2"><?= htmlspecialchars($m['titulo']) ?></td>
        <td class="border px-4 py-2"><?= htmlspecialchars($m['ano_lancamento']) ?></td>
        <td class="border px-4 py-2"><?= htmlspecialchars($m['album']) ?></td>
        <td class="border px-4 py-2"><?= htmlspecialchars($m['grupo_nome']) ?></td>
        <td class="border px-4 py-2">
            <a class="text-blue-400 hover:underline" href="update_musicas.php?id=<?= $m['musica_id'] ?>">Editar</a> |
            <a class="text-red-400 hover:underline" href="delete_musicas.php?id=<?= $m['musica_id'] ?>" 
               onclick="return confirm('Tem certeza que deseja excluir esta música?');">
               Excluir
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</main>

</body>
</html>
