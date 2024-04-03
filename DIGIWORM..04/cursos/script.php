<?php
// Verifica si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos seleccionados del formulario
    $jornada = $_POST["jornada"];
    $grado = $_POST["grado"];

    // Aquí debes realizar la conexión a tu base de datos y ejecutar la consulta SQL para obtener los resultados que deseas mostrar en el include
    // Por ejemplo:
    $conn = Conectarse();
     $sql = "SELECT * FROM estudiante WHERE Jornada = '$jornada' AND Curso = '$grado'";
     $result = $conn->query($sql);

    // Una vez que tengas los resultados de la consulta, puedes mostrarlos en el include
    // Por ejemplo:
    include "tabla_datos.php";
}
?>
