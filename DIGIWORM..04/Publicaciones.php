


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
    <link href="img/favicon.ico" rel="icon">

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
    
    <div class="nav-item dropdown">
        <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
        <div class="dropdown-menu rounded-0 m-0">
            <a href="Publicaciones.php" class="dropdown-item">Publicaciones</a>
            <a href="Actividades.php" class="dropdown-item">Actividades</a>
        </div>
    </div>';
    elseif($rol_usuario=='Estudiante') :
        echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
        <a href="chat/login.php" class="nav-item nav-link">Chat</a>
    <div class="nav-item dropdown">
        <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
        <div class="dropdown-menu rounded-0 m-0">
            <a href="Publicaciones.php" class="dropdown-item">Publicaciones</a>
            <a href="Actividades.php" class="dropdown-item">Actividades</a>
        </div>
    </div>
        ';
        elseif($rol_usuario=='Padre_de_Familia') :
            echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
            <a href="Visual_padres" class="dropdown-item">Padres de Familia</a>';
        
        else: echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
        <a href="Principal.php" class="nav-item nav-link">Principal</a>
            <a href="chat/login.php" class="nav-item nav-link">Chat</a>
            <a href="Foros.php" class="nav-item nav-link">Foros</a>
            <a href="Docentes.php" class="nav-item nav-link">Docentes</a>
            <div class="nav-item dropdown">
                <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="Actividades.php" class="dropdown-item">Actividades</a>
                    <a href="Publicaciones.php" class="dropdown-item">Publicaciones</a>
                    <a href="Visual_padres" class="dropdown-item">Padres de Familia</a>
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
                <?php echo $nombre_usuario."-". $rol_usuario." "; ?>.
                
                
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
            <h3 class="display-3 font-weight-bold text-white">Publicaciones</h3>
            <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="index04.php">Home</a></p>
                <p class="m-0 px-2">/</p>
                
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Detail Start -->
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col-lg-8">
                <div class="d-flex flex-column text-left mb-3">
                    <p class="section-title pr-5"><span class="pr-2">Nosotros</span></p>
                    <h1 class="mb-3">Aqui te podras tener Informado de Nosotros</h1>
                    <div class="d-flex">
                       
                    </div>
                </div>
                <div class="mb-5">
                    <img class="img-fluid rounded w-100 mb-4" src="img/detail.jpg" alt="Image">
                    <p> La tradición de transmitir historias y cuentos a otros, es tan antigua casi como el origen de los hombres. Estas historias y cuentos cortos, si bien no adaptados aún a la infancia como en la actualidad, eran confeccionados a modo de leyendas en las cuales se transmitía la importancia de los dioses y de las tradiciones, o se fabulaba con la existencia de mundos imaginarios habitados por princesas, villanos y héroes. En dichas leyendas, se procuraba transmitir oralmente a la sociedad la idea que se tenía del bien y del mal, a través de símiles y cuentos fantásticos.</p>
                    <p> En la Edad Moderna, época en la cual se empieza a tener una noción y una preocupación especial por el niño y la infancia como categoría social, surgen los cuentos infantiles cortos propiamente dichos, adaptados especialmente para ellos muchas veces de las historias y cuentos breves tradicionales.</p>
                    <h2 class="mb-4">Eventos</h2>
                    <img class="img-fluid rounded w-50 float-left mr-4 mb-3" src="img/blog-1.jpg" alt="Image">
                    <p>Las frases para promocionar eventos culturales deben destacar el atractivo o la originalidad del evento, el prestigio o la popularidad de los artistas o autores participantes, la calidad o la exclusividad del contenido o la obra presentada, y la emoción o el disfrute que experimentarán los asistentes.
                       <p>– Vive una noche mágica con la música de tu artista favorito.</p> 
