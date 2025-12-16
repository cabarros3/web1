<?php
require_once '../db.php';


if (!isset($_GET['id_medico']) || !isset($_GET['id_paciente']) || !isset($_GET['data_hora'])) {
    header('Location: index.php');
    exit;
}

$id_medico_get = $_GET['id_medico'];
$id_paciente_get = $_GET['id_paciente'];
$data_hora_get = $_GET['data_hora'];


$medicos = $pdo->query("SELECT id, nome FROM medico")->fetchAll(PDO::FETCH_ASSOC);
$pacientes = $pdo->query("SELECT id, nome FROM paciente")->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $novo_medico = $_POST['id_medico'];
    $novo_paciente = $_POST['id_paciente'];
    $nova_data = $_POST['data_hora'];
    $nova_obs = $_POST['observacoes'];

    
    $antigo_medico = $_POST['old_id_medico'];
    $antigo_paciente = $_POST['old_id_paciente'];
    $antiga_data = $_POST['old_data_hora'];

    $sql = "UPDATE consulta 
            SET id_medico = ?, id_paciente = ?, data_hora = ?, observacoes = ? 
            WHERE id_medico = ? AND id_paciente = ? AND data_hora = ?";
    
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            $novo_medico, $novo_paciente, $nova_data, $nova_obs, 
            $antigo_medico, $antigo_paciente, $antiga_data       
        ]);
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        $erro = "Erro ao atualizar: Verifique se já não existe uma consulta neste horário.";
    }
}


$stmt = $pdo->prepare("SELECT * FROM consulta WHERE id_medico = ? AND id_paciente = ? AND data_hora = ?");
$stmt->execute([$id_medico_get, $id_paciente_get, $data_hora_get]);
$consulta = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$consulta) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Consulta</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 max-w-lg">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Consulta</h1>
            
            <?php if(isset($erro)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?= $erro ?></div>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="old_id_medico" value="<?= $consulta['id_medico'] ?>">
                <input type="hidden" name="old_id_paciente" value="<?= $consulta['id_paciente'] ?>">
                <input type="hidden" name="old_data_hora" value="<?= $consulta['data_hora'] ?>">

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Médico:</label>
                    <div class="relative">
                        <select name="id_medico" required class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <?php foreach ($medicos as $m): ?>
                                <option value="<?= $m['id'] ?>" <?= $m['id'] == $consulta['id_medico'] ? 'selected' : '' ?>>
                                    <?= $m['nome'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Paciente:</label>
                    <div class="relative">
                        <select name="id_paciente" required class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <?php foreach ($pacientes as $p): ?>
                                <option value="<?= $p['id'] ?>" <?= $p['id'] == $consulta['id_paciente'] ? 'selected' : '' ?>>
                                    <?= $p['nome'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Data e Hora:</label>
                    <input type="datetime-local" name="data_hora" required 
                           value="<?= date('Y-m-d\TH:i', strtotime($consulta['data_hora'])) ?>"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Observações:</label>
                    <textarea name="observacoes" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500"><?= htmlspecialchars($consulta['observacoes']) ?></textarea>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-purple-600 hover:bg-purple-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                        Salvar Alterações
                    </button>
                    <a href="index.php" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>