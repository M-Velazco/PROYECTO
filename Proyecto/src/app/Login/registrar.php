
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST["nombre"];
  $correo = $_POST["correo"];
  $tel = $_POST["tel"];
  $contrasena = $_POST["contrasena"];

  // Configuración de la conexión a la base de datos
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "digiworm";

  // Crear una conexión
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Comprobar la conexión
  if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
  }
echo "la conexion sirve";
  // Insertar los datos en la base de datos
  $sql = "INSERT INTO `usuarios` (`nombre`, `correo`, `tel`, `contrasena`) VALUES ('$nombre', '$correo', '$tel', '$contrasena')";

  if ($conn->query($sql) === true) {
    echo "<h2>Registro exitoso</h2>";
    echo "<p>Nombre: " . $nombre . "</p>";
    echo "<p>correo: " . $correo . "</p>";
    echo "<p>tel: " . $tel . "</p>";
    header("Location: login.html");
    exit(); // Asegurar que el script se detenga después de la redirección
  } else {
    echo "Error en el registro: " . $conn->error;
  }

  // Cerrar la conexión
  $conn->close();
}
?>
