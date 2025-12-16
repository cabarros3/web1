<?php
require_once '../db.php';


if (isset($_GET['id_medico']) && isset($_GET['id_paciente']) && isset($_GET['data_hora'])) {
    
    $id_medico = $_GET['id_medico'];
    $id_paciente = $_GET['id_paciente'];
    $data_hora = $_GET['data_hora'];

    $sql = "DELETE FROM consulta WHERE id_medico = ? AND id_paciente = ? AND data_hora = ?";
    $stmt = $pdo->prepare($sql);
    
  
    $stmt->execute([$id_medico, $id_paciente, $data_hora]);
}


header('Location: index.php');
exit;
?>