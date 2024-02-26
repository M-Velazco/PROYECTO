<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Foro - Responder</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f0f8f7; /* Verde pastel */
    margin: 0;
    padding: 0;
}
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff; /* Blanco */
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
h1 {
    color: #333333; /* Gris oscuro */
    text-align: center;
}
form {
    margin-top: 20px;
}
textarea {
    width: 100%;
    height: 150px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #cccccc; /* Gris claro */
}
input[type="text"],
input[type="file"],
input[type="submit"] {
    margin-top: 10px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #cccccc; /* Gris claro */
    width: 100%;
}
input[type="submit"] {
    margin-top: 20px;
    background-color: #4CAF50; /* Verde */
    color: white;
    border: none;
    cursor: pointer;
}
input[type="submit"]:hover {
    background-color: #45a049; /* Verde más oscuro */
}
</style>
</head>
<body>
<div class="container">
    <h1>Responder al Foro</h1>
    <form action="procesar_respuesta.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="respuesta">Respuesta:</label><br>
        <textarea id="respuesta" name="respuesta" required></textarea><br><br>
        <label for="archivo">Adjuntar archivo:</label><br>
        <input type="file" id="archivo" name="archivo"><br><br>
        <input type="submit" value="Enviar Respuesta">
    </form>
</div>
</body>
</html>