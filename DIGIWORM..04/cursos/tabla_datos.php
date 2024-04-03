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
            <tr>
                <th>Id Estudiante</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Curso</th>
                <th>Activo</th>
            </tr>
        </thead>
        <tbody>
            <?php  while ($row = $result->fetch_assoc()) {
            echo'<tr>';
                echo'<td>'.$row['idEstudiante'].'</td>';
                echo'<td>'.$row['Nombres'].'</td>';
                echo'<td>'.$row['Apellidos'].'</td>';
                echo'<td>'.$row['Email'].'</td>';
                echo'<td>'.$row['Curso'].'</td>';
                echo'<td>'.$row['Estado'].'</td>';
            echo'</tr>';
             }  ?>

        </tbody>
    </table>

</body>
</html>
