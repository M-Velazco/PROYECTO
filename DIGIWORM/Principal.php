<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DIGIWORM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="security-guard-website-template/scss/style.scss" rel="stylesheet">
    <link href="css/map.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <style>
    </style>
</head>
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

<body class="bg-white">

    
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-0">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-primary">Safety</span>First</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="blog-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/profesor-con-alumnos.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <!DOCTYPE html>
                        <html lang="en" class="no-js">
                            <head>
                                <meta charset="UTF-8" />
                                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
                                <title>Desplegable </title>
                                <link rel="stylesheet" type="text/css" href="css/Desplegable.css" />
                                <script src="js/modernizr-2.6.2.min.js"></script>
                        
                        <script type="text/javascript">
                        var _gaq = _gaq || [];
                        _gaq.push(['_setAccount', 'UA-7243260-2']);
                        _gaq.push(['_trackPageview']);
                        (function() {
                        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                        })();
                        </script>
                        
                            </head>
                            <body>
                                <div class="container">
                                    <!-- Top Navigation -->
                                    
                                
                                    <div class="component">
                                        <h2>DIGIWORM</h2>
                                        <!-- Start Nav Structure -->
                                        <button class="cn-button" id="cn-button">Menu</button>
                                        <div class="cn-wrapper" id="cn-wrapper">
                                            <ul>
                                                <li><a href="#"><span>Foros</span></a></li>
                                                <li><a href="#"><span>Actividades</span></a></li>
                                                <li><a href="#"><span>Cursos</span></a></li>
                                                <li><a href="Publicaciones.html"><span>Publicaciones</span></a></li>
                                                <li><a href="#"><span>Notas</span></a></li>
                                                <li><a href="spa-html-template\Docentes.php"><span>Docentes</span></a></li>
                                                <li><a href="chat"><span>Chat</span></a></li>
                                             </ul>
                                        </div>
                                        <!-- End of Nav Structure -->
                                    </div>
                                    
                                </div><!-- /container -->
                                <script src="js/polyfills.js"></script>
                                <script src="js/Desplegable.js"></script>
                                <!-- For the demo ad only -->   
                            </body>
                        </html>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/becas-estudio.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h4 class="text-primary m-0" style="color: aqua;">DIGI</h4>
                        <h4 class="display-4 m-0 mt-2 mt-md-3 text-white">DIGIWORM</h4>
                        <a href="" class="btn btn-lg btn-primary mt-3 mt-md-4 px-4">Nosotros</a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                <div class="btn btn-primary rounded-circle" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                <div class="btn btn-primary rounded-circle" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Features Start -->
    <div class="container-fluid py-5 py-lg-0 feature">
        <div class="row py-5 py-lg-0">
            <div class="col-lg-4 p-0">
                <div class="feature-item d-flex align-items-center border-right px-5 mb-4 mb-lg-0">
                    <i class="flaticon-policeman display-3 text-primary mr-4"></i>
                    <div class="">
                        <h5 class="mb-3">Puentes hacia el Mañana</h5>
                        <p class="m-0">No veas los obstáculos como barreras, sino como puentes hacia el mañana. Cada desafío es una oportunidad para crecer y avanzar hacia tus metas.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-0">
                <div class="feature-item d-flex align-items-center border-right px-5 mb-4 mb-lg-0">
                    <i class="flaticon-helmet display-3 text-primary mr-4"></i>
                    <div class="">
                        <h5 class="mb-3">Cultivando la Mente</h5>
                        <p class="m-0">Alimenta tu mente con grandes ideas, sueños y conocimientos.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-0">
                <div class="feature-item d-flex align-items-center px-5">
                    <i class="flaticon-surveillance display-3 text-primary mr-4"></i>
                    <div class="">
                        <h5 class="mb-3">Sembrando el Futuro</h5>
                        <p class="m-0">Cada libro abierto ilumina tu camino hacia oportunidades infinitas. El conocimiento es la semilla, tu esfuerzo la tierra fértil.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="container-fluid mb-5" style="background: #a4ec87;">
        <div class="row align-items-center">
            <div class="col-lg-6 px-0">
                <video width="100%" class="-fluid" src="img/video.mp4"controls>
            </div>
            <div class="col-lg-6 py-5 py-lg-0 px-3 px-lg-5">
                <h5 class="text-primary mb-3">Sigue tus metas</h5>
                <h1 class="mb-4">Nunca te Rindas</h1>
                <p>Observa detenidamente el presente que estás moldeando; debe reflejar el futuro que deseas.</p>
                <div class="row py-2">
                    <div class="col-sm-6">
                        <i class="flaticon-approved display-3 text-primary"></i>
                        <h5 class="mt-2">Páginas de Sabiduría</h5>
                        <p>En cada página, hallarás la esencia de la verdadera sabiduría.</p>
                    </div>
                    <div class="col-sm-6">
                        <i class="flaticon-medal display-3 text-primary"></i>
                        <h5 class="mt-2">Cree en ti</h5>
                        <p>Creer en ti mismo es el cimiento del éxito.</p>
                    </div>
                </div>
                <a href="" class="btn btn-lg px-4 btn-primary">Inicio</a>
            </div>
        </div>
    </div>
  
    <div class="container pt-5">
        <div class="d-flex flex-column text-center mb-5">
            <h5 class="text-primary mb-3">Nuestros servicios</h5>
            <h1 class="m-0">Ofreciendo el mejor servicio</h1>
        </div>
        <div class="row pb-3">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card mb-2 p-3">
                    <img class="card-img-top" src="img/esta-es.jpg" alt="">
                    <div class="card-body bg-secondary d-flex align-items-center p-0">
                        <h3 class="flaticon-desk font-weight-normal d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white m-0 mr-3" style="width: 45px; height: 45px;"></h3>
                        <h6 class="card-title text-white text-truncate m-0">Desarrollo Integral</h6>
                    </div>
                    <div class="card-footer">
                        Ofrecemos un ambiente de desarrollo integral donde cada estudiante encuentra el éxito asegurado en cada paso de su educación.
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card mb-2 p-3">
                    <img class="card-img-top" src="img/funiblog-fp-empatia.jpg" alt="">
                    <div class="card-body bg-secondary d-flex align-items-center p-0">
                        <h3 class="flaticon-home font-weight-normal d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white m-0 mr-3" style="width: 45px; height: 45px;"></h3>
                        <h6 class="card-title text-white text-truncate m-0">Innovación Educativa</h6>
                    </div>
                    <div class="card-footer">
                        Invertimos en innovación educativa, preparándote para el futuro.
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card mb-2 p-3">
                    <img class="card-img-top" src="img/39526785l.jpg" alt="">
                    <div class="card-body bg-secondary d-flex align-items-center p-0">
                        <h3 class="flaticon-factory font-weight-normal d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white m-0 mr-3" style="width: 45px; height: 45px;"></h3>
                        <h6 class="card-title text-white text-truncate m-0" style="color: hwb(120 0% 50%);"> Estimulación Creativa</h6>
                    </div>
                    <div class="card-footer">
                        Ofrecemos el espacio perfecto para liberar tu creatividad.                    
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card mb-2 p-3">
                    <img class="card-img-top" src="img/imagesxd.jpg" alt="">
                    <div class="card-body bg-secondary d-flex align-items-center p-0">
                        <h3 class="flaticon-transportation font-weight-normal d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white m-0 mr-3" style="width: 45px; height: 45px;"></h3>
                        <h6 class="card-title text-white text-truncate m-0">Entorno de Inclusión</h6>
                    </div>
                    <div class="card-footer">
                        Creamos un entorno de inclusión donde cada estudiante brilla, fomentando un sentido de comunidad y respeto mutuo. 
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card mb-2 p-3">
                    <img class="card-img-top" src="img/PQS-capacitacion-online-ninos.jpg" alt="">
                    <div class="card-body bg-secondary d-flex align-items-center p-0">
                        <h3 class="flaticon-desk font-weight-normal d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white m-0 mr-3" style="width: 45px; height: 45px;"></h3>
                        <h6 class="card-title text-white text-truncate m-0">Énfasis en Valores</h6>
                    </div>
                    <div class="card-footer">
                        Nuestro énfasis en valores va más allá del aula, contribuyendo a la formación de ciudadanos íntegros y comprometidos con la sociedad.                
                    </div>    
            </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card mb-2 p-3">
                    <img class="card-img-top" src="img/crece.jpg" alt="">
                    <div class="card-body bg-secondary d-flex align-items-center p-0">
                        <h3 class="flaticon-bodyguard font-weight-normal d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white m-0 mr-3" style="width: 45px; height: 45px;"></h3>
                        <h6 class="card-title text-white text-truncate m-0">Apoyo Académico </h6>
                    </div>
                    <div class="card-footer">
                        Brindamos un apoyo académico de calidad, cimentando el conocimiento y preparándote para enfrentar cualquier desafío académico                  
                    </div>
                </div>
            </div>
    </div>
  


    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-5 mb-5">
                <h5 class="text-primary mb-3">Conocemos?</h5>
                <h1 class="mb-4">Cuenta con Nosotros</h1>
                <img class="img-thumbnail mb-4 p-3" src="img/niño.jpg" alt="Image">
                <p>
                    "Esforqos e coragem näo
