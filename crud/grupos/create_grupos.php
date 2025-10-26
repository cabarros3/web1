<!-- 
Rode este comando na pasta onde estão os arquivos. 
php -S localhost:8000 -->

<?php
require_once("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'];
  $ano = $_POST['ano_debut'];
  $empresa = $_POST['empresa'];
  $pais = $_POST['pais'];
  $membros = $_POST['membros'];

  $sql = "INSERT INTO grupo (nome, ano_debut, empresa, pais, membros) VALUES (?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$nome, $ano, $empresa, $pais, $membros]);

  header("Location: read_grupos.php");
  exit;
}
?>

<form method="post">
  <label>Nome:</label><input type="text" name="nome" required><br>
  <label>Ano de debut:</label><input type="number" name="ano_debut"><br>
  <label>Empresa:</label><input type="text" name="empresa"><br>
  <label>País:</label><input type="text" name="pais"><br>
  <label>Membros:</label><input type="number" name="membros"><br>
  <button type="submit">Cadastrar</button>
</form>