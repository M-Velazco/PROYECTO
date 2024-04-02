<?php
$titulo = isset($_GET['titulo']) ? htmlspecialchars($_GET['titulo']) : '';

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

        // Obtener el estado del foro
        $sql_estado = "SELECT Estado FROM foros WHERE Titulo = '$titulo'";
        $result_estado = $conn->query($sql_estado);
        if ($result_estado->num_rows > 0) {
            $row_estado = $result_estado->fetch_assoc();
            $Estado = $row_estado['Estado'];

            // Si el foro está inactivo, mostrar mensaje y salir
            if ($Estado == 'inactivo') {
                $mensaje = "No se puede responder a un foro inactivo.";
            } else {
                $sql = "UPDATE foros SET respuesta = CONCAT(IFNULL(respuesta, ''), '$respuesta\n') WHERE titulo = '$titulo'";
                if ($conn->query($sql) === TRUE) {
                    $mensaje = "Respuesta enviada correctamente.<br>";
                } else {
                    $mensaje = "Error al enviar la respuesta: " . $conn->error;
                }
            }
        } else {
            $mensaje = "No se encontró el foro especificado.";
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
            background-image: url('../img/datos.jpg');
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
    <a href="javascript:history.go(-3);" class="boton">Salir</a>
    <h2 style="text-align: center;">Responder Foro</h2>
    <?php if (!empty($mensaje)) : ?>
        <div style="text-align: center; color: <?php echo strpos($mensaje, "Error") !== false ? 'red' : 'green'; ?>;">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    <form action="responder.php" method="post">
        Título del foro: <input type="text" name="titulo" value="<?php echo $titulo; ?>" required><br><br>
        Contenido del foro:<br>
        <?php
        $conn = new mysqli('localhost', 'root', 'sena', 'digiworm_04');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        $sql_contenido = "SELECT Contenido FROM foros WHERE Titulo = '$titulo'";
        $result_contenido = $conn->query($sql_contenido);
        if ($result_contenido->num_rows > 0) {
            $row_contenido = $result_contenido->fetch_assoc();
            echo '<textarea name="contenido" rows="4" cols="50" readonly>' . $row_contenido['Contenido'] . '</textarea><br><br>';
        } else {
            echo "No se encontró el foro especificado.";
        }
        $conn->close();
        ?>
        Respuesta: <textarea name="respuesta" required></textarea><br><br>
        <input type="submit" value="Enviar Respuesta">
    </form>
</body>
</html>
