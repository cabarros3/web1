<?php
require_once("../config/db.php");

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    die("ID da participação não informado!");
}

$id = $_GET['id'];

// Deletar a participação
$stmt = $pdo->prepare("DELETE FROM participacao WHERE participacao_id = ?");
$result = $stmt->execute([$id]);

if ($result) {
    header("Location: read_participacao.php");
    exit;
} else {
    die("Erro ao tentar deletar a participação.");
}
?>
