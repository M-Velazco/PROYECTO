<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  require("conexion.php");
  $con = retornarConexion();

  // Ejecutar la consulta SQL
  $consulta = "SELECT idpadre_de_familia, est_rep, estado_matr FROM padre_de_familia";
  $resultado = mysqli_query($con, $consulta);

  // Verificar si la consulta fue exitosa
  if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($con));
  }

  // Obtener los resultados en un array asociativo
  $vec = [];
  while ($reg = mysqli_fetch_assoc($resultado)) {
    $vec[] = $reg;
  }

  // Liberar el conjunto de resultados
  mysqli_free_result($resultado);

  // Cerrar la conexión
  mysqli_close($con);

  // Convertir el array a formato JSON
  $cad = json_encode($vec);

  // Establecer el encabezado Content-Type
  header('Content-Type: application/json');

  // Imprimir el JSON
  echo $cad;
?>
