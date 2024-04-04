


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
    <meta content="DIGIWORM" name="keywords">
    <meta content="DIGIWORM" name="description">

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


        <div class="nav-item dropdown">
        <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
        <div class="dropdown-menu rounded-0 m-0">
             <a href="publicaciones/publicaciones.php" class="dropdown-item">Publicaciones</a>

            <a href="cursos.php" class="dropdown-item">Cursos</a>
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

                      </div>
                  </div>';
        }
        elseif($rol_usuario=='administrador') :
            echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
            <a href="Actividades.php" class="nav-item nav-link">Actividades</a>
            <a href="chat/login.php" class="nav-item nav-link">Chat</a>
            <a href="Foros.php" class="nav-item nav-link">Foros</a>


            <div class="nav-item dropdown">
                <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                <div class="dropdown-menu rounded-0 m-0">

                    <a href="publicaciones/publicaciones.php" class="dropdown-item">Publicaciones</a>
                    <a href="Visual_padres" class="dropdown-item">Estudiantes</a>
                    <a href="boletines.php" class="dropdown-item">Boletines</a>
                    <a href="cursos.php" class="dropdown-item">Cursos</a>

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
            <h3 class="display-3 font-weight-bold text-white">Docentes</h3>
            <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="index04.php">Home</a></p>
                <p class="m-0 px-2">/</p>

            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Team Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Docentes</span></p>
                <h1 class="mb-4">Con Certificaciones</h1>
            </div>
            <a href="Docentes/FdocentesA.php" >

<button class="button-85" role="button">Modificar Datos</button>
                </a>
            <div class="row">








            <div class="col-md-6 col-lg-3 text-center team mb-5">
            <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
        <img class="img-fluid w-100" src="img/team-1.jpg" alt="" onclick="mostrarDatosPersonales()">
    </div>

    <h4>Julia Smith</h4>
    <div id="datosPersonales" style="display: none;">
        <p>Fecha de nacimiento: 10 de mayo de 1990</p>
        <p>Correo electrónico: julia@example.com</p>
        <p>Teléfono: +1534567890</p>
        <p>Estudios: Maestria en Ingles</p>
    </div>
</div>

<script>
    function mostrarDatosPersonales() {
        var datosPersonales = document.getElementById("datosPersonales");
        if (datosPersonales.style.display === "none") {
            datosPersonales.style.display = "block";
        } else {
            datosPersonales.style.display = "none";
        }
    }
</script>




<!-- Aquí se mostrarán los datos personales -->
<div id="datos-personales"></div>
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
        <img class="img-fluid w-100" src="img/testimonial-3.jpg" alt="" onclick="MostrarDatosPersonales()">
    </div>
                    <h4>Jhon Doe</h4>

                    <div id="DatosPersonales" style="display: none;">
        <p>Fecha de nacimiento:24 de mayo de 1965</p>
        <p>Correo electrónico: Doe@gmail.com</p>
        <p>Teléfono: +1534567890</p>
        <p>Estudios: Maestria en religion</p>
    </div>
    <script>
    function MostrarDatosPersonales() {
        var datosPersonales = document.getElementById("DatosPersonales");
        if (datosPersonales.style.display === "none") {
            datosPersonales.style.display = "block";
        } else {
            datosPersonales.style.display = "none";
        }
    }
</script>

<!-- Aquí se mostrarán los datos personales -->
    </div>

                <div id="DAtos-personales"></div>
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
        <img class="img-fluid w-100" src="img/team-3.jpg" alt="" onclick="MostrarDatosPersonale()">
    </div>
                    <h4>Mollie Ross</h4>

                    <div id="DAtosPersonales" style="display: none;">
        <p>Fecha de nacimiento:18 de mayo de 1997</p>
        <p>Correo electrónico: mollieR@gmail.com</p>
        <p>Teléfono: +1534567890</p>
        <p>Estudios: Maestria en Educacion Fisica</p>
    </div>
    <script>
    function MostrarDatosPersonale() {
        var datosPersonale = document.getElementById("DAtosPersonales");
        if (datosPersonale.style.display === "none") {
            datosPersonale.style.display = "block";
        } else {
            datosPersonale.style.display = "none";
        }
    }
</script>

<!-- Aquí se mostrarán los datos personales -->

</div>

<div id="DAtos-personalecc"></div>
<div class="col-md-6 col-lg-3 text-center team mb-5">
<div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
<img class="img-fluid w-100" src="img/oip.jpg" alt="" onclick="DatosPersonalecc()">
</div>
    <h4>Magdy Velazco</h4>

    <div id="DAtosPersonalecc" style="display: none;">
<p>Fecha de nacimiento:17 de octubre de 1997</p>
<p>Correo electrónico: velazco17@gmail.com</p>
<p>Teléfono: +1534567890</p>
<p>Estudios: Maestria en Educacion Fisica</p>
</div>

<script>
function DatosPersonalecc() {
var datosPersonale = document.getElementById("DAtosPersonalecc");
if (datosPersonale.style.display === "none") {
datosPersonale.style.display = "block";
} else {
datosPersonale.style.display = "none";
}
}
</script>

