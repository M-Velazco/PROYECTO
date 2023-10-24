<?php
//Se reciben los datos del formulario
require ( "../modelo\USUARIO.php");
require "../modelo/conexion.php";
extract ($_REQUEST);

//Forma utilizando la Clase Empleado
$contrasena = $_REQUEST['Contrasena'];
$contrasenamd5 = md5($contrasena);
$objUsuario = new Usuario();


$objUsuario->crearUsuario($_REQUEST['Idusuario'] , $_REQUEST['Nombre'], $_REQUEST['Correo'], $_REQUEST['Telefono'] ,$contrasenamd5 , $_REQUEST['Rol']);

$resultado = $objUsuario->agregarUsuario();

if ($resultado == TRUE)
header("Location: " . $_SERVER['HTTP_REFERER']);  //x=5 quiere decir que se agrego bien
else
	echo "no se ha registrado bien"; //x=6 quiere decir que no se pudo agregar

	//validacion del correo no funciona por config php//
	/*if ($resultado == TRUE) {
		// Agregar el código para enviar el correo de validación aquí
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Obtener la dirección de correo electrónico ingresada por el usuario
			$correo = $_REQUEST["Correo"];
			
			// Generar un código de validación (esto puede ser aleatorio o como desees)
			$codigo_validacion = uniqid();
		
			// Asunto y mensaje del correo
			$asunto = "Código de Validación";
			$mensaje = "Tu código de validación es: $codigo_validacion";
		
			// Enviar el correo de validación
			if (mail($correo, $asunto, $mensaje)) {
				echo "Se ha enviado un correo de validación a $correo. Por favor, verifica tu bandeja de entrada.";
			} else {
				echo "Error al enviar el correo de validación. Por favor, intenta de nuevo más tarde.";
			}
		} else {
			echo "Acceso no válido.";
		}
	} else {
		echo "No se ha registrado bien";
	}*/
?>