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

        table.student-table th, table.student-table td {
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
    </style>
</head>

<body>

    <header>
        <div class="logo">
            <img src="imagenes\LOGO.png" alt="Logo">
            <a href="principal.php" class="principal-link">Principal</a>
        </div>
        <h1>Bienvenido</h1>
        <p>Información importante para padres de familia</p>
    </header>

    <div class="navbar">
        <div class="search-bar">
            <form id="searchForm" method="post" action="index.php" onsubmit="return validarFormulario()">
                <div class="search-container">
                    <input type="text" name="idEstudiante" id="idEstudiante" placeholder="Buscar por ID" oninput="validarInput(this)" required>
                    <i class="fas fa-search" onclick="realizarBusqueda();"></i>
                </div>
            </form>
        </div>
    </div>

    <!-- Aquí se mostrará la información del estudiante -->
    <div class="content">
        <?php
        include 'conexion.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idEstudiante"])) {
            $idEstudiante = $_POST["idEstudiante"];

            if (!is_numeric($idEstudiante)) {
                echo "<div class='error-message'>Error: La búsqueda solo permite números.</div>";
                exit();
            }

            // Realiza la búsqueda en la tabla 'estudiante'
            $sqlEstudiante = "SELECT * FROM estudiante WHERE idEstudiante = $idEstudiante";
            $resultEstudiante = $conn->query($sqlEstudiante);

            // Verifica si se encontraron resultados en la tabla 'estudiante'
            if ($resultEstudiante->num_rows > 0) {
                echo "<h2 style='margin-left: 20px;'>Información del Estudiante</h2>";                
                echo "<table class='student-table'>";

                // Muestra la información del estudiante
                while ($rowEstudiante = $resultEstudiante->fetch_assoc()) {
                    echo "<tr><td>ID:</td><td>" . $rowEstudiante["idEstudiante"] . "</td></tr>";
                    echo "<tr><td>Nombres:</td><td>" . $rowEstudiante["Nombres"] . "</td></tr>";
                    echo "<tr><td>Apellidos:</td><td>" . $rowEstudiante["Apellidos"] . "</td></tr>";
                    echo "<tr><td>Email:</td><td>" . $rowEstudiante["Email"] . "</td></tr>";
                    echo "<tr><td>Curso:</td><td>" . $rowEstudiante["Curso"] . "</td></tr>";
                    echo "<tr><td>Estado:</td><td>" . $rowEstudiante["Estado"] . "</td></tr>";

                    // Obtiene el rol del estudiante desde la tabla 'usuarios'
                    $sqlUsuarios = "SELECT Rol FROM usuarios WHERE Idusuarios = " . $rowEstudiante["idEstudiante"];
                    $resultUsuarios = $conn->query($sqlUsuarios);

                    // Verifica si se encontraron resultados en la tabla 'usuarios'
                    if ($resultUsuarios->num_rows > 0) {
                        $rowUsuarios = $resultUsuarios->fetch_assoc();
                        echo "<tr><td>Rol:</td><td>" . $rowUsuarios["Rol"] . "</td></tr>";
                    }
                }

                echo "</table>";
            } else {
                echo "<p style='margin: 0 auto; text-align: center; width: 50%;'>No se encontró ningún estudiante con ese ID.</p>";
            }

            $conn->close();
        }
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
                alert("Es necesario llenar el campo de búsqueda.");
                return false;
            }

            if (!/^\d+$/.test(idEstudiante)) {
                alert("La búsqueda solo permite números.");
                return false;
            }

            document.getElementById('searchForm').submit();
        }
    </script>

</body>

