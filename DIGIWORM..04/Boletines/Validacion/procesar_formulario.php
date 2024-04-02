<?php
session_start();
require_once('../../tcpdf/tcpdf.php');
require_once "../../modelo/conexion.php";

// Recuperar datos del formulario
$Curso = $_POST['curso'];
$id_estudiante = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$trimestre = $_POST['trimestre'];
$cantidad_materias = $_POST['cantidad_materias'];

// Crear un nuevo objeto TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator('Digiworm');
$pdf->SetAuthor('PauloVI');
$pdf->SetTitle('Boletín de Estudiante');
$pdf->SetSubject('Boletín de Estudiante');
$pdf->SetKeywords('Boletín, Estudiante, PDF');

// Establecer la fuente y el color para el contenido principal
$pdf->SetFont('helvetica', 'B', 16);
$pdf->SetTextColor(0, 0, 0); // Color negro para el contenido principal

// Establecer la imagen como fondo de página (reemplaza 'imagen_fondo.jpg' con la ruta de tu imagen de fondo)
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->Image('imagen_fondo.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

// Agregar una nueva página
$pdf->AddPage();

// Consultar el nombre del curso
$conexion = Conectarse();
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$consulta = $conexion->query("SELECT Nombre_curso FROM curso WHERE idCurso = $Curso");
if ($fila = $consulta->fetch_assoc()) {
    $CursoN = $fila['Nombre_curso'];
} else {
    $CursoN = "Nombre de curso no encontrado";
}

$conexion->close();

// Datos en la barra superior
$pdf->Cell(0, 10, 'ID del Estudiante: ' . $id_estudiante, 0, 1, 'C');
$pdf->Cell(0, 10, 'Curso: ' . $CursoN, 0, 1, 'C');
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

// Ruta del directorio para guardar el archivo PDF en el servidor
$ruta_directorio = 'Boletines/Validacion/boletines_estudiantes/';

// Verificar si el directorio existe, si no, crearlo
if (!file_exists($ruta_directorio)) {
    mkdir($ruta_directorio, 0777, true);
}

// Ruta del archivo PDF en el servidor
$ruta_pdf = __DIR__ . '/Boletines/Validacion/boletines_estudiantes/' . $nombre_archivo;


// Guardar el archivo PDF en el servidor
$pdf->Output($ruta_pdf, 'F');
$pdf->Output($nombre_archivo, 'D');

$conexion = Conectarse();
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el ID del docente desde la sesión (suponiendo que esté almacenado en una variable de sesión llamada $_SESSION['id_docente'])
$id_docente = $_SESSION['Idusuario'];

// Consulta para insertar los datos en la tabla de boletines
$insert_query = "INSERT INTO boletines (idEstudiante, idDocente, direccionArchivo) VALUES ('$id_estudiante', '$id_docente', '$ruta_pdf')";

if ($conexion->query($insert_query) === TRUE) {
    echo "Datos insertados correctamente en la tabla de boletines";
} else {
    echo "Error al insertar datos en la tabla de boletines: " . $conexion->error;
}

$conexion->close();

// Generar el PDF y enviar al navegador para su descarga

