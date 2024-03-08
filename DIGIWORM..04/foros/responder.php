<?php
// Obtener el título del foro de la URL
$titulo_foro = isset($_GET['titulo']) ? htmlspecialchars($_GET['titulo']) : '';

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $titulo = $_POST["titulo"];
    $respuesta = htmlspecialchars($_POST["respuesta"]);
    $id_usuario = $_SESSION['Idusuario'];

    // Resto del código para guardar la respuesta en la base de datos...
} else {
    // Si no se ha enviado el formulario, mostrar el formulario de respuesta
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Responder Foro</title>
        <style>
            /* Estilos CSS */
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
    <h2 style="text-align: center;">Responder Foro</h2>
    <form action="responder.php" method="post">
        Título del foro: <input type="text" name="titulo" value="<?php echo $titulo_foro; ?>" required><br><br>
        Respuesta: <textarea name="respuesta" required></textarea><br><br>
        <input type="submit" value="Enviar Respuesta">
    </form>
    </body>
    </html>
    <?php
}
?>

