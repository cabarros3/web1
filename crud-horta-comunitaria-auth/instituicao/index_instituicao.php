<?php
require_once '../banco/db.php';
$stmt = $pdo->query("SELECT * FROM instituicao");
$instituicoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Instituição</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">

  <!-- Header -->
  <header class="bg-indigo-600 text-white shadow-md">
    <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col sm:flex-row justify-between items-center gap-2">
      <h1 class="text-2xl font-semibold text-center sm:text-left">Sistema de Gerenciamento de Instituições</h1>
      <nav>
        <ul class="flex space-x-4 text-sm font-medium">
          <li><a href="../index.php" class="hover:underline">Home</a></li>
          <li><a href="index_instituicao.php" class="hover:underline">Listar Instituições</a></li>
          <li><a href="create_instituicao.php" class="bg-white text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-100 transition">Adicionar</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="flex-grow max-w-6xl mx-auto px-4 py-10">
    <h2 class="text-xl font-semibold mb-6 text-gray-700">Lista de Instituições</h2>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
      <table class="min-w-full text-sm text-left border-collapse">
        <thead class="bg-indigo-100 text-indigo-700 uppercase text-xs tracking-wider">
          <tr>
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Nome</th>
            <th class="px-4 py-3">CEP</th>
            <th class="px-4 py-3">Rua</th>
            <th class="px-4 py-3">Número</th>
            <th class="px-4 py-3">Complemento</th>
            <th class="px-4 py-3">Bairro</th>
            <th class="px-4 py-3">Cidade</th>
            <th class="px-4 py-3">Estado</th>
            <th class="px-4 py-3 text-center">Ações</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
          <?php foreach ($instituicoes as $instituicao): ?>
            <tr class="hover:bg-gray-50 transition">
              <td class="px-4 py-3"><?= $instituicao['instituicao_id'] ?></td>
              <td class="px-4 py-3"><?= $instituicao['nome_instituicao'] ?></td>
              <td class="px-4 py-3"><?= $instituicao['cep'] ?></td>
              <td class="px-4 py-3"><?= $instituicao['rua'] ?></td>
              <td class="px-4 py-3"><?= $instituicao['numero'] ?></td>
              <td class="px-4 py-3"><?= $instituicao['complemento'] ?></td>
              <td class="px-4 py-3"><?= $instituicao['bairro'] ?></td>
              <td class="px-4 py-3"><?= $instituicao['cidade'] ?></td>
              <td class="px-4 py-3"><?= $instituicao['estado'] ?></td>
              <td class="px-4 py-3 text-center space-x-2">
                <a href="read_instituicao.php?id=<?= $instituicao['instituicao_id'] ?>" class="text-blue-600 hover:text-blue-800 font-medium">Visualizar</a>
                <a href="update_instituicao.php?id=<?= $instituicao['instituicao_id'] ?>" class="text-amber-600 hover:text-amber-800 font-medium">Editar</a>
                <a href="delete_instituicao.php?id=<?= $instituicao['instituicao_id'] ?>" class="text-red-600 hover:text-red-800 font-medium">Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-100 py-4 text-center text-sm text-gray-600 border-t">
    &copy; 2024 - Sistema de Gerenciamento de Alunos
  </footer>

</body>
</html>
