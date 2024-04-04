<?php
require_once "modelo/conexion.php";

// Conexión a la base de datos
$conn = Conectarse();

// Verificar si el ID de usuario está definido en la sesión
if(isset($_SESSION["Idusuario"])) {
    // Consulta para obtener los boletines, filtrando por el ID de usuario si está definido
    if($rol_usuario == 'Estudiante') {
        $sql_boletines = "SELECT * FROM boletines WHERE idEstudiante = '$_SESSION[Idusuario]'";
    } elseif($rol_usuario == 'administrador' || $rol_usuario == 'Coordinador' || $rol_usuario == 'Docente') {
        $sql_boletines = "SELECT * FROM boletines";
    }
    $result_boletines = $conn->query($sql_boletines);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Boletines</title>
</head>

<body>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID Boletín</th>
                <th scope="col">ID Estudiante</th>
                <th scope="col">Dirección de Archivo</th>
                <th scope="col">Fecha de Creación</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody id="resultadoBusqueda" >
            <?php
            // Verificar si se encontraron boletines
            if(isset($result_boletines) && $result_boletines->num_rows > 0) {
                // Iterar sobre los resultados y mostrar los boletines
                while ($row_boletines = $result_boletines->fetch_assoc()) {
                    echo '<tr>';
                    echo '<th scope="row">' . $row_boletines['idBoletin'] . '</th>';
                    echo '<td>' . $row_boletines['idEstudiante'] . '</td>';
                    echo '<td>' . $row_boletines['direccionArchivo'] . '</td>';
                    echo '<td>' . $row_boletines['fechaCreacion'] . '</td>';
                    echo '<td><a href="Boletines/Validacion/download.php?idBoletin=' . $row_boletines['idBoletin'] . '" class="btn btn-primary px-4 mx-auto my-2">Descargar</a></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5">No se encontraron boletines.</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
       
</body>

</html>
