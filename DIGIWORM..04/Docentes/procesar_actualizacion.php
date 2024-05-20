<?php
require_once "../modelo/conexion.php";
$conn = Conectarse();
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y sanitizarlos
    $id_docente = $_POST['id_docente'];
    $nombres = htmlspecialchars($_POST['nombres']);
    $apellidos = htmlspecialchars($_POST['apellidos']);
    $email = htmlspecialchars($_POST['email']);
    $curso = $_POST['curso'];
    $jornada = $_POST['jornada'];
    $Descripcion = htmlspecialchars($_POST['Descripcion']);

    // Iniciar una transacción
    $conn->begin_transaction();

    try { if (isset($_FILES['Archivo']) && $_FILES['Archivo']['error'] === UPLOAD_ERR_OK) {
        // Manejar el archivo enviado
        // Definir la carpeta de destino para guardar el archivo
        $carpeta_destino = "./files/";

        // Obtener el nombre y la extensión del archivo
        $nombre_archivo = basename($_FILES["Archivo"]["name"]);
        $archivo_destino = $carpeta_destino . $nombre_archivo;
        $archivo_Bd = "Docentes/files/".$nombre_archivo;
        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["Archivo"]["tmp_name"], $archivo_destino)) {
        // Consulta SQL para actualizar los datos del docente
        if (isset($_POST['actualizar'])) {
            $sql = "UPDATE docente SET Nombres=?, Apellidos=?, Email=?, Curso=?,  Jornada=?, Certificacion=?, Desc_prof=? WHERE idDocente=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssisssi", $nombres, $apellidos, $email, $curso, $jornada, $archivo_Bd, $Descripcion, $id_docente);

            // Ejecutar la actualización
            $update_success = $stmt->execute();
            $stmt->close();

            // Verificar si la actualización fue exitosa
            if (!$update_success) {
                throw new Exception("Error al actualizar los datos del docente");
            }
        }

        // Verificar si se debe insertar una materia
        if (isset($_POST['AgregarMateria'])) {
            $materia = $_POST['materia'];
            if (!empty($materia)) {
                // Consulta SQL para insertar la materia
                $sql_insert = "INSERT INTO docente_materia (idDocente, idMateria) VALUES (?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param("ii", $id_docente, $materia);
                $stmt_insert->execute();
                $stmt_insert->close();
            }
        }

        // Confirmar la transacción
        $conn->commit();

        // Redirigir al usuario a la página de docentes
        header('Location: ../Docentes.php');
        exit;
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    // Cerrar conexión
    $conn->close();
}
?>
