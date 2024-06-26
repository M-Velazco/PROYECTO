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
    $Curso_estudiante =$objUsuarios->obtenerNombreCurso( $_SESSION['Idusuario'] );

    // Obtiene la ruta de la imagen de perfil del usuario
    $ruta_imagen = $objUsuarios->obtenerRutaImagenUsuario($_SESSION['Idusuario']);
    $rol_usuario = $objUsuarios->obtenerRolUsuario($_SESSION['Idusuario']);



} else {
    $usuario_conectado = false;
    header( 'Location: form.php?error=nologeado' );
}
if ($rol_usuario !== 'administrador') {
    header("Location: ../index04.php");
    exit(); // Detiene la ejecución del script después de la redirección
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuarios</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../img/LOGO.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="../lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid bg-light position-relative shadow">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5">
            <a href="" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px;">

            <span class="text-primary">DIGIWORM</span>

            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
    <div class="navbar-nav font-weight-bold mx-auto py-0">
    <?php
if ($rol_usuario == 'Coordinador'):
    echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
    <a href="Actividades.php" class="nav-item nav-link">Actividades</a>
        <a href="chat/login.php" class="nav-item nav-link">Chat</a>
        <a href="Foros.php" class="nav-item nav-link">Foros</a>
        <a href="Docentes.php" class="nav-item nav-link">Docentes</a>


        <div class="nav-item dropdown">
        <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
        <div class="dropdown-menu rounded-0 m-0">
             <a href="publicaciones/publicaciones.php" class="dropdown-item">Publicaciones</a>
            <a href="cursos.php" class="dropdown-item">Cursos</a>
            <a href="visual_padres/index.php" class="dropdown-item">Estudiantes</a>
        </div>
    </div>';
    elseif($rol_usuario=='Estudiante') :
        if ($Curso_estudiante && intval($Curso_estudiante) < 601) {
            echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
            <a href="Actividades.php" class="nav-item nav-link">Actividades</a>
                  <a href="Foros.php" class="nav-item nav-link">Foros</a>
                  <div class="nav-item dropdown">
                      <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                      <div class="dropdown-menu rounded-0 m-0">
                           <a href="publicaciones/publicaciones.php" class="dropdown-item">Publicaciones</a>
                          <a href="Actividades.php" class="dropdown-item">Actividades</a>
                          <a href="boletines.php" class="dropdown-item">Boletines</a>
                      </div>
                  </div>';
        } else {
            echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
            <a href="Actividades.php" class="nav-item nav-link">Actividades</a>
                  <a href="chat/login.php" class="nav-item nav-link">Chat</a>
                  <a href="Foros.php" class="nav-item nav-link">Foros</a>
                  <div class="nav-item dropdown">
                      <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                      <div class="dropdown-menu rounded-0 m-0">
                           <a href="publicaciones/publicaciones.php" class="dropdown-item">Publicaciones</a>
                          <a href="Actividades.php" class="dropdown-item">Actividades</a>
                      </div>
                  </div>';
        }
        elseif($rol_usuario=='administrador') :
            echo '<a href="../index04.php" class="nav-item nav-link active">Home</a>
            <a href="../Actividades.php" class="nav-item nav-link">Actividades</a>
            <a href="../chat/login.php" class="nav-item nav-link">Chat</a>
            <a href="../Foros.php" class="nav-item nav-link">Foros</a>
            <a href="../Docentes.php" class="nav-item nav-link">Docentes</a>


            <div class="nav-item dropdown">
                <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                <div class="dropdown-menu rounded-0 m-0">

                    <a href="../publicaciones/publicaciones.php" class="dropdown-item">Publicaciones</a>
                    <a href="../Visual_padres" class="dropdown-item">Estudiantes</a>
                    <a href="../boletines.php" class="dropdown-item">Boletines</a>
                    <a href="../cursos.php" class="dropdown-item">Cursos</a>

                    <a href="../Apis/Swagger/swaggerC.php" class="dropdown-item">CursosApi</a>
                    <a href="../Apis/Swagger/swaggerd.php" class="dropdown-item">DocentesApi </a>



                </div>';
                elseif($rol_usuario=='Padre_familia') :
                    echo '
                    <a href="index04.php" class="nav-item nav-link active">Home</a>


                    <div class="nav-item dropdown">
                <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="Visual_padres" class="dropdown-item">Estudiantes</a>
                </div>';
                elseif($rol_usuario=='Docente') :
                    echo '
                    <a href="index04.php" class="nav-item nav-link active">Home</a>
                    <a href="Actividades.php" class="nav-item nav-link">Actividades</a>
                    <a href="Foros.php" class="nav-item nav-link">Foros</a>
                    <a href="Docentes.php" class="nav-item nav-link">Docentes</a>

                    <div class="nav-item dropdown">
                    <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="publicaciones/publicaciones.php" class="dropdown-item">Publicaciones</a>
                        <a href="Visual_padres" class="dropdown-item">Estudiantes</a>
                        <a href="boletines.php" class="dropdown-item">Boletines</a>
                        <a href="cursos.php" class="dropdown-item">Cursos</a>

                    </div>';

        else: echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
        <a href="Actividades.php" class="nav-item nav-link">Actividades</a>
            <a href="chat/login.php" class="nav-item nav-link">Chat</a>
            <a href="Foros.php" class="nav-item nav-link">Foros</a>
            <a href="Docentes.php" class="nav-item nav-link">Docentes</a>
            <div class="nav-item dropdown">
                <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                <div class="dropdown-menu rounded-0 m-0">
                     <a href="publicaciones/publicaciones.php" class="dropdown-item">Publicaciones</a>
                    <a href="Visual_padres" class="dropdown-item">Datos Estudiantes</a>
                    <a href="Boletines/FormB.php" class="dropdown-item">Boletines</a>
                </div>';

endif;
?>


            </div>

    </div>
    <div class="navbar-nav font-weight-bold mx-auto py-0">
        <div class="DatosU">
            <p class="nav-item nav-link">
            <?php if ($ruta_imagen): ?>
                    <img src="../<?php echo $ruta_imagen; ?>" style="width: 40px; height: 40px; border-radius: 50%;">
                <?php else: ?>
                    <span>No hay </span>
                <?php endif; ?>
                <a href="Datos.php">
                <?php echo $nombre_usuario."-". $rol_usuario." "; ?>.</a>


                <br>

                <a href="modelo/CerrarSession.php" style="">Cerrar sesion</a>
            </p>

        </div>
    </div>
</div>

        </nav>
    </div>
    <!-- Navbar End -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="container mt-5">
    <h2>Usuarios</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Rol</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once "../modelo/conexion.php";
            $conn = Conectarse();

            $sql = "SELECT Idusuarios, Nombres, Apellidos, Rol, Estado FROM usuarios WHERE Rol != 'administrador';
            ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['Idusuarios']."</td>";
                    echo "<td>".$row['Nombres']."</td>";
                    echo "<td>".$row['Apellidos']."</td>";
                    echo "<td><select class='form-select' name='rol' id='rol_".$row['Idusuarios']."'>";
                    $roles = array("Docente", "Usuario", "Estudiante", "Coordinador", "Padre de familia");
                    foreach ($roles as $rol) {
                        $selected = ($rol === $row['Rol']) ? 'selected' : ''; // Seleccionar la opción actual
                        echo "<option $selected>$rol</option>";
                    }
                    echo "</select></td>";

                    echo "<td><select class='form-select' name='estado' id='estado_".$row['Idusuarios']."'><option selected>".$row['Estado']."</option><option>Inactivo</option><option>Activo</option></select></td>";
                    echo "<td><button class='btn btn-primary' onclick='guardarCambios(".$row['Idusuarios'].")'>Guardar</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay resultados</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function guardarCambios(id) {
    var nuevoRol = $("#rol_" + id).val();
    var nuevoEstado = $("#estado_" + id).val();

    // Petición AJAX para enviar los datos al script PHP
    $.ajax({
        type: "POST",
        url: "modelo/actualizar_usuario.php",
        data: {
            id: id,
            rol: nuevoRol,
            estado: nuevoEstado
        },
        success: function(response) {
            alert(response); // Muestra la respuesta del servidor
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Muestra cualquier error en la consola del navegador
        }
    });
}
</script>
</body>
</html>
