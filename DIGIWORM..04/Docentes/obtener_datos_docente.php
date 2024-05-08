<?php
require_once "../modelo/conexion.php";

// Verificar si se recibió un ID de docente
if(isset($_GET['id'])) {
    $id_docente = $_GET['id'];

    // Conexión a la base de datos
    $conn = Conectarse();

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para obtener los datos del docente y las materias asignadas
    $sql = "SELECT d.Nombres, d.Apellidos, d.Email, d.Jornada, d.Desc_prof, d.Certificacion,
    GROUP_CONCAT(m.Nombre_Materia SEPARATOR ', ') AS Materias
    FROM docente d
    LEFT JOIN docente_materia dm ON d.idDocente = dm.idDocente
    LEFT JOIN materias m ON dm.idMateria = m.idMaterias
    WHERE d.idDocente = $id_docente
    GROUP BY d.idDocente;";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo "No se encontraron datos para el docente con ID: " . $id_docente;
    }

    // Cerrar conexión
    $conn->close();
} else {
    echo "No se proporcionó un ID de docente";
}
?>
