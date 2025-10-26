<?php
require_once("../config/db.php");
$stmt = $pdo->query("SELECT * FROM competicao");
$competicao = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
require_once("../config/db.php");
$stmt = $pdo->query("SELECT * FROM competicao");
$competicao = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Competições</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<main class="my-10 mx-10">
<div class="cabecalho_page">
  <h2 class="text-2xl">Competições</h2>
  <a class="button" href="create_competicao.php">Nova Competição</a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Local da Competição</th>
        <th>Data da Competição</th>
        <th>Tema</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($competicao as $c): ?>
    <tr>
        <td><?= $c['competicao_id'] ?></td>
        <td><?= htmlspecialchars($c['nome']) ?></td>
        <td><?= htmlspecialchars($c['local_comp']) ?></td>
        <td><?= htmlspecialchars($c['data_comp']) ?></td>
        <td><?= htmlspecialchars($c['tema']) ?></td>
        <td>
            <a class="action text-blue-400" href="update_competicao.php?id=<?= $c['competicao_id'] ?>">Editar</a> |
            <a class="action text-red-400" href="delete_competicao.php?id=<?= $c['competicao_id'] ?>" 
               onclick="return confirm('Tem certeza que deseja excluir esta competição?');">
               Excluir
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>


</main>

</body>
</html>
