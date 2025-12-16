<?php
require_once '../db.php';


$sql = "SELECT c.id_medico, c.id_paciente, c.data_hora, c.observacoes,
               m.nome as nome_medico, 
               p.nome as nome_paciente
        FROM consulta c
        JOIN medico m ON c.id_medico = m.id
        JOIN paciente p ON c.id_paciente = p.id
        ORDER BY c.data_hora DESC";

$stmt = $pdo->query($sql);
$consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Consultas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="container mx-auto max-w-6xl">
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Agendamento de Consultas</h1>
            <a href="create-consulta.php" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded transition duration-300 shadow">
                + Nova Consulta
            </a>
        </header>

        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Data/Hora</th>
                        <th class="py-3 px-6 text-left">Médico</th>
                        <th class="py-3 px-6 text-left">Paciente</th>
                        <th class="py-3 px-6 text-left">Observações</th>
                        <th class="py-3 px-6 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php if (count($consultas) > 0): ?>
                        <?php foreach ($consultas as $c): ?>
                            <?php 
                                // Criando a query string com os 3 IDs necessários para identificar a linha
                                $params = "id_medico=" . $c['id_medico'] . 
                                          "&id_paciente=" . $c['id_paciente'] . 
                                          "&data_hora=" . urlencode($c['data_hora']);
                            ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                                <td class="py-3 px-6 text-left font-bold">
                                    <?= date('d/m/Y H:i', strtotime($c['data_hora'])); ?>
                                </td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars($c['nome_medico']); ?></td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars($c['nome_paciente']); ?></td>
                                <td class="py-3 px-6 text-left text-xs max-w-xs truncate">
                                    <?= htmlspecialchars($c['observacoes']); ?>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <a href="update-consulta.php?<?= $params ?>" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 transition duration-150" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                        <a href="delete-consulta.php?<?= $params ?>" 
                                           onclick="return confirm('Confirmar cancelamento da consulta?');" 
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
                        <tr><td colspan="5" class="text-center py-4">Nenhuma consulta agendada.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>