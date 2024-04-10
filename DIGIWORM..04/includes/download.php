<?php
include_once "../modelo/conexion.php";
// Verificar si se ha proporcionado un ID de actividad
if(isset($_GET['idActividades'])) {
    // Obtener el ID de la actividad desde la URL
    $idActividad = $_GET['idActividades'];

    // Conectar a la base de datos
    $conexion = Conectarse();
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Preparar la consulta SQL para obtener la ruta del archivo
    $sql = "SELECT Archivo FROM actividades WHERE idActividades = ?";
    $stmt = $conexion->prepare($sql);

    // Vincular el parámetro
    $stmt->bind_param("i", $idActividad);

    // Ejecutar la consulta
    $stmt->execute();

    // Vincular el resultado
    $stmt->bind_result($ruta_archivo);

    // Obtener la ruta del archivo
    $stmt->fetch();

    // Imprimir la ruta del archivo (para fines de depuración)
    echo "Ruta del archivo en la base de datos: " . $ruta_archivo . "<br>";

    // Cerrar el statement
    $stmt->close();

    // Cerrar la conexión
    $conexion->close();

    // Verificar si se encontró la ruta del archivo
    if(!empty($ruta_archivo)) {
        // Ruta completa del archivo en el servidor (relativa)
        $archivo_servidor = "./files/" . $ruta_archivo;

        // Verificar si el archivo existe en el servidor
        if(file_exists($archivo_servidor)) {
            // Establecer las cabeceras para forzar la descarga
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($archivo_servidor) . '"');
            header('Content-Length: ' . filesize($archivo_servidor));

            // Leer y enviar el archivo al navegador
            readfile($archivo_servidor);
            exit;
        } else {
            // El archivo no existe en el servidor
            echo "El archivo no existe en el servidor.";
        }
    } else {
        // No se encontró la ruta del archivo en la base de datos
        echo "No se encontró la ruta del archivo en la base de datos.";
    }
} else {
    // No se proporcionó un ID de actividad
    echo "Error: No se proporcionó un ID de actividad.";
}
?>
