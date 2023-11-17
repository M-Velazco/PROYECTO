<?php
require("modeloDocentes/Docentes.php");
require("modeloDocentes/conexion.php");

// Validar la identificación del docente (puedes agregar una validación más completa según tus necesidades)
if (isset($_POST["IDdocente"])) {
    $identificacion = $_POST["IDdocente"];

    // Crear una instancia de la conexión a la base de datos
    $objConexion = Conectarse();

    // Validar la conexión a la base de datos
    if ($objConexion) {
        // Crear una instancia de la clase Docentes
        $objDocente = new Docentes($objConexion);

        // Ejecutar la consulta para obtener los docentes por identificación
        $resultado = $objDocente->consultarDocentes_id($identificacion);
    } else {
        // Manejo de error si la conexión a la base de datos falla
        echo "Error de conexión a la base de datos.";
        exit;
    }
} else {
    // Manejo de error si no se proporciona la identificación del docente
    echo "Identificación de docente no proporcionada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listar Docentes</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #ef7aec;
        }
        tr:nth-child(even) {
            background-color: #8eefce;
        }
    </style>
</head>
<body>
    <h1 align="center">Listar Docentes</h1>
    <table>
        <tr>
            <th>Identificacion Docente</th>
            <th>Nombre Docente</th>
            <th>Correo</th>
            <th>Contraseña</th>
            <th>Curso_pr</th>
            <th>Materia</th>
            
    <td width="7%">Editar</td>
     
     <td width="10%">agregar</td> 
     <td width="10%">Eliminar</td> 
        </tr>

        <?php
        while ($docente = $resultado->fetch_object()) {
            
        ?>
        <tr>
        
        <td><?php echo $docente->iddocente ?> </td>
            <td><?php echo $docente->Nombre_apellido?></td>
            
            
            <td><?php echo $docente->Correo ?></td>
            <td><?php echo $docente->Contraseña ?></td>
            <td><?php echo $docente->Curso_pr ?></td>
            <td><?php echo $docente->Materia ?></td>

              
        <td align="center"><a href="frmactualizarDocente.php?IDdocente=<?php echo $docente->iddocente?>"><img src="img/Editar.jpg"  width="29" height="24" /></a></td>
        <td align="center"><a href="frmagregarDocente.php?IDdocente=<?php echo $docente  ->iddocente?>"><img src="img/Eliminar.jpg" width="29" height="24" /></a></td>
        <td align="center"><a href="eliminarDocente.php?IDdocente=<?php echo $docente->iddocente?>"><img src="img/Eliminar.jpg" width="29" height="24" /></a></td>
  
        </tr>
        <?php
        }
       
        ?>
    </table>
</body>
</html>