säo suficientes sem
prop6sito e direqäo".
  </p>
                <a href="" class="btn btn-lg btn-primary mt-2">Learn More</a>
            </div>
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <h3 class="flaticon-policeman font-weight-normal d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white m-0 mr-3" style="width: 45px; height: 45px;"></h3>
                                <h6 class="text-truncate m-0">zonas deportivas</h6>
                            </div>
                            <p>El aliento que necesitas,
                                la motivaci6n que te puede impulsar,
                                el permiso que estås buscando,
                                solo puedes dårtelo til...
                                cuando TÜ 10 decidas.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <h3 class="flaticon-bodyguard font-weight-normal d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white m-0 mr-3" style="width: 45px; height: 45px;"></h3>
                                <h6 class="text-truncate m-0">guardas entrenados</h6>
                            </div>
                            <p>"EI secreto del cambio es
                                enfocar toda tu energia,
                                no en luchar contra 10 Viejo,
                                si no en construir lo nuevo."
                                </p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <h3 class="flaticon-approved font-weight-normal d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white m-0 mr-3" style="width: 45px; height: 45px;"></h3>
                                <h6 class="text-truncate m-0">certificacion tecnica</h6>
                            </div>
                            <p>El ünico modo de hacer un gran
                                trabajo es amar 10 que haces.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <h3 class="flaticon-medal font-weight-normal d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white m-0 mr-3" style="width: 45px; height: 45px;"></h3>
                                <h6 class="text-truncate m-0">seguridad rigurosa</h6>
                            </div>
                            <p>No pasa nada si te equivocaste,
                                todos aprendemos de nuestros
                                errores y seguimos adelante.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <h3 class="flaticon-helmet font-weight-normal d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white m-0 mr-3" style="width: 45px; height: 45px;"></h3>
                                <h6 class="text-truncate m-0">tecnologia renovada</h6>
                            </div>
                            <p>"Cuando todo parece ir
                                en tu contra, recuerda
                                que el avi6n despega
                                con viento en contra,
                                no a favor" </p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <h3 class="flaticon-surveillance font-weight-normal d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white m-0 mr-3" style="width: 45px; height: 45px;"></h3>
                                <h6 class="text-truncate m-0">24/7 soporte</h6>
                            </div>
                            <p>A veces es necesario que
                                Ia vida nos sacuda
                                con mucha fuerza para
                                darnos cuenta que el tiempo
                                que nos queda no es para
                                malgastarlo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 

    <div class="container pt-5 pb-3">
        <div class="d-flex flex-column text-center mb-5">
            <h5 class="text-primary mb-3">Docentes</h5>
            <h1 class="m-0">Contando con los mejores</h1>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="row mb-2 align-items-center">
                    <div class="col-6 text-right">
                        <h6>Carlos Ñampira</h6>
                        <h6 class="text-muted font-weight-normal text-capitalize mb-2">coordinador</h6>
                        <p></p>
                        <div class="d-flex justify-content-end">
                            <a href=""><i class="fab fa-twitter mr-3"></i></a>
                            <a href=""><i class="fab fa-facebook-f mr-3"></i></a>
                            <a href=""><i class="fab fa-linkedin-in mr-3"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <img class="img-thumbnail p-3" src="img/ñampo.jpg" alt="Image">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        <img class="img-thumbnail p-3" src="img/Aurelio.jpg" alt="Image">
                    </div>
                    <div class="col-6 text-left">
                        <h6>Aurelio R</h6>
                        <h6 class="text-muted font-weight-normal text-capitalize mb-2">Quimicá</h6>
                        <p></p>
                        <div class="d-flex justify-content-start">
                            <a href=""><i class="fab fa-twitter mr-3"></i></a>
                            <a href=""><i class="fab fa-facebook-f mr-3"></i></a>
                            <a href=""><i class="fab fa-linkedin-in mr-3"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="row mb-2 align-items-center">
                    <div class="col-6 text-right">
                        <h6>Rodrigo Gonzales</h6>
                        <h6 class="text-muted font-weight-normal text-capitalize mb-2">informatica</h6>
                        <p></p>
                        <div class="d-flex justify-content-end">
                            <a href=""><i class="fab fa-twitter mr-3"></i></a>
                            <a href=""><i class="fab fa-facebook-f mr-3"></i></a>
                            <a href=""><i class="fab fa-linkedin-in mr-3"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <img class="img-thumbnail p-3" src="img/Rodri.jpg" alt="Image">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        <img class="img-thumbnail p-3" src="img/jeison.jpg" alt="Image">
                    </div>
                    <div class="col-6 text-left">
                        <h6>Jeison Jimenez </h6>
                        <h6 class="text-muted font-weight-normal text-capitalize mb-2">musica</h6>
                        <p>un viaje de mil millas comienza con un solo paso</p>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->



    <!-- Blog Start -->
    <div class="container pt-5">
        <div class="d-flex flex-column text-center mb-5">
            <h5 class="text-primary mb-3">blog reciente</h5>
            <h1 class="m-0">la voz del mudo <br> Organizado por</h1>
        </div>
        <div class="row pb-3">
            <div class="col-lg-4 mb-4">
                <div class="card mb-2 p-3">
                    <img class="card-img-top" src="img/blog-1.jpg" alt="">
                    <div class="card-body bg-secondary d-flex align-items-center p-0">
                        <h6 class="card-title text-white text-truncate m-0 ml-3">Magdy Velazco velasco</h6>
                        <a href="" class="fa fa-link d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white text-decoration-none m-0 ml-auto" style="width: 45px; height: 45px;"></a>
                    </div>
                    <div class="card-footer py-3 px-4">
                        <div class="d-flex mb-2">
                            <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small>
                            <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web Design</small>
                            <small class="mr-3"><i class="fa fa-comments text-primary"></i> 15</small>
                        </div>
                        <p class="m-0"> la mayor gloria no es vencer, sino levantarse cuando nos hemos caido </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card mb-2 p-3">
                    <img class="card-img-top" src="img/blog-2.jpg" alt="">
                    <div class="card-body bg-secondary d-flex align-items-center p-0">
                        <h6 class="card-title text-white text-truncate m-0 ml-3">Oliveros silva de alegria</h6>
                        <a href="" class="fa fa-link d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white text-decoration-none m-0 ml-auto" style="width: 45px; height: 45px;"></a>
                    </div>
                    <div class="card-footer py-3 px-4">
                        <div class="d-flex mb-2">
                            <small class="mr-3"><i class="fa fa-user text-primary"></i> Administrador</small>
                            <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web Design</small>
                            <small class="mr-3"><i class="fa fa-comments text-primary"></i> 15</small>
                        </div>
                        <p class="m-0">una mente optimista es el mejor estimulante que conoceras jamas</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card mb-2 p-3">
                    <img class="card-img-top" src="img/blog-3.jpg" alt="">
                    <div class="card-body bg-secondary d-flex align-items-center p-0">
                        <h6 class="card-title text-white text-truncate m-0 ml-3">Juan David Julio Rodriguez</h6>
                        <a href="" class="fa fa-link d-flex flex-shrink-0 align-items-center justify-content-center bg-primary text-white text-decoration-none m-0 ml-auto" style="width: 45px; height: 45px;"></a>
                    </div>
                    <div class="card-footer py-3 px-4">
                        <div class="d-flex mb-2">
                            <small class="mr-3"><i class="fa fa-user text-primary"></i> Administrador</small>
                            <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web Design</small>
                            <small class="mr-3"><i class="fa fa-comments text-primary"></i> 15</small>
                        </div>
                        <p class="m-0">estas mas que capacitado eres increible . solo tienes que confiar en ti mismo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-4 col-md-12 mb-5">
                <h1 class="mb-3 display-5 text-capitalize font-italic text-white"><span class="text-primary">DIGI</span>WORM</h1>
                <p class="m-0">Para ser exitoso, es necesario motivarte a pesar de estar experimentando uno de esos días en los que tirarías la toalla. La vida tiene sus momentos buenos y sus momentos malos, pero hay que seguir ahí, implacable, al pie del cañón intentando seguir luchando por aquello que nos hace felices.</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-primary mb-4">Digiworm</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Services</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Team</a>
                            <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-primary mb-4">Paulo VI I.E.D</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Services</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Team</a>
                            <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-primary mb-4">encuentranos a un toque</h5>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>Bogotá-Colombia</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+5731439964</p>
                        <p><i class="fa fa-envelope mr-2"></i>digiworm04@gmail.com</p>
                        <div class="d-flex justify-content-start mt-4">
                            <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="https://www.facebook.com/ColegiopauloVI/"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="https://instagram.com/digiworm.s.a?utm_source=qr&igshid=NGExMmI2YTkyZg%3D%3D"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                
            </div>
            <div class="col-md-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="https://www.educacionbogota.edu.co/portal_institucional/transparencia-politicas-lineamientos-manuales-sectoriales-institucionales">Politica de Privacidad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="https://redacademica.edu.co/terminos-y-condiciones">terminos y condiciones</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary border back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>