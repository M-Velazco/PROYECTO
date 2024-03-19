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
    <?php 
if (isset($_GET['succes']) && $_GET['succes'] == 'logeado') {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>"; // Incluye SweetAlert desde CDN

    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Haz iniciado',
                    text: 'Bienvenido/a haz logrado ingresar'
                    
                });
            });
          </script>";
}
?>
<?php 
if (isset($_GET['succes']) && $_GET['succes'] == 'citaS') {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>"; // Incluye SweetAlert desde CDN

    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Haz agendado cita',
                    text: 'Por Favor verifica tu correo para confirmacion'
                    
                });
            });
          </script>";
}
?>
<?php 
if (isset($_GET['succes']) && $_GET['succes'] == 'Comentado') {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>"; // Incluye SweetAlert desde CDN

    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Felicidades',
                    text: 'Opinion  enviada correctamente!'
                    
                });
            });
          </script>";
}
?>
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
    <a href="Principal.php" class="nav-item nav-link">Principal</a>
    
    <div class="nav-item dropdown">
        <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
        <div class="dropdown-menu rounded-0 m-0">
            <a href="Publicaciones.php" class="dropdown-item">Publicaciones</a>
            <a href="Actividades.php" class="dropdown-item">Actividades</a>
        </div>
    </div>';
    elseif($rol_usuario=='Estudiante') :
        if ($Curso_estudiante && intval($Curso_estudiante) < 601) {
            echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
                  <a href="Foros.php" class="nav-item nav-link">Foros</a>
                  <div class="nav-item dropdown">
                      <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                      <div class="dropdown-menu rounded-0 m-0">
                          <a href="Publicaciones.php" class="dropdown-item">Publicaciones</a>
                          <a href="Actividades.php" class="dropdown-item">Actividades</a>
                      </div>
                  </div>';
        } else {
            echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
                  <a href="chat/login.php" class="nav-item nav-link">Chat</a>
                  <a href="Foros.php" class="nav-item nav-link">Foros</a>
                  <div class="nav-item dropdown">
                      <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                      <div class="dropdown-menu rounded-0 m-0">
                          <a href="Publicaciones.php" class="dropdown-item">Publicaciones</a>
                          <a href="Actividades.php" class="dropdown-item">Actividades</a>
                      </div>
                  </div>';
        }
        elseif($rol_usuario=='administrador') :
            echo '<a href="index04.php" class="nav-item nav-link active">Home</a>
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
                    <a href="Boletines/FormB.php" class="dropdown-item">Boletines</a>
                </div>';
                elseif($rol_usuario=='Padre_familia') :
                    echo '
                    <a href="index04.php" class="nav-item nav-link active">Home</a>
                    
                    
                    <div class="nav-item dropdown">
                <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="Visual_padres" class="dropdown-item">Padres de Familia</a>
                </div>';
                elseif($rol_usuario=='Docente') :
                    echo '
                    <a href="index04.php" class="nav-item nav-link active">Home</a>
                    <a href="Foros.php" class="nav-item nav-link">Foros</a>
                    
                    <div class="nav-item dropdown">
                    <a href="index.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Mas</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="Actividades.php" class="dropdown-item">Actividades</a>
                        <a href="Publicaciones.php" class="dropdown-item">Publicaciones</a>
                        <a href="Visual_padres" class="dropdown-item">Estudiantes</a>
                        <a href="Boletines/FormB.php" class="dropdown-item">Boletines</a>
                    </div>';
        
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
    <div class="container-fluid bg-primary px-0 px-md-5 mb-5">
        <div class="row align-items-center px-3">
            <div class="col-lg-6 text-center text-lg-left">
                <h4 class="text-white mb-4 mt-5 mt-lg-0">Gestion Academica</h4>
                <h1 class="display-3 font-weight-bold text-white">nuevo enfoque para la educación de los niños</h1>
                <p class="text-white mb-4">La educación es el faro que ilumina el camino hacia el progreso y la realización personal. Es el arte de cultivar mentes y corazones, de sembrar semillas de conocimiento y fomentar el crecimiento intelectual y emocional en cada individuo. En el aula, se forja el futuro, se moldean los sueños y se construyen las bases para un mundo mejor.

                </p>
            
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <img class="img-fluid mt-5" src="img/header.png" alt="">
            </div>

        </div>
    </div>
    <!-- Header End -->


    <!-- Facilities Start -->
    <div class="container-fluid pt-5">
        <div class="container pb-3">
            <div class="row">
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px;">
                        <i class="flaticon-050-fence h1 font-weight-normal text-primary mb-3"></i>
                        <div class="pl-4">
                            <h4>Patio de juegos</h4>
                            <p class="m-0">"El propósito de la educación es reemplazar una mente vacía por una mente abierta."</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px;">
                        <i class="flaticon-022-drum h1 font-weight-normal text-primary mb-3"></i>
                        <div class="pl-4">
                            <h4>Musica y baile</h4>
                            <p class="m-0">"Bailar es como soñar con los pies."</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px;">
                        <i class="flaticon-030-crayons h1 font-weight-normal text-primary mb-3"></i>
                        <div class="pl-4">
                            <h4>Artes y manualidades</h4>
                            <p class="m-0">"El arte es el reflejo de la vida, y las manualidades son la herramienta para darle forma." </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px;">
                        <i class="flaticon-017-toy-car h1 font-weight-normal text-primary mb-3"></i>
                        <div class="pl-4">
                            <h4>Transporte seguro</h4>
                            <p class="m-0">"El transporte escolar es el primer paso hacia la igualdad de oportunidades educativas para todos los niños."</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px;">
                        <i class="flaticon-025-sandwich h1 font-weight-normal text-primary mb-3"></i>
                        <div class="pl-4">
                            <h4>Comida sana</h4>
                            <p class="m-0">"Tu salud es tu mayor riqueza. Invierte en ella a través de una alimentación nutritiva y equilibrada.".</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px;">
                        <i class="flaticon-047-backpack h1 font-weight-normal text-primary mb-3"></i>
                        <div class="pl-4">
                            <h4>Énfasis en valores</h4>
                            <p class="m-0">Invertimos en innovación educativa, preparándote para el futuro.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facilities Start -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid rounded mb-5 mb-lg-0" src="img/about-1.jpg" alt="">
                </div>
                <div class="col-lg-7">
                    <p class="section-title pr-5"><span class="pr-2">Aprende sobre Nosotros</span></p>
                    <h1 class="mb-4">La mejor escuela para tus hijos</h1>
                    <p>
                        "El estudio es el viaje de autodescubrimiento más apasionante que uno puede emprender en la vida. Es el compromiso diario de explorar los límites de nuestro conocimiento, de desafiar nuestras creencias y de ampliar nuestra comprensión del mundo que nos rodea. A través del estudio, no solo adquirimos información, sino que también cultivamos la habilidad de pensar de manera crítica, de analizar con profundidad y de sintetizar ideas complejas. Es un proceso enriquecedor que nos transforma, que nos capacita para enfrentar los desafíos con valentía y para abrazar las oportunidades con confianza. Cada momento dedicado al estudio es una inversión en nuestro crecimiento personal y en nuestro potencial ilimitado para hacer una diferencia en el mundo. Entonces, avancemos con pasión y determinación, porque en el estudio encontramos el poder para convertir nuestros sueños en realidad y para alcanzar las estrellas más altas de nuestros ideales más nobles."</p>
                    <div class="row pt-2 pb-4">
                        <div class="col-6 col-md-4">
                            <img class="img-fluid rounded" src="img/about-2.jpg" alt="">
                        </div>
                        <div class="col-6 col-md-8">
                            <ul class="list-inline m-0">
                                <li class="py-2 border-top border-bottom"><i class="fa fa-check text-primary mr-3"></i>voy a trabajar duro para ellos</li>
                                <li class="py-2 border-bottom"><i class="fa fa-check text-primary mr-3"></i>"El arte es la expresión más pura del alma humana."</li>
                                <li class="py-2 border-bottom"><i class="fa fa-check text-primary mr-3"></i>"Sé el cambio que quieres ver en el mundo..</li>
                            </ul>
                        </div>
                    </div>
                    <a href="" class="btn btn-primary mt-2 py-2 px-4">Volver al Inicio</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Class Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">CONOCENOS</span></p>
                <h1 class="mb-4">Cuenta con Nosotros</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <div class="card border-0 bg-light shadow-sm pb-2">
                        <img class="card-img-top mb-2" src="img/class-1.jpg" alt="">
                        <div class="card-body text-center">
                            <h4 class="card-title">Certificacion Tecnica</h4>
                            <p class="card-text">"Cree en ti mismo y en todo lo que eres. Sé consciente de que hay algo dentro de ti que es más grande que cualquier obstáculo."</p>
                        </div>
                        <div class="card-footer bg-transparent py-4 px-5">
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Edad Ingreso</strong></div>
                                <div class="col-6 py-1">Grado decimo 10</div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Asientos</strong></div>
                                <div class="col-6 py-1">40 Asientos</div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Horarios</strong></div>
                                <div class="col-6 py-1">06:00 - 12:00</div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card border-0 bg-light shadow-sm pb-2">
                        <img class="card-img-top mb-2" src="img/class-2.jpg" alt="">
                        <div class="card-body text-center">
                            <h4 class="card-title">Tecnologia Renovada
                            </h4>
                            <p class="card-text">"La tecnología es mejor cuando nos une, en lugar de dividirnos para  amplificador de nuestro potencial humano. </p>
                        </div>
                        <div class="card-footer bg-transparent py-4 px-5">
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Edad Ingreso</strong></div>
                                <div class="col-6 py-1">10 años</div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Asientos</strong></div>
                                <div class="col-6 py-1">40 Asientos</div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Horarios</strong></div>
                                <div class="col-6 py-1">12:15 - 06:15</div>
                            </div>
                           
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card border-0 bg-light shadow-sm pb-2">
                        <img class="card-img-top mb-2" src="img/class-3.jpg" alt="">
                        <div class="card-body text-center">
                            <h4 class="card-title">
                                Apoyo Academico</h4>
                            <p class="card-text">Brindamos un apoyo académico de calidad, cimentando el conocimiento y preparándote para enfrentar cualquier desafío académico</p>
                        </div>
                        <div class="card-footer bg-transparent py-4 px-5">
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Edad Ingreso</strong></div>
                                <div class="col-6 py-1">3 años</div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong> Asientos</strong></div>
                                <div class="col-6 py-1">40 Asientos</div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Horarios</strong></div>
                                <div class="col-6 py-1">06:00 - 12:00</div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Class End -->
