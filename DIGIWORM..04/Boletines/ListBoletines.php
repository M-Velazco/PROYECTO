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

    <title>listado de Boletines</title>
</head>

<body>

    <table class="table table-striped table-hover">
        <thead>
            Boletines

        </thead>

        <tr>
            <?php while ($row_boletines = $result_boletines->fetch_assoc()) {
            echo '<tr></tr>';
                echo '<th scope=boletin>' . $row_boletines['idBoletin'] . '</th>';
                echo ' <td colspan="2" class="table-active">' . $row_boletines['idEstudiante'] . '</td>';
                echo ' <td>' . $row_boletines['direccionArchivo'] . '</td>';
                echo ' <td>' . $row_boletines['fechaCreacion'] . '</td>';
                echo ' <td><a href="Boletines/Validacion/download.php?idBoletin='.$row_boletines['idBoletin'] .'" class="btn btn-primary px-4 mx-auto my-2">Descargar</a></td>';
                echo '</tr>';
            } ?>
        </tr>
    </table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


</body>

</html>