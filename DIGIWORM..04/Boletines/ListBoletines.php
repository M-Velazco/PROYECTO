<?php 

require_once "modelo/conexion.php";

                // Conexión a la base de datos
                $conn = Conectarse();
                // Consulta para obtener los cursos disponibles
                $sql_boletines = "SELECT * FROM boletines";
                $result_boletines = $conn->query($sql_boletines);
                // Generar opciones del select con los cursos
                
                ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>listado de Boletines</title>
</head>
<body>

<table class="table table-striped table-hover">
<thead>
    Boletines
  </thead>
  <tr>
  <?php while($row_boletines = $result_boletines->fetch_assoc()){  
    
      echo'<th scope='.$row_boletines['idBoletin'].'>'.$row_boletines['idBoletin'].'</th>';
      echo' <td colspan="2" class="table-active">'.$row_boletines['idEstudiante'].'</td>';
      echo' <td>@twitter</td>';
      echo' <td>@twitter</td>';
      echo' <td>@twitter</td>';
    
     } ?>
     </tr>
</table>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>
</html>