<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ea; /* Verde pastel */
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h3 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50; /* Verde */
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .respuesta {
            margin-left: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-left: 3px solid #4CAF50; /* Verde */
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Foro</h1>
        <!-- Formulario para crear un nuevo foro -->
        <form action="crear_foro.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="titulo" placeholder="Título" required>
            <textarea name="contenido" placeholder="Contenido" required></textarea>
            <input type="file" name="archivo">
            <input type="submit" value="Crear foro">
        </form>

        <!-- Lista de foros -->
        <h2>Foros</h2>
        <div class="foros">
            <!-- Aquí se mostrarán los foros -->
        </div>
    </div>
</body>
</html>