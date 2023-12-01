<?php
require_once "modelo/Usuario.php";
require_once "modelo/conexion.php";
extract($_REQUEST);

$objConexion = Conectarse();

$sql = "SELECT * FROM usuarios WHERE idusuarios = '$_REQUEST[Idusuarios]'";
$resultadousuarios = $objConexion->query($sql);

if ($resultadousuarios === false) {
    die("Error en la consulta SQL: " . $objConexion->error);
}

if ($resultadousuarios->num_rows > 0) {
    $usuario = $resultadousuarios->fetch_object();
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
    <link rel="stylesheet" href="style.css" /> <!-- ... -->
</head>
<body>
    <form action="validacion/validarActualizacionUsuario.php" method="post" class="update-form">
        <h2 class="title">Actualizar Datos de Usuario</h2>
        <div class="input-field">
            <i class="fa-solid fa-id-card"></i>
            <input type="int" id="Idusuario" name="Idusuario" placeholder="Numero Identificacion" value="<?php echo $usuario->Idusuarios ?>" readonly required />
        </div>
        <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" name="Nombre" id="Nombre" placeholder="Nombre" value="<?php echo $usuario->Nombre_apellido ?> " required />
    </div>
    <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" id="Correo" name="Correo"placeholder="Correo electronico" value="<?php echo $usuario->Correo ?> " required />
            </div>
        <div class="input-field">
        <i class="fas fa-phone"></i>
        <input type="tel" name="Telefono" id="Telefono" placeholder="Telefono" value="<?php echo $usuario->Telefono ?> "required />
    </div>

    <div class="input-field">
        <i class="fas fa-lock"></i>
        <input type="password" id="NuevaContrasena" name="NuevaContrasena" placeholder="Nueva Contraseña"  required/>
    </div>

    <div class="input-field">
              <i class="fa-solid fa-masks-theater"></i>
              <label for="Rol" id="roles">Rol</label></div>
              <div class="input-radio">
    <label for="Docente">Docente</label>
    <input type="radio" id="Docente" name="Rol" value="Docente" <?php echo ($usuario->Rol == "Docente") ? 'checked' : ''; ?>>

    <label for="Estudiante">Estudiante</label>
    <input type="radio" id="Estudiante" name="Rol" value="Estudiante" <?php echo ($usuario->Rol == "Estudiante") ? 'checked' : ''; ?>>

    <label for="PadreDeFamilia">Padre de Familia</label>
    <input type="radio" id="PadreDeFamilia" name="Rol" value="Padre de Familia" <?php echo ($usuario->Rol == "Padre de Familia") ? 'checked' : ''; ?>>

    <label for="Coordinador">Coordinador</label>
    <input type="radio" id="Coordinador" name="Rol" value="Coordinador" <?php echo ($usuario->Rol == "Coordinador") ? 'checked' : ''; ?>>
</div>

        <!-- Otras campos del formulario -->
        
        <input type="submit" class="btn" value="Actualizar Datos" />
    </form>
</body>
</html>
