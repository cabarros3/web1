<?php
require_once("../config/db.php");
$stmt = $pdo->query("SELECT * FROM grupo");
$grupos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
require_once("../config/db.php");
$stmt = $pdo->query("SELECT * FROM grupo");
$grupos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Grupos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<main class="my-10 mx-10">
<div class="cabecalho_page">
  <h2 class="text-2xl">Grupos</h2>
  <a class="button" href="create_grupos.php">Novo grupo</a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ano</th>
        <th>Empresa</th>
        <th>País</th>
        <th>Membros</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($grupos as $g): ?>
    <tr>
        <td><?= $g['grupo_id'] ?></td>
        <td><?= htmlspecialchars($g['nome']) ?></td>
        <td><?= htmlspecialchars($g['ano_debut']) ?></td>
        <td><?= htmlspecialchars($g['empresa']) ?></td>
        <td><?= htmlspecialchars($g['pais']) ?></td>
        <td><?= htmlspecialchars($g['membros']) ?></td>
        <td>
            <a class="action text-blue-400" href="update_grupos.php?id=<?= $g['grupo_id'] ?>">Editar</a> |
            <a class="action text-red-400" href="delete_grupos.php?id=<?= $g['grupo_id'] ?>" 
               onclick="return confirm('Tem certeza que deseja excluir este grupo?');">
               Excluir
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>


</main>

</body>
</html>
