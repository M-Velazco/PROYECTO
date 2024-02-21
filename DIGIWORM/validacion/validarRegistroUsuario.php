<?php
require "../modelo/USUARIO.php";
require "../modelo/conexion.php";

// Recoger datos del formulario
$contrasena = $_POST['Pasword'];
$paswordmd5 = md5($contrasena);

// Crear instancia de la clase Usuario
$objUsuario = new Usuario();

// Llamar al método para crear el usuario
$objUsuario->crearUsuario(
    $_POST['Idusuario'],
    $_POST['Nombres'],
    $_POST['Apellidos'],
    $_POST['Email'],
    $_POST['Telefono'],
    $paswordmd5,
    $_POST['img'],
    $_POST['Rol'],
    $_POST['Estado'],
	$_POST['Curso'],
	$_POST['Materia'],
	$_POST['Jornada']

);

// Llamar al método para agregar el usuario
$resultado = $objUsuario->agregarUsuario();

if ($resultado) {
    header("Location: " . $_SERVER['HTTP_REFERER']); // Redireccionar si se agregó correctamente
} else {
    echo "No se ha registrado correctamente"; // Mostrar mensaje de error si falla
}
?>
