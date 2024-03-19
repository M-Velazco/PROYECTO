<?php
// Inicia la sesión
session_start();

// Verifica si el usuario está conectado
if (isset($_SESSION['Idusuario'])) {
    // Verifica si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $idForos = isset($_POST['idForos']) ? htmlspecialchars($_POST['idForos']) : '';
        $titulo = isset($_POST['Titulo']) ? htmlspecialchars($_POST['Titulo']) : '';
        $descripcion = isset($_POST['Contenido']) ? htmlspecialchars($_POST['Contenido']) : '';
        $fecha_creacion = isset($_POST['fecha_creacion']) ? htmlspecialchars($_POST['fecha_creacion']) : '';

        // Conectarse a la base de datos y actualizar los datos del foro
        $conn = new mysqli('localhost', 'root', 'sena', 'digiworm_04');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        $sql = "UPDATE foros SET Titulo = '$titulo', Contenido = '$descripcion', Fecha_Hora = '$fecha_creacion' WHERE idForos = '$idForos'";
        if ($conn->query($sql) === TRUE) {
            echo "Foro actualizado correctamente.<br>";
        } else {
            echo "Error al actualizar el foro: " . $conn->error;
        }
        $conn->close();
    } else {
        // Obtener el ID del foro a editar
        $idForos = isset($_GET['idForos']) ? htmlspecialchars($_GET['idForos']) : '';
        
        // Conectarse a la base de datos y obtener los datos del foro
        $conn = new mysqli('localhost', 'root', 'sena', 'digiworm_04');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM foros WHERE idForos = '$idForos'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $titulo = $row['Titulo'];
            $descripcion = $row['Contenido'];
            $fecha_creacion = $row['Fecha_Hora'];
            // Puedes añadir más campos según tu base de datos
        } else {
            echo "No se encontró el foro especificado.";
            exit();
        }
        $conn->close();
    }
    ?>


    <!DOCTYPE html>
    <html>
    <head>
        <title>Editar Foro</title>
        <style>
            /* Estilos CSS */
            body {
                background-color: #73cdff; /* Color de fondo verde pastel */
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-image: url('../img/coolegio.jpg');
                background-size: cover; 
                background-repeat: no-repeat; 
            }

            form {
                background-color: #fff; /* Fondo blanco */
                padding: 20px;
                border-radius: 10px;
                width: 50%;
                margin: 0 auto;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            input[type="text"],
            textarea,
            input[type="datetime-local"],
            input[type="file"],
            input[type="submit"] {
                width: 100%;
                padding: 8px;
                margin-bottom: 10px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 14px;
            }
            input[type="submit"] {
                background-color: #4caf50; /* Color de fondo verde */
                color: white;
                cursor: pointer;
                font-size: 16px;
            }
            input[type="submit"]:hover {
                background-color: #45a049; /* Cambio de color al pasar el ratón */
            }
            .boton {
                background-color: #4caf50;
                /* Color de fondo verde */
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
                position: absolute;
                top: 20px;
                left: 20px;
            }

            .boton:hover {
                background-color: #45a049;
                /* Cambio de color al pasar el ratón */
            }
        </style>
    </head>
    <body>
    <a href="javascript:history.go(-2);" class="boton">Salir</a>
        <h2 style="text-align: center;">Editar Foro</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" onsubmit="return validarFecha()">
            <input type="hidden" name="idForos" value="<?php echo $idForos; ?>">
            <label for="Titulo">Título:</label>
            <input type="text" id="Titulo" name="Titulo" value="<?php echo $titulo; ?>" required><br><br>
            <label for="Contenido">Contenido:</label>
            <textarea id="Contenido" name="Contenido" required><?php echo $descripcion; ?></textarea><br><br>
            <label for="fecha_creacion">Fecha y hora de creación:</label>
            <input type="datetime-local" id="fecha_creacion" name="fecha_creacion" value="<?php echo $fecha_creacion; ?>" required><br><br>
            <!-- Puedes añadir más campos según tu base de datos -->
            <input type="submit" name="editar_foro" value="Guardar Cambios">
        </form>

        <script>
            function validarFecha() {
                var fecha = new Date(document.getElementById("fecha_creacion").value);
                var fechaActual = new Date();
                if (fecha < fechaActual) {
                    alert("La fecha y hora de creación no puede ser anterior al día de hoy.");
                    return false;
                }
                return true;
            }
        </script>
    <?php } else {
        // Si el usuario no está conectado, redirige a la página de inicio de sesión
        header('Location: form.php?error=nologeado');
        exit();
    }
    ?>
    </body>
    </html>
