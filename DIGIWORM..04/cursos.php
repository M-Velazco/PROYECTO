<?php
// Inicia la sesión
session_start();

// Verifica si la variable de sesión 'Idusuario' está establecida para determinar si el usuario está conectado
if(isset($_SESSION['Idusuario'])) {
    $usuario_conectado = true;

    // Crea una instancia de la clase Usuario y conecta a la base de datos
    require_once "modelo/USUARIO.php";
    require_once "modelo/conexion.php";
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DIGIWORM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/LOGO.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
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


        </div>
    </div>';
    elseif($rol_usuario=='Estudiante') :
        if ($Curso_estudiante && intval($Curso_estudiante) < 601) {
            echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
                  <a href="Foros.php" class="nav-item nav-link">Foros</a>
                  <a href="Actividades.php" class="nav-item nav-link">Actividades</a>
                  <div class="nav-item dropdown">
                      <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                      <div class="dropdown-menu rounded-0 m-0">
                           <a href="publicaciones/publicaciones.php" class="dropdown-item">Publicaciones</a>
                           <a href="boletines.php" class="dropdown-item">Boletines</a>

                      </div>
                  </div>';
        } else {
            echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
                  <a href="chat/login.php" class="nav-item nav-link">Chat</a>
                  <a href="Foros.php" class="nav-item nav-link">Foros</a>
                  <a href="Actividades.php" class="nav-item nav-link">Actividades</a>
                  <div class="nav-item dropdown">
                      <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                      <div class="dropdown-menu rounded-0 m-0">
                           <a href="publicaciones/publicaciones.php" class="dropdown-item">Publicaciones</a>

                      </div>
                  </div>';
        }
        elseif($rol_usuario=='administrador') :
            echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
            <a href="Actividades.php" class="nav-item nav-link">Actividades</a>
            <a href="chat/login.php" class="nav-item nav-link">Chat</a>
            <a href="Foros.php" class="nav-item nav-link">Foros</a>
            <a href="Docentes.php" class="nav-item nav-link">Docentes</a>

            <div class="nav-item dropdown">
                <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                <div class="dropdown-menu rounded-0 m-0">

                    <a href="publicaciones/publicaciones.php" class="dropdown-item">Publicaciones</a>
                    <a href="Visual_padres" class="dropdown-item">Estudiantes</a>
                    <a href="boletines.php" class="dropdown-item">Boletines</a>


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
                    <a href="Foros.php" class="nav-item nav-link">Foros</a>
                    <a href="Actividades.php" class="nav-item nav-link">Actividades</a>

                    <div class="nav-item dropdown">
                    <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                    <div class="dropdown-menu rounded-0 m-0">

                        <a href="publicaciones/publicaciones.php" class="dropdown-item">Publicaciones</a>
                        <a href="Visual_padres" class="dropdown-item">Estudiantes</a>
                        <a href="boletines.php" class="dropdown-item">Boletines</a>


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
                    <img src="<?php echo $ruta_imagen; ?>" style="width: 40px; height: 40px; border-radius: 50%;">
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


    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
            <h3 class="display-3 font-weight-bold text-white">Cursos</h3>
            <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="index04.php">Home</a></p>
                <p class="m-0 px-2">/</p>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Gallery Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="container">
            <div class="text-center pb-2">
        <p> <h2>Consulte aqui los Cursos  de la institucion<h2></p>
    </div>
<head>


    <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
        <div class="input-group">
            <div class="input-group-prepend">
                <!-- Botón desplegable para Jornada -->
                <form  method="post">
                <div class="dropdown">


                </div>
            </div>
            <div class="input-group-prepend">
                <!-- Botón desplegable para Grado -->
                <div class="dropdown">
                <div class="dropdown">
            <select class="btn btn-outline-light bg-white text-body px-4 dropdown-toggle btn-lg"name="grado" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 1.8rem;">Grado
            <option value="">Grado-Jornada</option>
            <?php
            $conn = Conectarse();
            $sql ="SELECT * FROM curso ";
            $result = $conn->query($sql);
            while($row=$result->fetch_assoc()){
                echo'<option class="dropdown-item" value="'.$row['idCurso'].'" >'.$row['Nombre_curso']." - ".$row['Jornada'].'</option>';
                } ?>


            </select>
</div>

</div>

<button type="submit" class="button-64">Enviar</button>

<style>
   .button-64 {
  align-items: center;
  background-image: linear-gradient(144deg,#046d2a, #072bad 50%,#5fff6c);
  border: 0;
  border-radius: 8px;
  box-shadow: rgba(151, 65, 252, 0.2) 0 15px 30px -5px;
  box-sizing: border-box;
  color: #FFFFFF;
  display: flex;
  font-family: Phantomsans, sans-serif;
  font-size: 20px;
  justify-content: center;
  line-height: 1em;
  max-width: 100%;
  min-width: 140px;
  padding: 3px;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  white-space: nowrap;
  cursor: pointer;
}

.button-64:active,
.button-64:hover {
  outline: 0;
}

.button-64 span {
  background-color: rgb(5, 6, 45);
  padding: 16px 24px;
  border-radius: 6px;
  width: 100%;
  height: 100%;
  transition: 300ms;
}

.button-64:hover span {
  background: none;
}

@media (min-width: 768px) {
  .button-64 {
    font-size: 24px;
    min-width: 196px;
  }
}
</style>



                </div>
            </div>
        </div>
        </form>
    </div>
<div class="Result">
<?php
// Verifica si se han enviado los datos del formulario
require_once "modelo/conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos seleccionados del formulario

    $grado = $_POST["grado"];

    // Aquí debes realizar la conexión a tu base de datos y ejecutar la consulta SQL para obtener los resultados que deseas mostrar en el include
    // Por ejemplo:
    $conn = Conectarse();
     $sql = "SELECT * FROM estudiante WHERE  Curso = '$grado'";
     $result = $conn->query($sql);

    $sqlC = "SELECT * FROM curso WHERE idCurso  = '$grado'";
    $resultC = $conn->query($sqlC);
    // Una vez que tengas los resultados de la consulta, puedes mostrarlos en el include
    // Por ejemplo:
    include "cursos/tabla_datos.php";
}
?>

</div>
</html>

                </div>
            </div>
        </div>
    </div>
    <!-- Gallery End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="" class="navbar-brand font-weight-bold text-primary m-0 mb-4 p-0" style="font-size: 40px; line-height: 40px;">

                    <span class="text-white">DIGIWORM</span>
                </a>
                <p>"Confía en tu capacidad para superar los desafíos y alcanzar tus metas. Eres más fuerte y más capaz de lo que imaginas.".</p>
                <div class="d-flex justify-content-start mt-4">
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        ></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="https://www.facebook.com/profile.php?id=61557564631844&mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        ></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="https://www.instagram.com/digiworm.s.a?igsh=am5ubXdjZDVrczg="><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-primary mb-4">Ponerse en contacto</h3>
                <div class="d-flex">
                    <a href="https://www.google.com/maps/place/Colegio+Paulo+VI+I+E+D/@4.6208787,-74.1605965,17z/data=!4m14!1m7!3m6!1s0x8e3f9e9ad96db87d:0x10e63ee13ae63517!2sColegio+Paulo+VI+I+E+D!8m2!3d4.6208787!4d-74.1580162!16s%2Fg%2F11r8mt7kb!3m5!1s0x8e3f9e9ad96db87d:0x10e63ee13ae63517!8m2!3d4.6208787!4d-74.1580162!16s%2Fg%2F11r8mt7kb?hl=es&entry=ttu">
                        <h4 class="fa fa-map-marker-alt text-primary"></h4>
                    </a>
                    <div class="pl-3">
                        <h5 class="text-white">Bogotá</h5>
                        <p>Colombia</p>
                    </div>
                </div>
                <div class="d-flex">
                    <a href="mailto:digiworm0@gmail.com">
                        <h4 class="fa fa-envelope text-primary"></h4>
                    </a>
                    <div class="pl-3">
                        <h5 class="text-white">Email</h5>
                        <p>digiworm0@gmail.com</p>
                    </div>
                </div>
                <div class="d-flex">
                    <a href="https://wa.me/573143996415">
                        <h4 class="fa fa-phone-alt text-primary"></h4>
                    </a>
                    <div class="pl-3">
                        <h5 class="text-white">Celular</h5>
                        <p>3143996415</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-primary mb-4">Regresar</h3>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                    <a class="text-white mb-2" href="Principal.html"><i class="fa fa-angle-right mr-2"></i>Principal</a>
                    <a class="text-white mb-2" href="Publicaciones.html"><i class="fa fa-angle-right mr-2"></i>Publicaciones</a>
                    <a class="text-white mb-2" href="Docentes.html"><i class="fa fa-angle-right mr-2"></i>Docentes</a>
                    <a class="text-white mb-2" href="Foros.html"><i class="fa fa-angle-right mr-2"></i>Foros</a>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-primary mb-4">BLOG RECIENTE</h3>
                <form action="">

                    <div>
                        <button class="btn btn-primary btn-block border-0 py-3" type="submit">Muchos niños tienen problemas en la escuela, porque la manera en la que enseñan es incompatible con la manera en la que aprenden.</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="container-fluid pt-5" style="border-top: 1px solid rgba(23, 162, 184, .2);;">
            <p class="m-0 text-center text-white">
                &copy; <a class="text-primary font-weight-bold" href="https://redacademica.edu.co/terminos-y-condiciones">Terminos y Condiciones</a>  -----

                <a class="text-primary font-weight-bold" href="https://www.educacionbogota.edu.co/portal_institucional/transparencia-politicas-lineamientos-manuales-sectoriales-institucionales">Politicas de Privacidad</a>
            </p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>