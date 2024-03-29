<?php

// Inicia la sesión
session_start();

// Verifica si el usuario está conectado
if(isset($_SESSION['Idusuario'])) {
    $usuario_conectado = true;
    
    // Incluye el archivo de conexión a la base de datos
    require_once "../modelo/conexion.php";
    $objConexion = Conectarse(); // Función para establecer la conexión
    
    if(isset($_POST['registrar'])) {
        // Se ha enviado el formulario

        // Directorio de destino para los archivos cargados
        $directorio_destino = "publicUploads/";

        // Verificar si se subió correctamente el archivo
        if(isset($_FILES['Archivo']) && $_FILES['Archivo']['error'] === UPLOAD_ERR_OK) {
            // Obtener información sobre el archivo cargado
            $nombre_archivo = $_FILES['Archivo']['name'];
            $tipo_archivo = $_FILES['Archivo']['type'];
            $ruta_temporal = $_FILES['Archivo']['tmp_name'];
            $tamano_archivo = $_FILES['Archivo']['size'];

            // Verificar si el archivo es un PDF o un documento Word
            $extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            if($extension == 'pdf' || $extension == 'docx' || $extension == 'doc') {
                // Generar un nombre único para el archivo
                $nombre_unico = uniqid('publicacion_') . '.' . $extension;

                // Mover el archivo a la carpeta de destino
                $ruta_final = $directorio_destino . $nombre_unico;
                if(move_uploaded_file($ruta_temporal, $ruta_final)) {
                    // El archivo se movió correctamente

                    // Aquí iría el código para insertar los datos en la base de datos
                    // Ejemplo de inserción en la base de datos
                    $sql = "INSERT INTO publicaciones (Archivo, Descripcion, usuario) VALUES (?, ?, ?)";
                    $stmt = $objConexion->prepare($sql);
                    $stmt->bind_param("ssi",  $ruta_final, $_POST['Descripcion'],$_SESSION['Idusuario']);
                    $stmt->execute();

                    header("Location:publicaciones.php");
                } else {
                    echo "Error al mover el archivo.";
                }
            } else {
                echo "Formato de archivo no admitido. Solo se admiten archivos PDF y documentos Word.";
            }
        } else {
            echo "Error al cargar el archivo.";
        }
    }
} else {
    $usuario_conectado = false;
    header('Location: form.php?error=nologeado');
}

?>
