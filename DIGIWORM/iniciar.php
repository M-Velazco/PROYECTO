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

  // Consulta SQL
  $query = "SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?";
  $statement = $conn->prepare($query);
  $statement->bind_param("ss", $id, $contrasena);
  $statement->execute();
  $result = $statement->get_result();

  // Verificar el resultado
  if ($result->num_rows > 0) {
    // Inicio de sesión exitoso
    // Redirigir a otra página
    header("Location: index.html");
    exit(); // Asegurar que el script se detenga después de la redirección
  } else {
    // Credenciales incorrectas
    echo "Credenciales incorrectas";
  }

  // Cerrar la conexión
  $conn->close();
}
?>