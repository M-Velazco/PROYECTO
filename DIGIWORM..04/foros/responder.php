<?php
// Inicia la sesión
session_start();

// Verifica si el usuario está conectado
if (isset($_SESSION['Idusuario'])) {
    // Verifica si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $titulo = $_POST["titulo"];
        $respuesta = htmlspecialchars($_POST["respuesta"]);
        $id_usuario = $_SESSION['Idusuario'];

        // Guardar la respuesta en la base de datos
        // Reemplaza 'tu_conexion' con tu conexión a la base de datos
        $conn = new mysqli('localhost', 'root', 'sena', 'digiworm_04');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Escapar los valores para prevenir inyección SQL
        $titulo = $conn->real_escape_string($titulo);
        $id_usuario = $conn->real_escape_string($id_usuario);
        $respuesta = $conn->real_escape_string($respuesta);

        $sql = "UPDATE foros SET respuesta = CONCAT(IFNULL(respuesta, ''), '$respuesta\n') WHERE titulo = '$titulo'";
        if ($conn->query($sql) === TRUE) {
            echo "Respuesta enviada correctamente.<br>";
        } else {
            echo "Error al enviar la respuesta: " . $conn->error;
        }

        $conn->close();
    }
} else {
    // Si el usuario no está conectado, redirige a la página de inicio de sesión
    header('Location: form.php?error=nologeado');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Responder Foro</title>
    <style>
      /* Estilos CSS */
      body {
    background-color: #73cdff; /* Color de fondo verde pastel */
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('../img/coolegio.jpg');
    background-size: cover; 
    background-repeat: no-repeat; 
}
        form {
            background-color: #fff; /* Fondo blanco */
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            margin: 0 auto;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        input[type="text"],
        textarea,
        input[type="datetime-local"],
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #4caf50; /* Color de fondo verde */
            color: white;
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
<?php
        // Conexión a la base de datos y consulta de las materias
        $conexion = new mysqli("localhost", "root", "sena", "digiworm_04");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        $consulta = $conexion->query("SELECT  * FROM foros WHERE idForos={$_GET['id']}");

        // Generar las opciones del select
        
        // Cerrar la conexión
        $conexion->close();
        ?>
<a href="javascript:history.go(-2);" class="boton">Salir</a>

    <h2 style="text-align: center;">Responder Foro</h2>
    <?php if (!empty($mensaje)) : ?>
        <div style="text-align: center; color: <?php echo strpos($mensaje, "Error") !== false ? 'red' : 'green'; ?>;">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    <form action="responder.php" method="post">
    Título del foro: <input type="text" name="titulo"value='<?php echo'Titulo' ?>' required><br><br>
        Respuesta: <textarea name="respuesta" required></textarea><br><br>
        <input type="submit" value="Enviar Respuesta">
    </form>
</body>
</html>
