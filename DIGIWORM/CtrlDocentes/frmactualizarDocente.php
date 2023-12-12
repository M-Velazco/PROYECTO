<?php
require_once "../CtrlDocentes/modeloDocentes/conexion.php";
require_once "../CtrlDocentes/modeloDocentes/Docentes.php";
extract($_REQUEST);

$objConexion = Conectarse();

$sql = "SELECT * FROM docente WHERE iddocente = '$_REQUEST[iddocente]'";
$resultadodocente = $objConexion->query($sql);

if ($resultadodocente === false) {
    die("Error en la consulta SQL: " . $objConexion->error);
}

if ($resultadodocente->num_rows > 0) {
    $docente = $resultadodocente->fetch_object();
} else {
    die("Usuario no encontrado");
}
?>

<!DOCTYPE html>
<html lang="az">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="../style.css" />
</head>
<body>
    <form action="../CtrlDocentes/validaractualizarDocente.php" method="post" class="update-form">
        <h2 class="title">Actualizar Datos de Usuario</h2>
        
        <td align="right" bgcolor="85e4cd">identificacion:</td>
        
            <input type="int" id="IDdocente" name="IDdocente" placeholder="Numero Identificacion" value="<?php echo $docente->iddocente ?>" readonly required />
        </div>

        <!-- Otras campos del formulario -->
        <tr>
      <td align="right" bgcolor="#EAEAEA">Nombres y apellidos:</td>
      <td><label for="Nombre_apellidos"></label>
      <input name="fNombre_apellidos" type="text" id="Nombre_apellidos" value="<?php echo $docente->Nombre_apellido?>" size="40" readonly /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EAEAEA">Correo:</td>
      <td><label for="Correo"></label>
      <input name="fCorreo" type="email" id="Correo" value="<?php echo $docente->Correo?>" size="40" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EAEAEA">Contraseña:</td>
      <td><label for="Contraseña"></label>
      <input name="Contraseña" type="password" id="Contraseña" value="<?php echo $docente->Contraseña?>" size="40" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EAEAEA">Curso:</td>
      <td><label for="Curso_pr"></label>
      <input name="fCurso_pr" type="int" id="Curso_pr" value="<?php echo $docente->Curso_pr?>" size="40" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EAEAEA">Materia:</td>
      <td><label for="Materia"></label>
      <input name="fMateria" type="int" id="Materia" value="<?php echo $docente->Materia?>" size="40" /></td>
    </tr>
        
        <input type="submit" class="btn" value="Actualizar Datos" />
    </form>
</body>
</html>