</form>


    <!-- Team Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Docentes</span></p>
                <h1 class="mb-4">Conoce a nuestros Docentes
                </h1>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                    <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
                        <img class="img-fluid w-100" src="img/team-1.jpg" alt="" >
                       
                    </div>
                    <h4>Julia Smith</h4>
                    <i>Docente de Musica</i>
                </div>
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                    <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
                        <img class="img-fluid w-100" src="img/team-2.jpg" alt="" >
                       
                    </div>
                    <h4>Jhon Doe</h4>
                    <i>Docente de Lenguaje Catellano</i>
                </div>
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                    <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
                        <img class="img-fluid w-100" src="img/team-3.jpg" alt="" >
                        
                    </div>
                    <h4>Mollie Ross</h4>
                    <i>Docente de Danzas</i>
                </div>
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                    <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
                        <img class="img-fluid w-100" src="img/team-4.jpg" alt="" >
                       
                    </div>
                    <h4>Donald John</h4>
                    <i>Docente de Musica</i>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- opinion api Start -->
    <div class="container-fluid py-5">
        <div class="container p-0">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Testimonio</span></p>
                <h1 class="mb-4">¡Qué dicen los padres!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
    <?php 
    
    $url = 'http://localhost/PROYECTO/DIGIWORM..04/Apis/OpinionApi.php';

