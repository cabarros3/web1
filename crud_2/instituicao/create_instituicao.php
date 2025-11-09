<?php
require_once '../banco/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_instituicao = $_POST['nome_instituicao'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    $stmt = $pdo->prepare("INSERT INTO instituicao (nome_instituicao, rua, numero, complemento, bairro, cidade, estado, cep) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nome_instituicao, $rua, $numero, $complemento, $bairro, $cidade, $estado, $cep]);
    header('Location: index_instituicao.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Adicionar Instituição</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">

  <!-- Header -->
  <header class="bg-green-700 text-white shadow-md">
    <div class="max-w-5xl mx-auto px-4 py-4 flex flex-col sm:flex-row justify-between items-center gap-2">
      <h1 class="text-2xl font-semibold text-center sm:text-left">Sistema de Gerenciamento da Horta Comunitária</h1>
      <nav>
        <ul class="flex space-x-4 text-sm font-medium">
          <li><a href="../index.php" class="hover:underline">Home</a></li>
          <li><a href="index_instituicao.php" class="hover:underline">Listar Instituições</a></li>
          <li><a href="create_instituicao.php" class="bg-white text-green-700 px-3 py-1 rounded-md hover:bg-green-100 transition">Adicionar</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="flex-grow max-w-3xl mx-auto px-4 py-10">
    <h2 class="text-xl font-semibold mb-6 text-gray-700 text-center">Adicionar Nova Instituição</h2>

    <form method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-4">
      
      <div>
        <label for="nome_instituicao" class="block text-sm font-medium text-gray-700">Nome da Instituição</label>
        <input type="text" id="nome_instituicao" name="nome_instituicao" required
          class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-600 focus:border-green-600" />
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label for="rua" class="block text-sm font-medium text-gray-700">Rua</label>
          <input type="text" id="rua" name="rua" required
            class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-600 focus:border-green-600" />
        </div>

        <div>
          <label for="numero" class="block text-sm font-medium text-gray-700">Número</label>
          <input type="text" id="numero" name="numero" required
            class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-600 focus:border-green-600" />
        </div>
      </div>

      <div>
        <label for="complemento" class="block text-sm font-medium text-gray-700">Complemento</label>
        <input type="text" id="complemento" name="complemento"
          class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-600 focus:border-green-600" />
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
          <input type="text" id="bairro" name="bairro" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-600 focus:border-green-600" />
        </div>

        <div>
          <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
          <input type="text" id="cidade" name="cidade" required
            class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-600 focus:border-green-600" />
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
          <input type="text" id="estado" name="estado" required
            class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-600 focus:border-green-600" />
        </div>

        <div>
          <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
          <input type="text" id="cep" name="cep" required
            class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-600 focus:border-green-600" />
        </div>
      </div>

      <div class="pt-4 flex justify-end">
        <button type="submit"
          class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-md font-medium transition">
          Adicionar
        </button>
      </div>
    </form>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-100 py-4 text-center text-sm text-gray-600 border-t">
    &copy; 2024 - Sistema de Gerenciamento da Horta Comunitária
  </footer>

</body>
</html>
