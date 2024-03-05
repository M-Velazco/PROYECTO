<!DOCTYPE html>
<html>
<head>
    <title>Responder Foro</title>
    <style>
        body {
            background-img:url("img/header.png");
            background-color: #73B0FF; /* Color de fondo verde pastel */
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
    
        }
        form {
            background-color: #fff; /* Fondo blanco */
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            margin: 0 auto;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="file"] {
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background-color: #4caf50; /* Color de fondo verde */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049; /* Cambio de color al pasar el ratón */
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Responder Foro</h2>
    <form action="responder.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_foro" value=>
        Respuesta: <textarea name="respuesta" required></textarea><br><br>
        Archivos adjuntos (opcional): <input type="file" name="archivos[]" multiple><br><br>
        <input type="submit" value="Enviar Respuesta">
    </form>
</body>
</html>
