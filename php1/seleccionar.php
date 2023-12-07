<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  require("conexion.php");
  $con = retornarConexion();

  // Validar que el parámetro idpadre_de_familia está presente y es un número
  $idpadre_de_familia = isset($_GET['idpadre_de_familia']) ? intval($_GET['idpadre_de_familia']) : 0;

  if ($idpadre_de_familia === 0) {
    die("Error: El parámetro idpadre_de_familia no es válido.");
  }

  $registros = mysqli_query($con, "SELECT idpadre_de_familia, est_rep, estado_matr FROM padre_de_familia WHERE idpadre_de_familia = $idpadre_de_familia");
  $vec = [];

  if ($reg = mysqli_fetch_assoc($registros)) {
    $vec[] = $reg;
  }
  
  // Convertir el array a formato JSON
  $cad = json_encode($vec);

  // Establecer el encabezado Content-Type
  header('Content-Type: application/json');

  // Imprimir el JSON
  echo $cad;

  // Cerrar la conexión
  mysqli_close($con);
?>
