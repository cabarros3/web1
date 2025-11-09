<?php
// db
require_once '../banco/db.php';

// pegar id
$id = $_GET['id'];

// Busca os dados atuais da instituição
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM instituicao WHERE instituicao_id = ?");
    $stmt->execute([$id]);
    $instituicao = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome_instituicao'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    // Atualiza os dados da instituição
    $stmt = $pdo->prepare("UPDATE instituicao SET nome_instituicao = ?, rua = ?, numero = ?, complemento = ?, bairro = ?, cidade = ?, estado = ?, cep = ? WHERE instituicao_id = ?");
    $stmt->execute([$nome, $rua, $numero, $complemento, $bairro, $cidade, $estado, $cep, $id]);

    // Redireciona após a atualização
    header('Location: index_instituicao.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Instituição</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col text-gray-800">

  <!-- Header -->
  <header class="bg-blue-700 text-white shadow-md">
    <div class="max-w-5xl mx-auto p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between">
      <h1 class="text-2xl font-bold mb-2 sm:mb-0">Sistema de Gerenciamento de Instituições</h1>
      <nav>
        <ul class="flex space-x-4">
          <li><a href="../index.php" class="hover:underline">Home</a></li>
          <li><a href="index_instituicao.php" class="hover:underline">Listar</a></li>
          <li><a href="create_instituicao.php" class="hover:underline">Adicionar</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="flex-grow flex flex-col items-center justify-center p-6">
    <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 border border-gray-200">
      <h2 class="text-2xl font-semibold text-blue-700 mb-6 text-center">Editar Instituição</h2>

      <?php if (!empty($instituicao)): ?>
        <form method="POST" class="space-y-4">
          <div>
            <label for="nome_instituicao" class="block text-sm font-medium text-gray-700">Nome</label>
            <input 
              type="text" 
              id="nome_instituicao" 
              name="nome_instituicao" 
              value="<?= htmlspecialchars($instituicao['nome_instituicao']) ?>" 
              required
              class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
          </div>

          <div>
            <label for="rua" class="block text-sm font-medium text-gray-700">Rua</label>
            <input 
              type="text" 
              id="rua" 
              name="rua" 
              value="<?= htmlspecialchars($instituicao['rua']) ?>" 
              required
              class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
          </div>

          <div>
            <label for="numero" class="block text-sm font-medium text-gray-700">Número</label>
            <input 
              type="text" 
              id="numero" 
              name="numero" 
              value="<?= htmlspecialchars($instituicao['numero']) ?>" 
              required
              class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
          </div>

          <div>
            <label for="complemento" class="block text-sm font-medium text-gray-700">Complemento</label>
            <input 
              type="text" 
              id="complemento" 
              name="complemento" 
              value="<?= htmlspecialchars($instituicao['complemento']) ?>" 
              required
              class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
          </div>

          <div>
            <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
            <input 
              type="text" 
              id="bairro" 
              name="bairro" 
              value="<?= htmlspecialchars($instituicao['bairro']) ?>" 
              required
              class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
          </div>

          <div>
            <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
            <input 
              type="text" 
              id="cidade" 
              name="cidade" 
              value="<?= htmlspecialchars($instituicao['cidade']) ?>" 
              required
              class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
          </div>

          <div>
            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
            <input 
              type="text" 
              id="estado" 
              name="estado" 
              value="<?= htmlspecialchars($instituicao['estado']) ?>" 
              required
              class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
          </div>

          <div>
            <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
            <input 
              type="text" 
              id="cep" 
              name="cep" 
              value="<?= htmlspecialchars($instituicao['cep']) ?>" 
              required
              class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
          </div>

          <button 
            type="submit" 
            class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition font-medium"
          >
            Atualizar
          </button>
        </form>
      <?php else: ?>
        <div class="text-center bg-red-50 text-red-700 p-4 rounded-md border border-red-200">
          <p>Instituição não encontrada.</p>
        </div>
      <?php endif; ?>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-700 text-white text-center py-4 mt-8">
    <p>&copy; 2024 - Sistema de Gerenciamento da Horta Comunitária</p>
  </footer>
</body>
</html>
