<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style04.css" />
    <title>Inicio de sesion</title>

</head>

<body>
<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <form action="validacion/validarInicioSesion.php" method="post" class="sign-in-form">
                <h2 class="title">Iniciar sesión</h2>

                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="number" id="Idusuario" name="Idusuario" placeholder="Número Identificación" required oninput="limitarNumero(this, 10)" />

                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="Contraseña" name="Contraseña" placeholder="Contraseña" />

                </div>
                <a href="Restablecer_Contraseña.html" class="href" id="forgotPassword">
    Olvidé mi contraseña

</a>
<script>
    // Obtener el elemento del enlace
    var forgotPasswordLink = document.getElementById("forgotPassword");

    // Agregar un evento de clic al enlace
    forgotPasswordLink.addEventListener("click", function(event) {
        // Prevenir el comportamiento predeterminado del enlace
        event.preventDefault();

        // Redirigir al usuario a la URL especificada
        window.location.href = "Restablecer_Contraseña.html";
    });
</script>



                <input type="submit" value="Ingresar" class="btn solid" />

            </form>
            <form action="validacion/validarRegistroUsuario.php" method="post" class="sign-up-form"enctype="multipart/form-data">
                <h2 class="title">Registrarse</h2>
                <div class="input-field">
                    <i class="fa-solid fa-id-card"></i>
                    <input type="number" id="Idusuario" name="Idusuario" placeholder="Número Identificación" required oninput="limitarNumero(this, 10)" onblur="validarLongitudExacta(this)" onfocus="registrarUltimoCampoModificado(this)" />


                </div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" id="Nombres" name="Nombres" placeholder="Nombres " required oninput="this.value = this.value.replace(/[0-9]/g, '');"/>
                </div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" id="Apellidos" name="Apellidos" placeholder="Apellidos " required oninput="this.value = this.value.replace(/[0-9]/g, '');"/>
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="Email" name="Email"placeholder="Correo electronico" required pattern="[a-zA-Z0-9._%+-]+@(gmail\.com|outlook\.com|hotmail\.com)" />

                </div>
                <div class="input-field">
                    <i class="fas fa-phone"></i>
                    <input type="number" name="Telefono" id="Telefono" placeholder="Telefono" required  required oninput="limitarNumero(this, 10)" onblur="validarLongitudExacta(this)" />
                </div>
                <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" id="Pasword" name="Pasword" placeholder="Contraseña" required />

        </div>
        <div id="passwordError" class="error">La contraseña debe tener al menos 8 caracteres y contener números, letras y signos especiales.</div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="file" id="img" name="img" placeholder="img" required />
                </div>
                <script>
                    // Validación de la contraseña en tiempo real
                    document.addEventListener('DOMContentLoaded', (event) => {
    // Validación de la contraseña en tiempo real
    function validarContrasena(Password) {
        const passwordError = document.getElementById('passwordError');
        const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (!passwordPattern.test(Pasword)) {
            passwordError.style.display = 'block';
        } else {
            passwordError.style.display = 'none';
        }
    }

    // Evento de entrada para el campo de contraseña
    document.getElementById('Pasword').addEventListener('input', function () {
        validarContrasena(this.value);
    });
});

                </script>
                <script>
// Variable para almacenar el último campo modificado
let ultimoCampoModificado = null;

// Función para limitar la cantidad de dígitos y validar la longitud exacta al cambiar de campo
function limitarNumero(input, maxLength) {
    let inputValue = input.value.trim(); // Elimina espacios en blanco al inicio y al final

    if (inputValue.length > maxLength) {
        input.value = input.value.slice(0, maxLength); // Limita el valor a los primeros maxLength caracteres
    }
}

// Función para validar la longitud exacta al cambiar de campo
function validarLongitudExacta(input) {
    let inputValue = input.value.trim(); // Elimina espacios en blanco al inicio y al final

    if (input.id === "Idusuario" || input.id === "Telefono") {
        if (inputValue.length !== 10) {
            alert("El campo " + input.placeholder + " debe tener 10 dígitos.");
        }
    }
}

// Manejador de evento para registrar el último campo modificado
function registrarUltimoCampoModificado(input) {
    ultimoCampoModificado = input.id;
}
</script>





