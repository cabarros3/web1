<?php
require_once("../config/db.php");

// Verifica se foi passado o ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM grupo WHERE grupo_id = ?");
    $stmt->execute([$id]);

    // Redireciona de volta para a listagem
    header("Location: read_grupos.php");
    exit;
} else {
    echo "ID não informado!";
}
?>
