<?php
require_once("../config/db.php");

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    die("ID da música não informado!");
}

$id = $_GET['id'];

// Executa o DELETE
$stmt = $pdo->prepare("DELETE FROM musica WHERE musica_id = ?");
$stmt->execute([$id]);

// Redireciona para a lista de músicas
header("Location: read_musicas.php");
exit;
?>
