<?php
require ( "../ctrlDocentes/modeloDocentes/Docentes.php");
require "../ctrlDocentes/modeloDocentes/conexion.php";

	
extract ($_REQUEST);
if (!isset($_REQUEST['x']))
	$_REQUEST['x']=0;

$objConexion=Conectarse();
$objDocentes = new Docentes();

$resultado=$objDocentes->consultarDocentes();
$docente=$resultado;

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
    <link href="img/image__1_-removebg-preview (1).png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    
    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="Publicaciones.html" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-primary"><span class="text-dark">DIGI</span> WORM</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav m-auto py-0">
                    <a href="Publicaciones.html" class="nav-item nav-link active">Publicaciones</a>
                    <div class="nav-item dropdown">
                    <a href="Docentes.html" class="nav-link dropdown-toggle" data-toggle="dropdown">Docentes</a>
                    <div class="dropdown-menu rounded-0 m-0">
                            <a href="../CtrlDocentes/frmagregarDocente.php" class="dropdown-item">Agregar Docente</a>
                            <a href="../CtrlDocentes/listarDocente.php" class="dropdown-item">Listar Docentes</a>
                            <a href="../CtrlDocentes/Docentes_id_act.php" class="dropdown-item">Actualizar Docente</a>
                            <a href="../CtrlDocentes/Docentes_id_eliminar.php" class="dropdown-item">Eliminar Docente</a>
                            </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Paginas</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="appointment.html" class="dropdown-item">Información</a>
                            <a href="opening.html" class="dropdown-item">Notas</a>
                            <a href="team.html" class="dropdown-item">Boletines</a>
                            <a href="testimonial.html" class="dropdown-item">Chats</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Información</a>
                    
                </div>
               
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid bg-jumbotron" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h3 class="text-white display-3 mb-4">Docentes</h3>
            
        </div>
    </div>
    <!-- Header End -->


    <!-- Service Start -->
    <div class="container-fluid px-0 py-5 my-5">
        <div class="row mx-0 justify-content-center text-center">
            <div class="col-lg-6">
                <h6 class="d-inline-block bg-light text-primary text-uppercase py-1 px-2">Conocenos</h6>
                <h1>Docentes</h1>
            </div>
        </div>
        <div class="owl-carousel service-carousel">
           
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/astro.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Vilma Barrios</h4>
                    <p class="text-white px-3 mb-3">Dios mio paciencia</p>
                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="../CtrlDocentes/validarDocenteGet.php?iddocente=1054115102">Consultar</a>
                    </div>
                </div>
            </div>
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/astro.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Pablo Piedrahita</h4>
                    <p class="text-white px-3 mb-3">La educación es lo que queda después de que uno olvida lo que ha aprendido en la escuela</p>
                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="../CtrlDocentes/validarDocenteGet.php?iddocente=1057030024">Consultar</a>
                    </div>
                </div>
            </div>
            
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/astro.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">didier orozco</h4>
                    <p class="text-white px-3 mb-3">La educación es lo que queda después de que uno olvida lo que ha aprendido en la escuela</p>
                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="../CtrlDocentes/validarDocenteGet.php?iddocente=142223657">Consultar</a>
                    </div>
                </div>
            </div>
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/astro.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Aurelio Rivas Renteria</h4>
                    <p class="text-white px-3 mb-3">La educación es lo que queda después de que uno olvida lo que ha aprendido en la escuela</p>
                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="../CtrlDocentes/validarDocenteGet.php?iddocente=1025538177">Consultar</a>
                    </div>
                </div>
            </div>
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/astro.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Jeison Villanueva</h4>
                    <p class="text-white px-3 mb-3">La educación es lo que queda después de que uno olvida lo que ha aprendido en la escuela</p>
                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="../CtrlDocentes/validarDocenteGet.php?iddocente=1023537206">Consultar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center bg-appointment mx-0">
            <div class="col-lg-6 py-5">
                <div class="p-5 my-5" style="background: rgba(33, 30, 28, 0.7);">
                    <h1 class="text-white text-center mb-4">Tus Opiniones son Importantes para Nosotros</h1>
                    <form>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control bg-transparent p-4" placeholder="Nombre" required="required" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="email" class="form-control bg-transparent p-4" placeholder="Email" required="required" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="text" class="form-control bg-transparent p-4 datetimepicker-input" placeholder="Datos" data-target="#date" data-toggle="datetimepicker"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="time" id="time" data-target-input="nearest">
                                        <input type="text" class="form-control bg-transparent p-4 datetimepicker-input" placeholder="Asunto" data-target="#time" data-toggle="datetimepicker"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="custom-select bg-transparent px-4" style="height: 47px;">
                                        <option selected>Selecciona el servicio</option>
                                        <option value="1">Ayuda</option>
                                        <option value="2">Soporte</option>
                                        <option value="3">Dudas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-primary btn-block" type="submit" style="height: 47px;">Enviar Aporte</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 pb-5 pb-lg-0">
                    <img class="img-fluid w-100" src="img/educa.jpg" alt="">
                </div>
                <div class="col-lg-6">
                    <h6 class="d-inline-block text-primary text-uppercase bg-light py-1 px-2">Testimonios</h6>
                    <h1 class="mb-4">Conocenos</h1>
                    <div class="owl-carousel testimonial-carousel">
                        <div class="position-relative">
                            <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                            <div class="d-flex align-items-center mb-3">
                                <img class="img-fluid rounded-circle" src="img/ellos.jpg" style="width: 60px; height: 60px;" alt="">
                                <div class="ml-3">
                                    <h6 class="text-uppercase">Nombres</h6>
                                    <span>Profession</span>
                                </div>
                            </div>
                            <p class="m-0">La educación es lo que queda después de que uno olvida lo que ha aprendido en la escuela</p>
                        </div>
                        <div class="position-relative">
                            <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                            <div class="d-flex align-items-center mb-3">
                                <img class="img-fluid rounded-circle" src="img/elegante.jpg" style="width: 60px; height: 60px;" alt="">
                                <div class="ml-3">
                                    <h6 class="text-uppercase">Usuario</h6>
                                    <span>Profession</span>
                                </div>
                            </div>
                            <p class="m-0">Es imposible educar niños al por mayor; la escuela no puede ser el sustituto para la educación individual.</p>
                        </div>
                        <div class="position-relative">
                            <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                            <div class="d-flex align-items-center mb-3">
                                <img class="img-fluid rounded-circle" src="img/xd.jpg" style="width: 60px; height: 60px;" alt="">
                                <div class="ml-3">
                                    <h6 class="text-uppercase">Usuario</h6>
                                    <span>Profession</span>
                                </div>
                            </div>
                            <p class="m-0">La educación es lo que queda después de que uno olvida lo que ha aprendido en la escuela</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="footer container-fluid position-relative bg-dark py-5" style="margin-top: 90px;">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6 pr-lg-5 mb-5">
                    <a href="index.html" class="navbar-brand">
                        <h1 class="mb-3 text-white"><span class="text-primary">DIGI</span> WORM</h1>
                    </a>
                    <p>El día más importante de la educación de una persona es el primer día de escuela, no el día de su graduación..</p>
                    <p><i class="fa fa-map-marker-alt mr-2"></i>Kennedy,Bogota,Colombia</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+153143996415</p>
                    <p><i class="fa fa-envelope mr-2"></i>digiworm04@gmail.com</p>
                    <div class="d-flex justify-content-start mt-4">
                        <a class="btn btn-lg btn-primary btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square" href="https://instagram.com/digiworm.s.a?igshid=NGExMmI2YTkyZg=="><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 pl-lg-5">
                    <div class="row">
                        <div class="col-sm-6 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Cualidades</h5>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Insistir</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Persistir</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Y</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Nunca</a>
                                <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Desistir</a>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Servicios</h5>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Crece</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Vive</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Inspira</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Crea</a>
                                <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Superate</a>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Mensaje</h5>
                            <div class="w-100">
                                <div class="input-group">
                                    <input type="text" class="form-control border-light" style="padding: 30px;" placeholder="Envia Tu Mensaje">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary px-4">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light border-top py-4" style="border-color: rgba(256, 256, 256, .15) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    <p class="m-0 text-white">&copy; <a href="#">TERMINOS</a> Y CONDICIONES.</p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <p class="m-0 text-white">DIGIWORM <a href="https://htmlcodex.com">DIGIWORM</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>