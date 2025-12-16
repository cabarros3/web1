<?php
require_once '../db.php'; 


$stmt = $pdo->query("SELECT id, nome FROM medico");
$medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $pdo->query("SELECT id, nome FROM paciente");
$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_medico = $_POST['id_medico'];
    $id_paciente = $_POST['id_paciente'];
    $data_hora = $_POST['data_hora'];
    $observacoes = $_POST['observacoes'];

    
    $stmt = $pdo->prepare("
        INSERT INTO consulta (id_medico, id_paciente, data_hora, observacoes) 
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([$id_medico, $id_paciente, $data_hora, $observacoes]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Consulta</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 max-w-lg">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Nova Consulta</h1>
            
            <form method="POST">
                <div class="mb-4">
                    <label for="id_medico" class="block text-gray-700 text-sm font-bold mb-2">Médico:</label>
                    <div class="relative">
                        <select id="id_medico" name="id_medico" required 
                                class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">Selecione um médico</option>
                            <?php foreach ($medicos as $m): ?>
                                <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="id_paciente" class="block text-gray-700 text-sm font-bold mb-2">Paciente:</label>
                    <div class="relative">
                        <select id="id_paciente" name="id_paciente" required 
                                class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">Selecione um paciente</option>
                            <?php foreach ($pacientes as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="data_hora" class="block text-gray-700 text-sm font-bold mb-2">Data e Hora:</label>
                    <input type="datetime-local" id="data_hora" name="data_hora" required 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div class="mb-6">
                    <label for="observacoes" class="block text-gray-700 text-sm font-bold mb-2">Observações:</label>
                    <textarea id="observacoes" name="observacoes" rows="3" placeholder="Detalhes da consulta..."
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-purple-600 hover:bg-purple-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 w-full sm:w-auto">
                        Agendar
                    </button>
                    <a href="index.php" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800 ml-4">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>