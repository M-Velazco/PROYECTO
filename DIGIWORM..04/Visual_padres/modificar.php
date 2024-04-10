<?php
// Inicia la sesión
session_start();

// Verifica si la variable de sesión 'Idusuario' está establecida para determinar si el usuario está conectado
if(isset($_SESSION['Idusuario'])) {
    $usuario_conectado = true;

    // Crea una instancia de la clase Usuario y conecta a la base de datos
    require_once "../modelo/USUARIO.php";
    require_once "../modelo/conexion.php";
    $objConexion = Conectarse();
    $objUsuarios = new Usuario($objConexion);

    // Obtiene el nombre del usuario basado en su ID
    $nombre_usuario = $objUsuarios->obtenerNombreUsuario($_SESSION['Idusuario']);
    $Curso_estudiante = $objUsuarios->obtenerNombreCurso($_SESSION['Idusuario']);

    // Obtiene la ruta de la imagen de perfil del usuario
    $ruta_imagen = $objUsuarios->obtenerRutaImagenUsuario($_SESSION['Idusuario']);
    $rol_usuario = $objUsuarios->obtenerRolUsuario($_SESSION['Idusuario']);

} else {
    $usuario_conectado = false;
    header('Location: form.php?error=nologeado');
    exit; // Termina la ejecución del script después de redirigir
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        /* Estilos del formulario */
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-image: url(../img/Fondo_padres.jpg);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="email"],
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff; /*  color de fondo */
        }

        input[readonly] {
            background-color: #fff; /* Color de fondo para campos de solo lectura */
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <?php
    
    $conn = Conectarse();
    $error = '';
    $cambios_realizados = false; // Variable para rastrear si se realizaron cambios

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["idEstudiante"])) {
        $nuevoEmail = $_POST["email"];
        $idEstudiante = $_POST["idEstudiante"];
        $nuevoCurso = $_POST["curso"];
        $nuevoEstado = $_POST["estado"];

        // Verificar si los campos de "Curso" y "Estado" están vacíos
        if (empty($nuevoCurso) || empty($nuevoEstado)) {
            $error = "Curso y Estado son obligatorios.";
        } else {
            // Validar que el campo "Curso" solo contenga tres o cuatro dígitos
            if (!preg_match('/^\d{3,4}$/', $nuevoCurso)) {
                $error = "Debe tener 3 o 4 dígitos.";
            } else {
                // Verificar si se realizaron cambios en el formulario
                $sqlEstudiante = "SELECT * FROM estudiante WHERE idEstudiante = $idEstudiante";
                $resultEstudiante = $conn->query($sqlEstudiante);

                if ($resultEstudiante->num_rows > 0) {
                    $rowEstudiante = $resultEstudiante->fetch_assoc();

                    // Verificar si se realizaron cambios
                    if ($nuevoEmail != $rowEstudiante['Email'] || $nuevoCurso != $rowEstudiante['Curso'] || $nuevoEstado != $rowEstudiante['Estado']) {
                        $cambios_realizados = true;
                    }
                }

                // Actualizar el email, curso y estado del estudiante en la base de datos solo si se realizaron cambios
                if ($cambios_realizados) {
                    $sqlActualizar = "UPDATE estudiante SET Email='$nuevoEmail', Curso='$nuevoCurso', Estado='$nuevoEstado' WHERE idEstudiante=$idEstudiante";

                    if ($conn->query($sqlActualizar) === TRUE) {
                        echo "<script>alert('Información actualizada correctamente'); window.location.href = '/PROYECTO/DIGIWORM..04/Visual_padres/index.php';</script>";
                    } else {
                        echo "<p>Error al actualizar la información: " . $conn->error . "</p>";
                    }
                }
            }
        }
    }

    // Verificar si se ha enviado un ID de estudiante
    if (isset($_GET["id"])) {
        $idEstudiante = $_GET["id"];

        // Obtener la información del estudiante
        $sqlEstudiante = "SELECT * FROM estudiante WHERE idEstudiante = $idEstudiante";
        $resultEstudiante = $conn->query($sqlEstudiante);

        if ($resultEstudiante->num_rows > 0) {
            $rowEstudiante = $resultEstudiante->fetch_assoc();
        } else {
            echo "<p>No se encontró ningún estudiante con el ID proporcionado.</p>";
        }
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="id">ID:</label>
    <input type="text" id="id" name="id" value="<?php echo isset($rowEstudiante['idEstudiante']) ? $rowEstudiante['idEstudiante'] : ''; ?>" readonly>
    <label for="nombres">Nombres:</label>
    <input type="text" id="nombres" name="nombres" value="<?php echo isset($rowEstudiante['Nombres']) ? $rowEstudiante['Nombres'] : ''; ?>" readonly>
    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" value="<?php echo isset($rowEstudiante['Apellidos']) ? $rowEstudiante['Apellidos'] : ''; ?>" readonly>

    <?php if ($rol_usuario == 'administrador'): ?>
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : (isset($rowEstudiante['Email']) ? $rowEstudiante['Email'] : ''); ?>" required>
    <?php else: ?>
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($rowEstudiante['Email']) ? $rowEstudiante['Email'] : ''; ?>" readonly>
    <?php endif; ?>

    <?php if ($rol_usuario == 'administrador' || $rol_usuario == 'Coordinador' || $rol_usuario == 'Docente'): ?>
        <select name="curso" id="curso" required>

  <?php
      // Conexión a la base de datos
      $conn = Conectarse();
      // Crear conexión


      // Verificar conexión
      if ($conn->connect_error) {
          die("Conexión fallida: " . $conn->connect_error);
      }

      // Consulta para obtener los ID de los docentes y sus nombres y apellidos asociados
      $sql = "SELECT * FROM curso";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Generar opciones del select con los ID de los docentes y sus nombres y apellidos
          while ($row = $result->fetch_assoc()) {
              echo "<option value='" . $row['idCurso'] . "'>" . $row['Nombre_curso'] . "-" . $row ['Jornada'] .  "</option>";
          }
      }

      // Cerrar conexión
      $conn->close();
    ?>
  </select>
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="Activo" <?php echo (isset($rowEstudiante['Estado']) && $rowEstudiante['Estado'] == 'Activo') ? 'selected' : ''; ?>>Activo</option>
            <option value="Inactivo" <?php echo (isset($rowEstudiante['Estado']) && $rowEstudiante['Estado'] == 'Inactivo') ? 'selected' : ''; ?>>Inactivo</option>
        </select>
    <?php endif; ?>

    <input type="hidden" name="idEstudiante" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
    <input type="submit" value="Guardar Cambios">
    <?php if(isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
</form>

</body>

</html>
