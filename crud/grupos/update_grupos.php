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

    // Redireciona de volta para a listagem
    header("Location: read_grupos.php");
    exit;
}
?>

<h1>Editar Grupo</h1>

<form method="post">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($grupo['nome']) ?>" required><br>

    <label>Ano de debut:</label>
    <input type="number" name="ano_debut" value="<?= htmlspecialchars($grupo['ano_debut']) ?>"><br>

    <label>Empresa:</label>
    <input type="text" name="empresa" value="<?= htmlspecialchars($grupo['empresa']) ?>"><br>

    <label>País:</label>
    <input type="text" name="pais" value="<?= htmlspecialchars($grupo['pais']) ?>"><br>

    <label>Membros:</label>
    <input type="number" name="membros" value="<?= htmlspecialchars($grupo['membros']) ?>"><br>

    <button type="submit">Atualizar</button>
</form>

<a href="read_grupos.php">Voltar</a>
