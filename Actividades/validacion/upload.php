<?php
// Verificar si se envió un archivo
if (isset($_FILES['file']) && isset($_POST['idactividades']) && isset($_POST['Nom_act']) && isset($_POST['Materia_act']) && isset($_POST['Docente'])) {
    // Conexión a la base de datos (debes configurar esto)
    $servername = "localhost";
    $username = "tu_usuario";
    $password = "tu_contraseña";
    $dbname = "tu_base_de_datos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión a la base de datos fallida: " . $conn->connect_error);
    }

    // Obtener información del archivo
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];

    // Leer el contenido del archivo
    $fileData = file_get_contents($fileTmpName);

    // Obtener los datos del formulario
    $idactividades = $_POST['idactividades'];
    $Nom_act = $_POST['Nom_act'];
    $Materia_act = $_POST['Materia_act'];
    $Docente = $_POST['Docente'];

    // Insertar el archivo y los datos en la base de datos
    $sql = "INSERT INTO archivos (idactividades, Nom_act, Materia_act, Docente, nombre, contenido) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $idactividades, $Nom_act, $Materia_act, $Docente, $fileName, $fileData);

    if ($stmt->execute()) {
        echo "Archivo y datos subidos y almacenados en la base de datos correctamente.";
    } else {
        echo "Error al subir el archivo y datos: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Por favor, complete todos los campos y seleccione un archivo antes de enviar el formulario.";
}
?>
