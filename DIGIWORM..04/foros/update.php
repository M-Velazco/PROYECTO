<?php
// Inicia la sesión
session_start();

// Verifica si el usuario está conectado
if (isset($_SESSION['Idusuario'])) {
    // Verifica si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $idForos = isset($_POST['idForos']) ? htmlspecialchars($_POST['idForos']) : '';
        $titulo = isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : '';
        $descripcion = isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : '';
        $fecha_creacion = isset($_POST['fecha_creacion']) ? htmlspecialchars($_POST['fecha_creacion']) : '';

        // Conectarse a la base de datos y actualizar los datos del foro
        $conn = new mysqli('localhost', 'root', 'sena', 'digiworm_04');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        $sql = "UPDATE foros SET Titulo = '$titulo', Contenido = '$descripcion', Fecha_Hora = '$fecha_creacion' WHERE idForos = '$idForos'";
        if ($conn->query($sql) === TRUE) {
            echo "Foro actualizado correctamente.<br>";
        } else {
            echo "Error al actualizar el foro: " . $conn->error;
        }
        $conn->close();
    } else {
        // Si no se envió el formulario, redirigir a la página anterior
        header('Location: editar_foro.php?idForos=' . $_GET['idForos']);
        exit();
    }
} else {
    // Si el usuario no está conectado, redirigir a la página de inicio de sesión
    header('Location: form.php?error=nologeado');
    exit();
}
?>
