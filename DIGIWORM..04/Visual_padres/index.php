
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
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        /* Estilos adicionales para la tabla y el contenido */
        table.student-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table.student-table th,
        table.student-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table.student-table th {
            background-color: #f8f9fa;
        }

        .content {
            margin-top: 20px;
        }

        #modifyButton {
            text-align: left;
            margin-top: 20px;
            display: none;
        }

        #modifyButton button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <header>
        <div class="logo">
            <img src="imagenes\LOGO.png" alt="Logo">
            <h3><a href="../index04.php"  class="principal-link">Principal</a></h3>
        </div>

        <h1>Bienvenido Padre de Familia</h1>
        <p><h2>Consulte aqui los datos personales del Estudiante</h2></p>
    </header>


    <div class="navbar">
        <div class="search-bar">
            <form id="searchForm" method="post" action="index.php" onsubmit="return validarFormulario()">
                <div class="search-container">
                    <input type="text" name="idEstudiante" id="idEstudiante" placeholder="Ingrese Numero de Identificacion" oninput="validarInput(this)" required>
                    <i class="fas fa-search" onclick="realizarBusqueda();"></i>
                </div>
            </form>
        </div>
    </div>

    <!-- Aquí se mostrará la información del estudiante -->
    <div class="content">
        <?php


        $conn = Conectarse();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idEstudiante"])) {
            $idEstudiante = $_POST["idEstudiante"];

            if (!is_numeric($idEstudiante)) {
                echo "<div class='error-message'>Error: La búsqueda solo permite números.</div>";
                exit();
            }

            // Realiza la búsqueda en la tabla 'estudiante'
            // Ejecuta el primer query para obtener la información del estudiante
$sqlEstudiante = "SELECT * FROM estudiante WHERE idEstudiante = $idEstudiante";
$resultEstudiante = $conn->query($sqlEstudiante);

// Verifica si se encontraron resultados en la tabla 'estudiante'
if ($resultEstudiante->num_rows > 0) {
    echo "<h2 style='margin-left: 20px;'>Información del Estudiante</h2>";
    echo "<table class='student-table'>";

    // Obtiene la fila del primer query (información del estudiante)
    $rowEstudiante = $resultEstudiante->fetch_assoc();

    // Muestra la información del estudiante
    echo "<tr><td>ID:</td><td>" . $rowEstudiante["idEstudiante"] . "</td></tr>";
    echo "<tr><td>Nombres:</td><td>" . $rowEstudiante["Nombres"] . "</td></tr>";
    echo "<tr><td>Apellidos:</td><td>" . $rowEstudiante["Apellidos"] . "</td></tr>";
    echo "<tr><td>Email:</td><td>" . $rowEstudiante["Email"] . "</td></tr>";

    // Ejecuta el segundo query para obtener el nombre del curso del estudiante
    $sqlCurso = "SELECT curso.Nombre_curso FROM curso INNER JOIN estudiante ON curso.idCurso = estudiante.Curso WHERE idEstudiante = $idEstudiante";
    $resultCurso = $conn->query($sqlCurso);

    // Verifica si se encontraron resultados en la tabla 'curso' mediante la consulta JOIN
    if ($resultCurso->num_rows > 0) {
        // Obtiene la fila del segundo query (nombre del curso)
        $rowCurso = $resultCurso->fetch_assoc();
        echo "<tr><td>Curso:</td><td>" . $rowCurso["Nombre_curso"] . "</td></tr>";
    } else {
        echo "<tr><td>Curso:</td><td>No encontrado</td></tr>";
    }

    echo "<tr><td>Estado:</td><td>" . $rowEstudiante["Estado"] . "</td></tr>";

    // Obtiene el rol del estudiante desde la tabla 'usuarios'
    $sqlUsuarios = "SELECT Rol FROM usuarios WHERE Idusuarios = " . $rowEstudiante["idEstudiante"];
    $resultUsuarios = $conn->query($sqlUsuarios);

    // Verifica si se encontraron resultados en la tabla 'usuarios'
    // Aquí puedes continuar con el procesamiento de los resultados de $resultUsuarios si es necesario
} else {
    // Manejo de caso cuando no se encuentran resultados en el primer query
    echo "No se encontraron resultados para el estudiante.";
}


                echo "</table>";

                if ($rol_usuario == 'administrador'||$rol_usuario == 'Coordinador' || $rol_usuario =='Docente') {
                    echo "<div id='modifyButton'>";
                echo "<button onclick='modificarEstudiante($idEstudiante)'>Modificar</button>";
                echo "</div>";
                }else{}
            } else {
                echo "<p style='margin: 0 auto; text-align: center; width: 50%;'>No se encontró ningún estudiante con ese ID.</p>";
            }

            $conn->close();
        
        ?>
    </div>

    <script>
        function validarInput(input) {
            // Eliminar caracteres no numéricos del input
            input.value = input.value.replace(/\D/g, '');
        }

        function realizarBusqueda() {
            var idEstudiante = document.getElementById('idEstudiante').value;

            if (idEstudiante.trim() === "") {
                alert("Por favor, ingrese un ID de estudiante válido.");
                return false;
            }

            if (!/^\d+$/.test(idEstudiante)) {
                alert("El ID de estudiante debe contener solo números.");
                return false;
            }

            document.getElementById('searchForm').submit();
        }

        function modificarEstudiante(idEstudiante) {
            // Redirigir a la página de modificación con el ID del estudiante
            window.location.href = "modificar.php?id=" + idEstudiante;
        }

        // Función para mostrar el botón de modificar cuando se encuentra la información del estudiante
        window.onload = function() {
            var modifyButton = document.getElementById('modifyButton');
            if (modifyButton) {
                modifyButton.style.display = 'block';
            }
        };
    </script>

</body>

</html>