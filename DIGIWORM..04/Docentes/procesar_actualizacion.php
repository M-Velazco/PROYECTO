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

    try {
        // Consulta SQL para actualizar los datos del docente
        if (isset($_POST['actualizar'])) {
            $sql = "UPDATE docente SET Nombres=?, Apellidos=?, Email=?, Curso=?, Jornada=?, Certificacion=?, Desc_prof=? WHERE idDocente=?";
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
        // Verificar si se debe insertar una materia
        if (isset($_POST['AgregarCurso'])) {
            $Curso_ext = $_POST['Curso_ext'];
            if (!empty($Curso_ext)) {
                // Consulta SQL para insertar la materia
                $sql_insert = "INSERT INTO docente_curso (idDocente, idCurso) VALUES (?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param("ii", $id_docente, $Curso_ext);
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