<?php

function retornarConexion() { 
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "digiworm";     
    $con = mysqli_connect($host, $user, $password, $database);

    if (!$con) {
        echo "No se realizó la conexión a la base de datos, el error fue: " . mysqli_connect_error();
        // Puedes manejar el error de alguna manera adecuada, por ejemplo, lanzando una excepción
        // throw new Exception("No se pudo conectar a la base de datos");
        return null; // Devolvemos null para indicar que no se pudo establecer la conexión
    }

    return $con;
}

?>
