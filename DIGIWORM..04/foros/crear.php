<!DOCTYPE html>
<html>
<head>
    <title>Crear Foro</title>
    <style>
        body {
            background-color: #f0f8f7; /* Color de fondo verde pastel */
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
        input[type="text"],
        textarea,
        input[type="datetime-local"] {
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

    <h2 style="text-align: center;">Crear Foro</h2>
    <form action="crear.php" method="post" enctype="multipart/form-data">
        Título: <input type="text" name="titulo" required><br><br>
        Descripción: <textarea name="descripcion" required></textarea><br><br>
        Fecha y hora de creación: <input type="datetime-local" name="fecha_creacion" required><br><br>
        Archivos adjuntos (opcional): <input type="file" name="archivos[]" multiple><br><br>
        <input type="submit" value="Crear Foro">
    </form>
</body>
</html>