<p>–No te quedes sin tu entrada para el festival.</p>
                    </p>
                    <h3 class="mb-4">Reuniones</h3>
                    <img class="img-fluid rounded w-50 float-right ml-4 mb-3" src="img/blog-2.jpg" alt="Image">
                    <p>En nuestra reuniones academicas , fomentamos un ambiente de respeto , apertura y colaboracion , donde cada voz es escuchada y valorada.</p>
                </div>

                <!-- Related Post -->
              

                <!-- Comment List -->
                <div class="mb-5">
                    <h2 class="mb-4">Horarios de atencion</h2>
                    <div class="media mb-4">
                        <img src="img/user.jpg" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px;">
                        <div class="media-body">
                            <h6>Jose Espinosa <small><i></i></small></h6>
                            <p>
                                Estimados padres de familia , este va hacer el horario de atencion.12:00 a 3:00 de la tarde.
                            </p>
                           
                        </div>
                    </div>
                    <div class="mb-5">
                        <h2 class="mb-4">Video Section</h2>
                        <div class="d-flex justify-content-center">
                            <video width="640" height="360" controls>
                                <source src="img/Y2meta.app - _Cuerdas_, Cortometraje completo.mp4" type="video/mp4">
                                Tu navegador no admite el elemento de video.
                            </video>
                        </div>
                    </div>
                </div>

                <!-- Comment Form -->
                <div class="bg-light p-5">
                    <h2 class="mb-4">Estructura de las Publicaciones</h2>
                    <p>
                        <img src="img/profesor-con-alumnos.jpg" alt="Descripción de la imagen">
                    </p>
                </div>
                
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Author Bio -->
                <div class="d-flex flex-column text-center bg-primary rounded mb-5 py-5 px-4">
                    <img src="img/user.jpg" class="img-fluid rounded-circle mx-auto mb-3" style="width: 100px;">
                    <h3 class="text-secondary mb-3">Jose Demetrio Espino</h3>
                    <p class="text-white m-0">Estimado padres de familia, estudiantes y personal educativo, Les invito a participar activamente en las actividades educativas.juntos , podemos hacer de este añ escolar un exito para todos.</p>
                </div>

                <!-- Search Form -->
              

                <!-- Category List -->
                <div class="mb-5">
                    
                    <div class="mb-5">
                        <img src="img/blog-3.jpg" alt="" class="img-fluid rounded">
                    </div>
    
                    <!-- Plain Text -->
                    <div>
                        <h2 class="mb-4">Compromiso</h2>
                        Y es que una buena infraestructura escolar, con espacios renovados, posibilita que niños y jóvenes que viven en sitios remotos puedan estudiar y, además, tiende a mejorar la asistencia e interés de los estudiantes y maestros por el aprendizaje. Por esta misma razón, las inversiones en infraestructura escolar tienen un papel fundamental para solucionar el problema del acceso de los estudiantes al sistema escolar y para mejorar su rendimiento. 
                    </div>
                </div>

                <!-- Single Image -->
                <div class="mb-5">
                    <img src="img/blog-1.jpg" alt="" class="img-fluid rounded">
                </div>

                <!-- Recent Post -->
                <div class="mb-5">
                    <h2 class="mb-4">Clases</h2>
                    <div class="d-flex align-items-center bg-light shadow-sm rounded overflow-hidden mb-3">
                        <img class="img-fluid" src="img/post-1.jpg" style="width: 80px; height: 80px;">
                        <div class="pl-3">
                            <h5 class="">Clases de dibujo</h5>
                            <div class="d-flex">
                             
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center bg-light shadow-sm rounded overflow-hidden mb-3">
                        <img class="img-fluid" src="img/post-2.jpg" style="width: 80px; height: 80px;">
                        <div class="pl-3">
                            <h5 class="">Biblioteca</h5>
                            <div class="d-flex">
                                
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center bg-light shadow-sm rounded overflow-hidden mb-3">
                        <img class="img-fluid" src="img/post-3.jpg" style="width: 80px; height: 80px;">
                        <div class="pl-3">
                            <h5 class="">Grupos de lectura</h5>
                            <div class="d-flex">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Image -->
                <div class="mb-5">
                    <img src="img/blog-2.jpg" alt="" class="img-fluid rounded">
                </div>

                <!-- Tag Cloud -->
                <div class="mb-5">
                    <div class="d-flex flex-wrap m-n1">
                        <a href="" class="btn btn-outline-primary m-1">Innovacion educativa</a>
                        <a href="" class="btn btn-outline-primary m-1">Creatividad</a>
                        <a href="" class="btn btn-outline-primary m-1">Compromiso</a>
                        <a href="" class="btn btn-outline-primary m-1">Liderazgo</a>
                        <a href="" class="btn btn-outline-primary m-1">Superacion</a>
                        <a href="" class="btn btn-outline-primary m-1">Inspiracion</a>
                    </div>
                </div>

                <!-- Single Image -->
                <div class="mb-5">
                    <img src="img/blog-3.jpg" alt="" class="img-fluid rounded">
                </div>

                <!-- Plain Text -->
                <div>
                    <h2 class="mb-4">Estructura</h2>
                    Y es que una buena infraestructura escolar, con espacios renovados, posibilita que niños y jóvenes que viven en sitios remotos puedan estudiar y, además, tiende a mejorar la asistencia e interés de los estudiantes y maestros por el aprendizaje. Por esta misma razón, las inversiones en infraestructura escolar tienen un papel fundamental para solucionar el problema del acceso de los estudiantes al sistema escolar y para mejorar su rendimiento. 
                </div>
            </div>
        </div>
    </div>
    <!-- Detail End -->


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
                        style="width: 38px; height: 38px;" href="https://www.facebook.com/ColegiopauloVI/"><i class="fab fa-facebook-f"></i></a>
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