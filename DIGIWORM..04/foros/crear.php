<?php
require('configuracion.php');

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $fecha_creacion = $_POST["fecha_creacion"];

    // Manejo de archivos adjuntos (si los hay)
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
    $sql = "INSERT INTO foro (titulo, descripcion, fecha_creacion) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $titulo, $descripcion, $fecha_creacion);
    mysqli_stmt_execute($stmt);
    $id_foro = mysqli_insert_id($con);

    // Guardar los archivos adjuntos en la base de datos (si los hay)
    foreach ($archivos as $archivo) {
        $sql = "INSERT INTO archivos (id_foro, ruta_archivo) VALUES (?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "is", $id_foro, $archivo);
        mysqli_stmt_execute($stmt);
    }

    // Redirigir a una página de éxito
    header("Location: exito.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Foro</title>
    <style>
        /* Estilos CSS */
    </style>
    <style>
    body {
        background-color: #f0f8f7; /* Color de fondo verde pastel */
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
</style>
<style>
    body {
        background-color: #f0f8f7; /* Color de fondo verde pastel */
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
</style>

</head>
<body>
    <h2 style="text-align: center;">Crear Foro</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        Título: <input type="text" name="titulo" required><br><br>
        Descripción: <textarea name="descripcion" required></textarea><br><br>
        Fecha y hora de creación: <input type="datetime-local" name="fecha_creacion" required><br><br>
        Archivos adjuntos (opcional): <input type="file" name="archivos[]" multiple><br><br>
        <input type="submit" value="Crear Foro">
    </form>
</body>
</html>
