<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
require_once('tcpdf/tcpdf.php');

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

// Agregar una página
$pdf->AddPage();

// Establecer la fuente para la marca de agua
$pdf->SetFont('helvetica', 'B', 50);
$pdf->SetTextColor(211, 211, 211); // Color gris claro para la marca de agua

// Agregar la marca de agua
$pdf->RotatedText(35, 190, 'M A R C A   D E   A G U A', 45); // Personaliza la posición según tus necesidades

// Establecer la fuente y el color para los datos principales
$pdf->SetFont('helvetica', 'B', 16);
$pdf->SetTextColor(0, 0, 0); // Color negro para los datos principales

// Datos en la barra superior
$pdf->Cell(0, 10, 'ID del Estudiante: ' . $id_estudiante, 0, 1, 'C');
$pdf->Cell(0, 10, 'Nombre: ' . $nombre, 0, 1, 'C');
$pdf->Cell(0, 10, 'Apellido: ' . $apellido, 0, 1, 'C');

// Establecer la fuente y el color para el contenido del boletín
$pdf->SetFont('helvetica', '', 12);
$pdf->SetTextColor(0, 0, 0); // Color negro para el contenido

// Escribir el contenido del boletín
$html = '<h1>Boletín de Estudiante</h1>';
$html .= '<p>Trimestre: ' . $trimestre . '</p>';

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