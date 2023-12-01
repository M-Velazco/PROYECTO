<?php
require("../modelo/USUARIO.php");
require("../modelo/conexion.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
    $objConexion = Conectarse();

    // Hash de la contraseña utilizando password_hash (método más seguro)
    $contraseñaHash = password_hash($NuevaContrasena, PASSWORD_BCRYPT);

    // Consulta preparada para evitar la inyección SQL
    $sql = "UPDATE usuarios SET Nombre_apellido=?, Correo=?, Telefono=?, Contraseña=?, Rol=? WHERE idusuarios=?";
    $stmt = $objConexion->prepare($sql);
    $stmt->bind_param("sssssi", $Nombre, $Correo, $Telefono, $contraseñaHash, $Rol, $Idusuario);
    $resultado = $stmt->execute();

    if ($resultado === TRUE) {
        header("location: ../consultarU.php?x=1"); // x=1 significa que se modificó correctamente
    } else {
        echo "No se pudo actualizar"; // x=2 significa que no se pudo modificar
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $objConexion->close();
} else {
    // Manejo de error si el formulario no se envió por POST
    echo "Error: El formulario no se ha enviado correctamente.";
}
?>