<!-- Aquí se mostrarán los datos personales -->

                </div>
                <div id="personales"></div>
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
        <img class="img-fluid w-100" src="img/team-4.jpg" alt="" onclick="DatosPersonales()">

                    </div>
                    <h4>Andres Felipe</h4>
                    <div id="Personales" style="display: none;">
        <p>Fecha de nacimiento:30 de febrero de 1970</p>
        <p>Correo electrónico: pipe@gmail.com</p>
        <p>Teléfono: +1534567890</p>
        <p>Estudios: Maestria en  primera infancia</p>
    </div>
    <script>
    function DatosPersonales() {
        var datosPersonale = document.getElementById("Personales");
        if (datosPersonale.style.display === "none") {
            datosPersonale.style.display = "block";
        } else {
            datosPersonale.style.display = "none";
        }
    }
</script>

               <!-- Aquí se mostrarán los datos personales -->
               </div>
                <div id="xdpersonales"></div>
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
        <img class="img-fluid w-100" src="img/testimonial-2.jpg" alt="" onclick="xdPersonales()">

                    </div>
                    <h4>Maria Alejandra</h4>
                    <div id="xdPersonales" style="display: none;">
        <p>Fecha de nacimiento:30 de febrero de 1970</p>
        <p>Correo electrónico: Aleja00@gmail.com</p>
        <p>Teléfono: +1534567890</p>
        <p>Estudios: Maestria en  primera Ciencias Naturales</p>
    </div>
    <script>
    function xdPersonales() {
        var datosPersonale = document.getElementById("xdPersonales");
        if (datosPersonale.style.display === "none") {
            datosPersonale.style.display = "block";
        } else {
            datosPersonale.style.display = "none";
        }
    }
</script>

              <!-- Aquí se mostrarán los datos personales -->
              </div>

<div id="DAtos-personalec"></div>
<div class="col-md-6 col-lg-3 text-center team mb-5">
<div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
<img class="img-fluid w-100" src="img/avatar.jpg" alt="" onclick="DatosPersonalec()">
</div>
    <h4>Johan Santiago</h4>

    <div id="DAtosPersonalec" style="display: none;">
<p>Fecha de nacimiento:28 de marzo de 1973</p>
<p>Correo electrónico: villanueva18@gmail.com</p>
<p>Teléfono: +1534567890</p>
<p>Estudios: Maestria en Matematicas</p>
</div>

<script>
function DatosPersonalec() {
var datosPersonale = document.getElementById("DAtosPersonalec");
if (datosPersonale.style.display === "none") {
datosPersonale.style.display = "block";
} else {
datosPersonale.style.display = "none";
}
}
</script>

 <!-- Aquí se mostrarán los datos personales -->

 </div>

<div id="DAtos-personaless"></div>
<div class="col-md-6 col-lg-3 text-center team mb-5">
<div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
<img class="img-fluid w-100" src="img/user.jpg" alt="" onclick="DatosPersonaless()">
</div>
    <h4>Johan Stiven</h4>

    <div id="DAtosPersonaless" style="display: none;">
<p>Fecha de nacimiento:06 de abril de 1994</p>
<p>Correo electrónico: stiven123@gmail.com</p>
<p>Teléfono: +1534567890</p>
<p>Estudios: Maestria en Filosofia</p>
</div>

<script>
function DatosPersonaless() {
var datosPersonale = document.getElementById("DAtosPersonaless");
if (datosPersonale.style.display === "none") {
datosPersonale.style.display = "block";
} else {
datosPersonale.style.display = "none";
}
}
</script>

            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container p-0">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Informacion</span></p>
                <h1 class="mb-4">Conocenos!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item px-3">
                    <div class="bg-light shadow-sm rounded mb-4 p-4">
                        <h3 class="fas fa-quote-left text-primary mr-3"></h3>
                       Tu puerta al conocimiento y el aprendizaje
                    </div>
                    <div class="d-flex align-items-center">

                    </div>
                </div>
                <div class="testimonial-item px-3">
                    <div class="bg-light shadow-sm rounded mb-4 p-4">
                        <h3 class="fas fa-quote-left text-primary mr-3"></h3>
                        Contruyendo un futuro educado, juntos.
                    </div>
                    <div class="d-flex align-items-center">


                    </div>
                </div>
                <div class="testimonial-item px-3">
                    <div class="bg-light shadow-sm rounded mb-4 p-4">
                        <h3 class="fas fa-quote-left text-primary mr-3"></h3>
                       Educacion sin limites, aprendisaje sin fronteras.
                    </div>
                    <div class="d-flex align-items-center">

                        </div>
                    </div>
                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


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

                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="https://www.facebook.com/profile.php?id=61557564631844&mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"

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
                <h3 class="text-primary mb-4">Ingresa</h3>
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
                        <button class="btn btn-primary btn-block border-0 py-3" type="submit">"Los docentes son los héroes cotidianos que dedican sus vidas a hacer del mundo un lugar mejor a través de la educación."</button>
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