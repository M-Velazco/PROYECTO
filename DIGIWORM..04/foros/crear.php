<?php
// Inicia la sesión
session_start();

// Variable para almacenar el mensaje de éxito o error
$mensaje = "";

// Verifica si el usuario está conectado
if (isset($_SESSION['Idusuario'])) {
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

    $conn = Conectarse();
    // Verifica si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $titulo = $_POST["titulo"];
        $descripcion = $_POST["descripcion"];
        $fecha_creacion = $_POST["fecha_creacion"];
        $id_usuario = $_SESSION['Idusuario'];

        // Manejo de archivos adjuntos
        $archivos = array();
        if (!empty($_FILES['archivos']['name'][0])) {
            foreach ($_FILES['archivos']['name'] as $key => $value) {
                $nombre_archivo = $_FILES['archivos']['name'][$key];
                $ruta_temporal = $_FILES['archivos']['tmp_name'][$key];
                $ruta_destino = "archivos/" . $nombre_archivo;
                move_uploaded_file($ruta_temporal, $ruta_destino);
                $archivos[] = $ruta_destino;
            }
        }

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO `foros`(`Titulo`, `Contenido`, `Fecha_Hora`, `archivo`, `idusuario`) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        // Enlaza los parámetros con sus respectivos tipos
        mysqli_stmt_bind_param($stmt, "ssssi", $titulo, $descripcion, $fecha_creacion, $ruta_destino, $id_usuario);

        // Ejecuta la declaración
        if (mysqli_stmt_execute($stmt)) {
            // Mensaje de éxito si la inserción fue exitosa
            $mensaje = "Foro creado exitosamente";
        } else {
            // Mensaje de error si hubo un problema con la inserción
            $mensaje = "Error al insertar los datos: " . mysqli_error($conn);
        }
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
    <title>Crear Foro</title>
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
<a href="../foros.php" class="boton">Salir</a>
    <h2 style="text-align: center;">Crear Foro</h2>
    <?php if (!empty($mensaje)) : ?>
        <div style="text-align: center; color: <?php echo strpos($mensaje, "Error") !== false ? 'red' : 'green'; ?>;">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" onsubmit="return validarFecha()">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea><br><br>
        <label for="fecha_creacion">Fecha y hora de creación:</label>
        <input type="datetime-local" id="fecha_creacion" name="fecha_creacion" required><br><br>
        <label for="archivos">Archivos adjuntos (obligatorio al menos uno):</label>
        <input type="file" id="archivos" name="archivos[]" multiple required><br><br>
        <input type="submit" value="Crear Foro">
    </form>

    <script>
        function validarFecha() {
            var fecha = new Date(document.getElementById("fecha_creacion").value);
            var fechaActual = new Date();
            if (fecha < fechaActual) {
                alert("La fecha y hora de creación no puede ser anterior al día de hoy.");
                return false;
            }
            // Validar que se haya seleccionado al menos un archivo
            var archivos = document.getElementById("archivos").files;
            if (archivos.length === 0) {
                alert("Debe seleccionar al menos un archivo adjunto.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
