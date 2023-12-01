<?php
require("./modelo/usuario.php");
require("./modelo/conexion.php");

if (isset($_GET['Idusuarios'])) {
    $objConexion = Conectarse();
    $Idusuarios = $_GET['Idusuarios'];

    $objUsuario = new Usuario();
    $resultado = $objUsuario->eliminarUsuario($Idusuarios);

    if ($resultado) {
        header("location: consultarU.php?x=7"); // x=7 significa que se eliminó correctamente
    } else {
        header("location: consultarU.php?x=8"); // x=8 significa que hubo un problema al eliminar
    }

    // Cerrar la conexión y liberar recursos
    $objConexion->close();
} else {
    header("location: consultarU.php"); // Redirigir si no se proporciona el Idusuarios
}
?>