<style>
        .error {
            color: red;
            display: none;
        }
        /* Estilos personalizados */
        .input-field.custom {
            border: 2px solid transparent;
            border-radius: 25px;
            padding: 20px;
            text-align: center;
            display: inline-block;
            position: relative;
            height: 200px;
            font-style: oblique;
        }
        .input-radio {
            display: grid;
            grid-template-columns: 8fr 5fr;
            gap: 28px;
            align-items: center;
            justify-items: center;
            align-content: center;
            justify-content: center;
            position: absolute;
            top: 46%;
            left: 13%;
            transform: translate(-17%, -30%);
            font-style: oblique;
        }
        .input-radio label {
            margin-left: 5px;
        }
        .input-radio input[type="radio"] {
            margin-right: 5px;
        }
        .input-field.custom::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff; /* Color del fondo */
            z-index: -1;
            border-radius: 8px;
        }
        .hidden {
            display: none;
        }
    </style>

<div class="input-field custom hidden"style= "display:block;">
    <label for="Rol" id="roles" style="padding-bottom: 10px;"> SELECCIONE SU ROL</label>
    <div class="input-radio">
        <div style="display: flex; flex-direction: column;">
            <input type="radio" id="Usuario" name="Rol" value="usuario" checked>
            <label for="Usuario">Usuario</label>
        </div>
        <div style="display: none; flex-direction: column;">
            <input type="radio" id="Docente" name="Rol" value="Docente">
            <label for="Docente">Docente</label>
        </div>
        <div style="display: flex; flex-direction: column;">
            <input type="radio" id="Estudiante" name="Rol" value="Estudiante">
            <label for="Estudiante">Estudiante</label>
        </div>
        <div style="display: flex; flex-direction: column;">
            <input type="radio" id="Padre de Familia" name="Rol" value="Padre_Familia">
            <label for="Padre de Familia">Padre de Familia</label>
        </div>
        <div style="display: none; flex-direction: column;">
            <input type="radio" id="Coordinador" name="Rol" value="Coordinador">
            <label for="Coordinador">Coordinador</label>
        </div>
    </div>
</div>



                <div class="input-field" id="curso_field" style="display:none;">
                    <i class="fas fa-graduation-cap"></i>
                    <select id="Curso" name="Curso">
                        <option value=""></option>
                        <?php
                        // Conexión a la base de datos y consulta de las materias
                        $conexion = new mysqli("localhost", "root", "sena", "digiworm_04");
                        if ($conexion->connect_error) {
                            die("Error de conexión: " . $conexion->connect_error);
                        }
                        $consulta = $conexion->query("SELECT  idCurso, Nombre_curso, Estado FROM curso");

                        // Generar las opciones del select
                        while ($fila = $consulta->fetch_assoc()) {
                            echo "<option value='" . $fila['idCurso'] . "'>" . $fila['Nombre_curso'] . "</option>";
                        }
                        // Cerrar la conexión
                        $conexion->close();
                        ?>
                    </select>
                </div>

                <div class="input-field" id="materia_field" style="display:none;">
                    <i class="fas fa-book"></i>
                    <select id="Materia" name="Materia">
                        <option value=""></option>
                        <?php
                        // Conexión a la base de datos y consulta de las materias
                        $conexion = new mysqli("localhost", "root", "sena", "digiworm_04");
                        if ($conexion->connect_error) {
                            die("Error de conexión: " . $conexion->connect_error);
                        }
                        $consulta = $conexion->query("SELECT  idMaterias, Nombre_Materia FROM materias");

                        // Generar las opciones del select
                        while ($fila = $consulta->fetch_assoc()) {
                            echo "<option value='" . $fila['idMaterias'] . "'>" . $fila['Nombre_Materia'] . "</option>";
                        }
                        // Cerrar la conexión
                        $conexion->close();
                        ?>
                    </select>
                </div>

                <div class="input-field" id="estado" style="display:none;">
    <label for="Estado">Estado</label>
    <select id="Estado" name="Estado">
        <option value=""></option>
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
    </select>
</div>



