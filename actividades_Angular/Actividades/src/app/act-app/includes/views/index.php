<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  require("../db.php");
  $con=retornarConexion();

  $registros=mysqli_query($con,"SELECT `idactividades`, `Nom_act`, `Materia_act`, `Docente`, `Archivo` FROM `actividades` ");
  $vec=[];  
  while ($reg=mysqli_fetch_array($registros))  
  {
    $vec[]=$reg;
  }
  
  $cad=json_encode($vec);
  echo $cad;
  header('Content-Type: application/json');
?>