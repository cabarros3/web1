<?php

require_once '../db.php';

$stmt = $pdo->query("SELECT * FROM paciente");
$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pacientes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="container mx-auto max-w-5xl">
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Pacientes Cadastrados</h1>
            <a href="create-paciente.php" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded transition duration-300 shadow">
                + Novo Paciente
            </a>
        </header>

        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Nome</th>
                        <th class="py-3 px-6 text-center">Data Nascimento</th>
                        <th class="py-3 px-6 text-center">Tipo Sanguíneo</th>
                        <th class="py-3 px-6 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php if (count($pacientes) > 0): ?>
                        <?php foreach ($pacientes as $p): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                                <td class="py-3 px-6 text-left whitespace-nowrap font-medium"><?= $p['id']; ?></td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars($p['nome']); ?></td>
                                <td class="py-3 px-6 text-center">
                                    <?= date('d/m/Y', strtotime($p['data_nascimento'])); ?>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span class="bg-red-100 text-red-600 py-1 px-3 rounded-full text-xs font-bold">
                                        <?= htmlspecialchars($p['tipo_sanguineo']); ?>
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <a href="update-paciente.php?id=<?= $p['id']; ?>" class="w-4 mr-2 transform hover:text-teal-500 hover:scale-110 transition duration-150" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                        <a href="delete-paciente.php?id=<?= $p['id']; ?>" 
                                           onclick="return confirm('Tem certeza que deseja excluir este paciente?');" 
                                           class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 transition duration-150" title="Excluir">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-3 px-6 text-center text-gray-500">Nenhum paciente encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>