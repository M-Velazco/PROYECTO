<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "usuario", "contraseña", "foro_db");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Crear un nuevo foro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["titulo"]) && isset($_POST["contenido"])) {
    $titulo = $_POST["titulo"];
    $contenido = $_POST["contenido"];
    $archivo = "";

    // Subir archivo si se proporcionó
    if ($_FILES["archivo"]["name"]) {
        $archivo = $_FILES["archivo"]["name"];
        move_uploaded_file($_FILES["archivo"]["tmp_name"], "uploads/" . $archivo);
    }

    $sql = "INSERT INTO foros (titulo, contenido, archivo) VALUES ('$titulo', '$contenido', '$archivo')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al crear el foro: " . $conexion->error;
    }
}

// Obtener todos los foros
$sql = "SELECT * FROM foros";
$resultado = $conexion->query($sql);

$foros = [];
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $foros[] = $row;
    }
}

// Mostrar los foros
foreach ($foros as $foro) {
    echo "<div class='foro'>";
    echo "<h3>" . $foro["titulo"] . "</h3>";
    echo "<p>" . $foro["contenido"] . "</p>";
    if ($foro["archivo"]) {
        echo "<p><a href='uploads/" . $foro["archivo"] . "' target='_blank'>Descargar archivo</a></p>";
    }
    echo "</div>";
}

$conexion->close();
?>