<div class="input-field" id="jornada_field" style="display:none;">
    <i class="fas fa-clock"></i>
    <select id="Jornada" name="Jornada">
        <option value=""></option>
        <option value="mañana">Mañana</option>
        <option value="tarde">Tarde</option>
    </select>
</div>


                <div>
                    <input type="checkbox"required/><a href="#" class="href"> <span class="rules-text">"Acepto los términos de servicio"</a></span>
                </div>
<br>
                <input type="submit" class="btn" value="Registro completo"/>

            </form>
            <script>
    document.addEventListener("DOMContentLoaded", function() {
        var radioButtons = document.querySelectorAll('input[name="Rol"]');
        var cursoField = document.getElementById('curso_field');
        var materiaField = document.getElementById('materia_field');
        var estadoField = document.getElementById('estado');
        var jornadaField = document.getElementById('jornada_field');

        // Escuchar el cambio en los radios de opción de rol
        radioButtons.forEach(function(radioButton) {
            radioButton.addEventListener('change', function() {
                // Mostrar u ocultar campos según el rol seleccionado
                if (this.value === 'Docente') {
                    cursoField.style.display = 'none';
                    materiaField.style.display = 'none';
                    estadoField.style.display = 'none'; // Mostrar el campo de estado
                    jornadaField.style.display = 'none'; // Ocultar el campo de jornada
                } else if (this.value === 'Estudiante') {
                    cursoField.style.display = 'none'; // Mostrar el campo de curso
                    materiaField.style.display = 'none'; // Ocultar el campo de materia
                    estadoField.style.display = 'none'; // Ocultar el campo de estado
                    jornadaField.style.display = 'none'; // Ocultar el campo de jornada
                } else if (this.value === 'Coordinador') {
                    cursoField.style.display = 'none';
                    materiaField.style.display = 'none';
                    estadoField.style.display = 'none'; // Mostrar el campo de estado
                    jornadaField.style.display = 'none'; // Mostrar el campo de jornada
                } else {
                    cursoField.style.display = 'none';
                    materiaField.style.display = 'none';
                    estadoField.style.display = 'none'; // Mostrar el campo de estado
                    jornadaField.style.display = 'none'; // Ocultar el campo de jornada
                }
            });
        });
    });
</script>
<?php
if (isset($_GET['error']) && $_GET['error'] == 'nologeado') {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>"; // Incluye SweetAlert desde CDN

    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al ingresar usuario no logeado',
                    text: 'Usuario no logeado. Por favor, inicie sesion.'
                });
            });
          </script>";
}
?>
<?php
if (isset($_GET['error']) && $_GET['error'] == 'usuario_no_encontrado') {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>"; // Incluye SweetAlert desde CDN

    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de inicio de sesión',
                    text: 'Usuario no encontrado. Por favor, verifica tus credenciales e intenta nuevamente.'
                });
            });
          </script>";
}
?>
<?php
if (isset($_GET['error']) && $_GET['error'] == 'campo_incompleto') {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>"; // Incluye SweetAlert desde CDN

    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de inicio de sesión',
                    text: 'Usuario no encontrado. Por favor, verifica tus credenciales e intenta nuevamente.'
                });
            });
          </script>";
}
?>
<?php
if (isset($_GET['error']) && $_GET['error'] == 'usuario_inactivo') {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>"; // Incluye SweetAlert desde CDN

    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: '!oops',
                    text: 'Lo sentimos, El usuario se encuentra inactivo porfavor comunicate con las directivas para solucionarlo'
                });
            });
          </script>";
}
?>



        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>No tienes una cuenta?</h3>
                <p>
                    Después de registrarse, puede aprovechar de los servicios de la institucion educativa.
                </p>
                <button class="btn transparent" id="sign-up-btn">
                    Registro
                </button>
            </div>

        </div>
        <div class="panel right-panel">
            <div class="content">
                <h3>¿Tiene usted una cuenta?</h3>
                <p>
                    Debe iniciar sesión para conocer mas de nosotros..
                </p>
                <button class="btn transparent" id="sign-in-btn">
                    Ingresar
                </button>
            </div>

        </div>
    </div>
</div>
<script src="js\main04.js"></script>
</body>
</html>