// Inicializar la solicitud cURL
$curl = curl_init($url);

// Establecer opciones de solicitud cURL
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la solicitud cURL
$response = curl_exec($curl);

// Verificar si hay errores
if ($response === false) {
    die("Error en la solicitud: " . curl_error($curl));
}

// Decodificar la respuesta JSON
$opiniones = json_decode($response, true);

// Verificar si se recibieron opiniones
if (empty($opiniones)) {
    echo "No se encontraron opiniones.";
} else {
    // Iterar sobre las opiniones y mostrarlas en el HTML
    foreach ($opiniones as $opinion) {
    ?>
    <div class="testimonial-item px-3">
        <div class="bg-light shadow-sm rounded mb-4 p-4">
            <h3 class="fas fa-quote-left text-primary mr-3"></h3>
            <?php echo $opinion['Opinion']; ?>
        </div>
        <div class="d-flex align-items-center">
            <img class="rounded-circle" src="img/profp.png" style="width: 70px; height: 70px;" alt="Image">
            <div class="pl-3">
                <h5><?php echo $opinion['Nombres_Apellidos']; ?></h5>
                <i>Padre de Familia</i>
            </div>
        </div>
    </div>
    <?php 
    } // Fin del bucle
}
curl_close($curl);

?>
</div>

        </div>
    </div>
    <!-- Testimonial End -->
 

    <!-- Blog Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Noticias</span></p>
                <h1 class="mb-4">Últimas Noticias</h1>
            </div>
            <div class="row pb-3">
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm mb-2">
                        <img class="card-img-top mb-2" src="img/blog-1.jpg" alt="">
                        <div class="card-body bg-light text-center p-4">
                            <h4 class="">Entrega Boletines</h4>
                            <div class="d-flex justify-content-center mb-3">
                                <small class="mr-3"><i class="fa fa-user text-primary"></i> Administrador</small>
                                <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web Design</small>
                                <small class="mr-3"><i class="fa fa-comments text-primary"></i> 15</small>
                            </div>
                            <p>Es un placer para nosotros compartir con ustedes los informes académicos correspondientes al periodo. En estos informes, encontrarán una evaluación detallada del desempeño académico y el progreso de cada estudiante en todas las áreas de estudio.</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm mb-2">
                        <img class="card-img-top mb-2" src="img/blog-2.jpg" alt="">
                        <div class="card-body bg-light text-center p-4">
                            <h4 class="">Reunion</h4>
                            <div class="d-flex justify-content-center mb-3">
                                <small class="mr-3"><i class="fa fa-user text-primary"></i> Administrador</small>
                                <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web Design</small>
                                <small class="mr-3"><i class="fa fa-comments text-primary"></i> 75</small>
                            </div>
                            <p>Espero que este mensaje les encuentre bien. Me dirijo a ustedes para convocarles a una reunión [especificar el propósito de la reunión, por ejemplo: "para discutir los resultados del último trimestre", "para planificar el evento anual.</p>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm mb-2">
                        <img class="card-img-top mb-2" src="img/blog-3.jpg" alt="">
                        <div class="card-body bg-light text-center p-4">
                            <h4 class="">Capacitaciones</h4>
                            <div class="d-flex justify-content-center mb-3">
                                <small class="mr-3"><i class="fa fa-user text-primary"></i> Administrador</small>
                                <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web Design</small>
                                <small class="mr-3"><i class="fa fa-comments text-primary"></i> 100</small>
                            </div>
                            <p>La capacitación está diseñada para [explicar los objetivos y beneficios de la capacitación]. Durante la sesión, se abordarán temas como [enumerar los temas principales que se cubrirán] y se proporcionará una oportunidad para discutir y compartir mejores prácticas.</p>
                            
                        </div>
                    </div>
                </div>
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
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"a>
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
                <h3 class="text-primary mb-4">Testimonio</h3>
                <form action="validacion/opinion.php" method="POST" >
                    <div class="form-group">
                        <input type="text" class="form-control border-0 py-4" name="Nombres_Apellidos" id="Nombres_Apellidos" placeholder="Nombres y Apellidos" required="required" />
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control border-0 py-4" name="Email" id="Email" placeholder="Email"
                            required="required" />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control border-0 py-4" name="Opinion" id="Opinion" placeholder="Mensaje" required="required" />
                    </div>
                    <div>
                        
                        <input type="submit" value="Ingresar" class="btn btn-primary btn-block border-0 py-3" />
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