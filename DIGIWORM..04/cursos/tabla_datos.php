<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digiworm - Cursos</title>
    <link rel="stylesheet" href="cursos/style.css">
</head>


    <header>
        <div class="logo">
        </div>
      <br>  <p> <h2>Lista de estudiantes<h2></p>
      <style>
        p, h2 {
            text-align: center;
        }
    </style>
    </header>

<body>
<table class="styled-table">
    <thead>
    <?php
        if ($rowC = $resultC->fetch_assoc()){
            echo '<tr>';
            echo '<td><h3>Curso:</h3> <br> '.$rowC['Nombre_curso'].'</td>';
            echo '<td><h3>Jornada:</h3> <br> '.$rowC['Jornada'].'</td>';
            echo '<td> <h3>Estado:</h3> <br> <select class="btn btn-outline-light bg-white text-body px-4 dropdown-toggle btn-lg" onchange="updateStateCurso(this.value, '.$rowC['idCurso'].')">';
            echo '<option value="Activo"'.($rowC['Estado'] == 'Activo' ? ' selected' : '').'>Activo</option>';
            echo '<option value="Inactivo"'.($rowC['Estado'] == 'Inactivo' ? ' selected' : '').'>Inactivo</option>';
            echo '</select></td>';
            echo '</tr>';
        }
        ?>
        <tr>
            <th>Id Estudiante</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>'.$row['idEstudiante'].'</td>';
            echo '<td>'.$row['Nombres'].'</td>';
            echo '<td>'.$row['Apellidos'].'</td>';
            echo '<td>'.$row['Email'].'</td>';
            echo '<td>';
            echo '<select class="btn btn-outline-light bg-white text-body px-4 dropdown-toggle btn-lg" onchange="updateState(this.value, '.$row['idEstudiante'].')">';
            echo '<option value="Activo"'.($row['Estado'] == 'Activo' ? ' selected' : '').'>Activo</option>';
            echo '<option value="Inactivo"'.($row['Estado'] == 'Inactivo' ? ' selected' : '').'>Inactivo</option>';
            echo '</select>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

<script>
function updateState(newState, studentId) {
    // Envía una solicitud AJAX al servidor para actualizar el estado
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "cursos/actualizar_estado.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Se ha completado la solicitud
            console.log("Estado actualizado correctamente");
        }
    };
    xhr.send("newState=" + newState + "&studentId=" + studentId);
}
</script>
<script>
function updateStateCurso(newState, cursoID) {
    // Envía una solicitud AJAX al servidor para actualizar el estado
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "cursos/actualizar_estadoCurso.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Se ha completado la solicitud
            console.log("Estado actualizado correctamente");
        }
    };
    xhr.send("newState=" + newState + "&cursoID=" + cursoID);
}
</script>


</body>
</html>
