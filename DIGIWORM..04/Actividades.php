
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
    <a href="Principal.php" class="nav-item nav-link">Principal</a>
    
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
                <a href="Datos.php">
                <?php echo $nombre_usuario."-". $rol_usuario." "; ?>.</a>
                
                <a href="modelo/CerrarSession.php">Cerrar sesion</a>
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
            <h3 class="display-3 font-weight-bold text-white">ACTIVIDADES</h3>
            <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="index04.php">Home</a></p>
                <p class="m-0 px-2">/</p>
              
            </div>
        </div>
    </div>
    <!-- Header End -->
    <!-- Blog Start -->
    <div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5"><span class="px-2">Propuestas</span></p>
            <h1 class="mb-4">Actividades</h1>
        </div>
        <a href="agregar.php" >
        <button class="btn btn-primary px-4 mx-auto my-2" > agregar</button>
        </a>
        <div class="row pb-3">
            <?php
            $conexion = new mysqli("localhost", "root", "sena", "digiworm_04");
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }
            $consulta = $conexion->query("SELECT  * FROM actividades");

            while ($fila = $consulta->fetch_assoc()) {
                // Obtener el nombre del docente
                $consulta_docente = $conexion->query("SELECT Nombres FROM docente WHERE idDocente = {$fila['Docente']}");
                $docente = $consulta_docente->fetch_assoc();
            ?>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm mb-2">
                        <img class="card-img-top mb-2" src="img/blog-1.jpg" alt="">
                        <div class="card-body bg-light text-center p-4">
                            <h4 class=""><?php echo $fila['Nombre_act']; ?></h4>
                            
                            <div class="d-flex justify-content-center mb-3">
                                <small class="mr-3"><i class="fa fa-user text-primary"></i>  <?php echo $docente['Nombres']; ?></small>
                                <small class="mr-3"><i class="fas fa-book" style="color: #38ee2b;"></i><?php echo $fila['Asignatura']; ?></small>
                                <small class="mr-3"><i class="fa fa-folder text-primary"></i> <?php echo $fila['Archivo']; ?></small>
                                <small class="mr-3"><i class="fa fa-comments text-primary"></i> <?php echo $fila['Estado']; ?></small>
                            </div>

                            <p><?php echo $fila['Descripcion']; ?></p>
                            <a href="includes/download.php?idActividades= <?php echo $fila['idActividades'] ;?>" class="btn btn-primary px-4 mx-auto my-2">Publicar</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="col-md-12 mb-4">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>


    <!-- Blog End -->
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
                        style="width: 38px; height: 38px;" href="https://www.facebook.com/ColegiopauloVI/"><i class="fab fa-facebook-f"></i></a>
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
                    <a class="text-white mb-2" href="chat"><i class="fa fa-angle-right mr-2"></i>Chat</a>
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