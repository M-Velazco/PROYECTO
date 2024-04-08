<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_docente = $_POST['id_docente'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];
    $materia = $_POST['materia'];
    $jornada = $_POST['jornada'];

   require_once"../modelo/conexion.php";
   $conn = Conectarse();

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para actualizar los datos del docente
    $sql = "UPDATE docente SET Nombres='$nombres', Apellidos='$apellidos', Email='$email', Curso=$curso, Materia=$materia, Jornada='$jornada' WHERE idDocente=$id_docente";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../Docentes.php');
    } else {
        echo "Error al actualizar los datos del docente: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>
