<?php
<?php
include "db.php";

// Obtener el ID de la actividad desde la URL
$id = $_GET['idactividades'];

// Agregar encabezados CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization');

// Resto de tu código...


// Buscar el archivo en la base de datos
$sql = "SELECT * FROM actividades WHERE idactividades = '$id'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 1) {
    $fila = mysqli_fetch_assoc($resultado);
    $archivo = $fila['Archivo'];
    $ruta_archivo = "files/" . $archivo;

    // Verificar que el archivo exista en el servidor
    if (file_exists($ruta_archivo)) {
        // Enviar el archivo al navegador
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $archivo . '"');
        readfile($ruta_archivo);
        exit; // Importante: detener la ejecución del script después de enviar el archivo
    } else {
        echo "El archivo no existe en el servidor.";
    }
} else {
    echo "El archivo no se encontró en la base de datos.";
}
?>
