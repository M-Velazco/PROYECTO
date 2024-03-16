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
            background-size: cover; 
            background-repeat: no-repeat; 
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

        .boton {
            background-color: #4caf50;
            /* Color de fondo verde */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .boton:hover {
            background-color: #45a049;
            /* Cambio de color al pasar el ratón */
        }
    </style>
</head>
<body>
<a href="javascript:history.go(-1);" class="boton">Salir</a>
    <h1>Foros</h1>
   
    <div class="foro">
        <?php
        // Conexión a la base de datos y consulta de las materias
        $conexion = new mysqli("localhost", "root", "sena", "digiworm_04");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        $consulta = $conexion->query("SELECT * FROM foros");
        
        // Generar las opciones del select
        while ($fila = $consulta->fetch_assoc()) {
            $Nombres_FU = $objUsuarios->obtenerNombreUsuario($fila['idusuario']);
            ?>
            <h2>
                <?php echo $fila['Titulo']; ?>
            </h2>
            <p><strong>Fecha de creación:</strong>
                <?php echo $fila['Fecha_Hora']; ?>
            </p>
            <p><strong>Creado por:</strong>
                <?php echo $Nombres_FU; ?>
            </p>
            <a href="responder.php?titulo=<?php echo urlencode($fila['Titulo']); ?>" class="boton">Responder Foro</a>

            <?php
        }

        // Cerrar la conexión
        $conexion->close();
        ?>
    </div>
</body>
</html>
