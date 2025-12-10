<?php
// db
require_once '../banco/db.php';

// pegar o id
$id = $_GET['id'];

// fazer o select
$stmt = $pdo->prepare("SELECT * FROM instituicao WHERE instituicao_id = ?");

// executar
$stmt->execute([$id]);

// declarar instituição como variável
$instituicao = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalhes da Instituição</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

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
  <main class="flex-grow max-w-3xl mx-auto w-full p-6">
    <h2 class="text-2xl font-semibold mb-6 text-center text-blue-800">Detalhes da Instituição</h2>

    <?php if ($instituicao): ?>
      <div class="bg-white shadow-md rounded-lg p-6 space-y-4 border border-gray-200">
        <div class="flex flex-row gap-5">
            <p><span class="font-semibold">ID:</span> <?= htmlspecialchars($instituicao['instituicao_id']) ?></p>
            <p><span class="font-semibold">Nome:</span> <?= htmlspecialchars($instituicao['nome_instituicao']) ?></p>
        </div>
        <div class="flex flex-wrap gap-3">
            <p><span class="font-semibold">CEP:</span> <?= htmlspecialchars($instituicao['cep']) ?></p>
            <p><span class="font-semibold">Rua:</span> <?= htmlspecialchars($instituicao['rua']) ?></p>
            <p><span class="font-semibold">Número:</span> <?= htmlspecialchars($instituicao['numero']) ?></p>
            <p><span class="font-semibold">Complemento:</span> <?= htmlspecialchars($instituicao['complemento']) ?></p>
            <p><span class="font-semibold">Bairro:</span> <?= htmlspecialchars($instituicao['bairro']) ?></p>
            <p><span class="font-semibold">Cidade:</span> <?= htmlspecialchars($instituicao['cidade']) ?></p>
            <p><span class="font-semibold">Estado:</span> <?= htmlspecialchars($instituicao['estado']) ?></p>
        </div>
        <div class="pt-4 flex space-x-4">
          <a href="update_instituicao.php?id=<?= $instituicao['instituicao_id'] ?>"
             class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Editar
          </a>
          <a href="delete_instituicao.php?id=<?= $instituicao['instituicao_id'] ?>"
             class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
            Excluir
          </a>
        </div>
      </div>
    <?php else: ?>
      <div class="text-center bg-red-50 text-red-700 p-4 rounded-md border border-red-200">
        <p>Instituição não encontrada.</p>
      </div>
    <?php endif; ?>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-700 text-white text-center py-4 mt-8">
    <p>&copy; 2024 - Sistema de Gerenciamento de Instituições</p>
  </footer>
</body>
</html>
