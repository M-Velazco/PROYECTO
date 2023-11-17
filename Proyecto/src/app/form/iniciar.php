<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["Idusuario"];
  $contrasena = $_POST["Contraseña"];

  // Configuración de la conexión a la base de datos
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "digiworm";

  // Crear una conexión
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Verificar si la conexión tiene errores
  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }

  // Check the result
  if ($result->num_rows > 0) {
    // Successful login
    // Redirect to another page
    header("Location: index.component.html");
    exit();
} else {
    // Incorrect credentials
    echo "Credenciales incorrectas";
}

// Close the connection
$conn->close();
}
?>