<?php
require_once "../modelo/conexion.php";

// Conexión a la base de datos
$conn = Conectarse();

// Verificar si se recibió el ID de estudiante en la solicitud
if(isset($_GET['idEstudiante'])) {
    // Obtener el ID de estudiante de la solicitud
    $idEstudiante = $_GET['idEstudiante'];

    // Consulta para obtener los boletines filtrados por ID de estudiante
    $sql_boletines = "SELECT * FROM boletines WHERE idEstudiante = '$idEstudiante'";
    $result_boletines = $conn->query($sql_boletines);

    // Construir la tabla de resultados
    if ($result_boletines->num_rows > 0) {
        while ($row_boletines = $result_boletines->fetch_assoc()) {
            echo '<tr>';
            echo '<th scope="row">' . $row_boletines['idBoletin'] . '</th>';
            echo '<td>' . $row_boletines['idEstudiante'] . '</td>';
            echo '<td>' . $row_boletines['direccionArchivo'] . '</td>';
            echo '<td>' . $row_boletines['fechaCreacion'] . '</td>';
            echo '<td><a href="Boletines/Validacion/download.php?idBoletin=' . $row_boletines['idBoletin'] . '" class="btn btn-primary px-4 mx-auto my-2">Descargar</a></td>';
            echo '</tr>';
        }
    } else {
        // Si no se encontraron boletines para el ID de estudiante proporcionado
        echo '<tr><td colspan="5">No se encontraron boletines para el ID de estudiante proporcionado.</td></tr>';
    }
} else {
    // Si no se proporcionó el ID de estudiante en la solicitud
    echo '<tr><td colspan="5">No se proporcionó el ID de estudiante.</td></tr>';
}
?>
