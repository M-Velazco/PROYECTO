<?php
// Inicia la sesión
session_start();

// Verifica si la variable de sesión 'Idusuario' está establecida para determinar si el usuario está conectado
if (isset($_SESSION['Idusuario'])) {
    $usuario_conectado = true;

    // Crea una instancia de la clase Usuario y conecta a la base de datos
    require_once "../modelo/USUARIO.php";
    require_once "../modelo/conexion.php";
    require_once "configuracion.php";
    $objConexion = Conectarse();
    $objUsuarios = new Usuario($objConexion);

    // Obtiene el nombre del usuario basado en su ID
    $nombre_usuario = $objUsuarios->obtenerNombreUsuario($_SESSION['Idusuario']);

    // Obtiene la ruta de la imagen de perfil del usuario
    $ruta_imagen = $objUsuarios->obtenerRutaImagenUsuario($_SESSION['Idusuario']);
    $rol_usuario = $objUsuarios->obtenerRutaImagenUsuario($_SESSION['Idusuario']);



} else {
    $usuario_conectado = false;
    header('Location: form.php?error=nologeado');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Responder Foro</title>
    <style>
        body {
            background-img:url("img/header.png");
            background-color: #73B0FF; /* Color de fondo verde pastel */
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
    
        }
        form {
            background-color: #fff; /* Fondo blanco */
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            margin: 0 auto;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="file"] {
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background-color: #4caf50; /* Color de fondo verde */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049; /* Cambio de color al pasar el ratón */
        }
        .boton {
    background-color: #4caf50;
    /* Color de fondo verde */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    position: absolute;
    top: 20px;
    left: 20px;
}

.boton:hover {
    background-color: #45a049;
    /* Cambio de color al pasar el ratón */
}
    </style>
</head>
<body>
<a href="javascript:history.go(-1);" class="boton">Salir</a>
    <h2 style="text-align: center;">Responder Foro</h2>
    <form action="responder.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_foro" value=>
        Respuesta: <textarea name="respuesta" required></textarea><br><br>
        Archivos adjuntos (opcional): <input type="file" name="archivos[]" multiple><br><br>
        <input type="submit" value="Enviar Respuesta">
    </form>
</body>
</html>
