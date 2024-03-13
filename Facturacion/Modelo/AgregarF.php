<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se han enviado todos los campos requeridos
    if (isset($_POST["IdUser"]) && isset($_POST["Motivo"]) && isset($_POST["Cancelacion"]) && isset($_POST["Nombre_A"]) && isset($_POST["Costo"]) && isset($_POST["Cantidad"])) {
        // Recupera los valores del formulario
        $idUser = $_POST["IdUser"];
        $motivo = $_POST["Motivo"];
        $cancelacion = $_POST["Cancelacion"];
        $nombreA = $_POST["Nombre_A"];
        $costo = $_POST["Costo"];
        $cantidad = $_POST["Cantidad"];

        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "sena", "facturacion");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        
        // Prepara la consulta SQL para insertar los datos en la tabla
        $sql = "INSERT INTO cancelacion (IdUser, Motivo, Cancelacion, Nombre_A, Costo, Cantidad) VALUES (?, ?, ?, ?, ?, ?)";
        
        // Prepara la declaración
        $stmt = $conexion->prepare($sql);
        
        // Verifica si la preparación de la consulta fue exitosa
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $conexion->error);
        }
        
        // Vincula los parámetros de la consulta con los valores del formulario
        $stmt->bind_param("isssii", $idUser, $motivo, $cancelacion, $nombreA, $costo, $cantidad);
        
        // Ejecuta la consulta
        if ($stmt->execute()) {
            // Operación exitosa
            echo "Registro agregado exitosamente.";
        } else {
            // Error al ejecutar la consulta
            echo "Error al agregar el registro: " . $conexion->error;
        }
        
        // Cierra la conexión
        $stmt->close();
        $conexion->close();
    } else {
        // Si faltan campos, muestra un mensaje de error
        echo "Por favor, complete todos los campos del formulario.";
    }
} else {
    // Si no se envió el formulario mediante POST, redirige a alguna página de error o muestra un mensaje apropiado
    echo "Acceso no autorizado.";
}
?>
