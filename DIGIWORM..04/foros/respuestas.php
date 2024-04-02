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
} else {
    $usuario_conectado = false;
    header('Location: form.php?error=nologeado');
    exit(); // Termina el script para evitar que se siga ejecutando
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ver Foros</title>
    <style>
       body {
            background-color: #73cdff; /* Color de fondo verde pastel */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../img/coolegio.jpg');
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        .foro {
            background-color: #fff; /* Fondo blanco */
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            width: 80%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .foro h2 {
            color: #4caf50; /* Color verde */
            margin-bottom: 10px;
        }

        .foro p {
            margin-bottom: 10px;
        }

        .foro .respuesta {
            color: #333; /* Color de texto */
            font-size: 14px; /* Tamaño de fuente */
            margin-bottom: 5px; /* Espaciado inferior */
        }

        .boton {
            background-color: #4caf50; /* Color de fondo verde */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none; /* Eliminar subrayado enlaces */
            display: inline-block; /* Mostrar como bloque en línea */
            margin-top: 20px; /* Espaciado superior */
        }

        .boton:hover {
            background-color: #45a049; /* Cambio de color al pasar el ratón */
        }
   
    </style>
</head>
<body>
<a href="javascript:history.go(-1);" class="boton">Salir</a>
<h1>Foros</h1>

<div class="foro">
    <?php
    // Conexión a la base de datos y consulta de los foros
    $conexion = new mysqli("localhost", "root", "sena", "digiworm_04");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    $consultaForos = $conexion->query("SELECT * FROM foros");
    

    // Mostrar los foros y sus respuestas
    while ($filaForo = $consultaForos->fetch_assoc()) {
        ?>
        <h2>
            <?php echo $filaForo['Titulo']; ?>
        </h2>
        <p><strong>Fecha de creación:</strong>
            <?php echo $filaForo['Fecha_Hora']; ?>
        </p>
        
       

        <?php
        // Consulta de las respuestas para el foro actual
        $consultaRespuestas = $conexion->query("SELECT * FROM foros WHERE idForos = " . $filaForo['idForos']);

        // Verificar si la consulta de respuestas es válida antes de recorrerla
        if ($consultaRespuestas !== false && $consultaRespuestas->num_rows > 0) {
            while ($filaRespuesta = $consultaRespuestas->fetch_assoc()) {
                // Obtener el nombre del usuario que respondió el foro
                $consultaUsuario = $conexion->query("SELECT Nombres FROM usuarios WHERE idusuario = " . $filaRespuesta['idusuario']);
                $nombreUsuarioRespuesta = "";
                if ($consultaUsuario !== false && $consultaUsuario->num_rows > 0) {
                    $nombreUsuarioRespuesta = $consultaUsuario->fetch_assoc()['Nombres'];
                }
                ?>
                <h3>Respuesta de <?php echo $nombreUsuarioRespuesta ?>:</h3>
                <p class="respuesta"><?php echo $filaRespuesta['respuesta']; ?></p>
                
                    
                </p>
                <?php
            }
        } else {
            echo "No hay respuestas para este foro.";
        }
        ?>
        
       
        <?php
    }

    // Cerrar la conexión
    $conexion->close();
    ?>
</div>
</body>
</html>
