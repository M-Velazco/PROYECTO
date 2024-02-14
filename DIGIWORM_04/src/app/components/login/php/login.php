<?php
 header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require("conexion.php");
$con = retornarConexion();

// Verificar la existencia de los parámetros
if (isset($_GET['Idusuarios']) && isset($_GET['Contrasena'])) {
    // Sanitizar la entrada del usuario
    $idusuarios = (int)$_GET['Idusuarios'];
    $contrasena = mysqli_real_escape_string($con, $_GET['Contrasena']);

    // Construir la consulta
    $query = "SELECT Idusuarios, Contraseña FROM usuarios WHERE Idusuarios=$idusuarios AND Contraseña='$contrasena'";

    // Ejecutar la consulta
    $registros = mysqli_query($con, $query);

    // Verificar si se encontraron resultados
    if ($registros) {
        $reg = mysqli_fetch_array($registros, MYSQLI_ASSOC);
        if ($reg) {
            $vec[] = $reg;
            $cad = json_encode($vec);
            echo $cad;
        } else {
            $response = array("success" => false, "message" => "Credenciales incorrectas");
            echo json_encode($response);
        }
    } else {
        $response = array("success" => false, "message" => "Error en la consulta: " . mysqli_error($con));
        echo json_encode($response);
    }

    // Cerrar la conexión
    mysqli_free_result($registros);
} else {
    $response = array("success" => false, "message" => "Parámetros incompletos");
    echo json_encode($response);
}

// Establecer encabezados antes de enviar la respuesta
header('Content-Type: application/json');

?>
