<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../db.php'; 

use Dompdf\Dompdf;
use Dompdf\Options;


$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('defaultFont', 'Helvetica');
$dompdf = new Dompdf($options);

try {
    
    $sql = "SELECT p.nome as paciente, m.nome as medico, c.data_hora 
            FROM consulta c
            INNER JOIN paciente p ON c.id_paciente = p.id
            INNER JOIN medico m ON c.id_medico = m.id
            ORDER BY c.data_hora DESC";
    
    $stmt = $pdo->query($sql);
    $consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$consultas) {
        die("Nenhuma consulta encontrada para gerar o relatório.");
    }

    
    $html = '
    <h1 style="text-align:center; font-family: sans-serif;">Relatório de Consultas</h1>
    <table style="width:100%; border-collapse: collapse; font-family: sans-serif;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px;">Data/Hora</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Médico</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Paciente</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($consultas as $c) {
        $data = date('d/m/Y H:i', strtotime($c['data_hora']));
        $html .= "<tr>
                    <td style='border: 1px solid #ddd; padding: 8px;'>{$data}</td>
                    <td style='border: 1px solid #ddd; padding: 8px;'>{$c['medico']}</td>
                    <td style='border: 1px solid #ddd; padding: 8px;'>{$c['paciente']}</td>
                  </tr>";
    }

    $html .= '</tbody></table>';

    
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    
    ob_end_clean();

    $dompdf->stream("consultas.pdf", ["Attachment" => false]);

} catch (Exception $e) {
    echo "Erro ao gerar PDF: " . $e->getMessage();
}