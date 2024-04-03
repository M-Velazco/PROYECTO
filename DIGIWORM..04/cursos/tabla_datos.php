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
            <img src="../img/LOGO.png" alt="Logo">
            <h3><a href="../cursos.php" onclick="history.go(-1);" class="principal-link">Principal</a> <h3>
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
                <th>Activo</th>
                <th>Curso</th>
            </tr>
        </thead>
        <tbody>
            <?php  while ($row = $result->fetch_assoc()) {
            echo'<tr>';
                echo'<td>3219703694</td>';
                echo'<td>Raul</td>';
                echo'<td>Muñoz</td>';
                echo'<td>Muñozraul@gmail.com</td>';
                echo'<td>Activo</td>';
                echo'<td>Activo</td>';
            echo'</tr>';
             }  ?>

        </tbody>
    </table>

</body>
</html>
