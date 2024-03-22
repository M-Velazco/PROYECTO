<?php
require_once('../../tcpdf/tcpdf.php');

// Recuperar datos del formulario
$id_estudiante = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$trimestre = $_POST['trimestre'];
$cantidad_materias = $_POST['cantidad_materias'];

// Crear un nuevo objeto TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Boletín de Estudiante');
$pdf->SetSubject('Boletín de Estudiante');
$pdf->SetKeywords('Boletín, Estudiante, PDF');

// Establecer la imagen de fondo
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->AddPage();

// Establecer la imagen como fondo de página


// Establecer la fuente y el color para el contenido principal
$pdf->SetFont('helvetica', 'B', 16);
$pdf->SetTextColor(0, 0, 0); // Color negro para el contenido principal

// Datos en la barra superior
$pdf->Cell(0, 10, 'ID del Estudiante: ' . $id_estudiante, 0, 1, 'C');
$pdf->Cell(0, 10, 'Nombre: ' . $nombre, 0, 1, 'C');
$pdf->Cell(0, 10, 'Apellido: ' . $apellido, 0, 1, 'C');

// Establecer la fuente y el color para el contenido del boletín
$pdf->SetFont('helvetica', '', 12);
$pdf->SetTextColor(0, 0, 0); // Color negro para el contenido

// Escribir el contenido del boletín
$html = '<h1>Boletín de Estudiante</h1>';
$html .= '<p>Periodo: ' . $trimestre . '</p>';

$html .= '<h2>Materias</h2>';
$html .= '<table border="1">';
$html .= '<tr><th>Materia</th><th>Nota</th><th>Observaciones</th></tr>';

for ($i = 1; $i <= $cantidad_materias; $i++) {
    $materia = $_POST['materia' . $i];
    $nota = $_POST['nota' . $i];
    $observacion = $_POST['observacion' . $i];

    $html .= '<tr>';
    $html .= '<td>' . $materia . '</td>';
    $html .= '<td>' . $nota . '</td>';
    $html .= '<td>' . $observacion . '</td>';
    $html .= '</tr>';
}

$html .= '</table>';

// Escribir el contenido en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Nombre del archivo PDF generado
$nombre_archivo = 'boletin_' . $id_estudiante . '.pdf';

// Generar el PDF y enviar al navegador para su descarga
$pdf->Output($nombre_archivo, 'D');
?>
