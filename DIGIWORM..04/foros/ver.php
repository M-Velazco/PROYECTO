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
    <title>Ver Foros</title>
    <style>
        body {
            background-color: #73cdff;
            /* Color de fondo verde pastel */
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        .foro {
            background-color: #fff;
            /* Fondo blanco */
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            width: 80%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .foro h2 {
            color: #4caf50;
            /* Color verde */
            margin-bottom: 10px;
        }

        .foro p {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h1>Foros</h1>
    <div class="foro">
        <h2></h2>
        <p>Descripción del foro</p>
        <p><strong>Fecha de creación:</strong> 2024-02-29</p>
        <p><strong>Creado por:</strong> Usuario123</p>
        <a href="ver_foro.php?id=1">Ver Foro</a>
    </div>
    <div class="foro">
        <?php
        // Conexión a la base de datos y consulta de las materias
        $conexion = new mysqli("localhost", "root", "sena", "digiworm_04");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        $consulta = $conexion->query("SELECT  * FROM foros");

        // Generar las opciones del select
        while ($fila = $consulta->fetch_assoc()) {
            ?>
            <h2>
                <?php echo $fila['Titulo']; ?>
            </h2>
            <p><strong>Fecha de creación:</strong>
                <?php echo $fila['Fecha_Hora']; ?>
            </p>
            <p><strong>Creado por:</strong>
                <?php echo $nombre_usuario; ?>
            </p>
            <?php
        }

        // Cerrar la conexión
        $conexion->close();
        ?>
    </div>
</body>

</html>