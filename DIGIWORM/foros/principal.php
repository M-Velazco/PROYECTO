<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Página Principal de Foros</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f0f8ea; /* Color verde pastel */
    }
    .forum {
        margin-bottom: 20px;
        padding: 10px;
        background-color: #d1ecd8; /* Color verde pastel más claro */
    }
    .forum a.button {
        text-decoration: none;
        color: #fff;
        background-color: #579d66; /* Color verde más oscuro */
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }
    .forum a.button:hover {
        background-color: #7eb689; /* Color verde más claro al pasar el mouse */
    }
    .add-forum {
        margin-top: 20px;
    }
    .add-forum a.button {
        text-decoration: none;
        color: #fff;
        background-color: #579d66; /* Color verde más oscuro */
        padding: 10px 20px;
        border-radius: 5px;
    }
    .add-forum a.button:hover {
        background-color: #7eb689; /* Color verde más claro al pasar el mouse */
    }
</style>
</head>
<body>
<h1>Foros</h1>
<div class="forum">
    <h2>Foro 1</h2>
    <p>Descripción del Foro 1</p>
    <a href="responder.php" class="button">Ir al Foro 1</a>
</div>
<div class="forum">
    <h2>Foro 2</h2>
    <p>Descripción del Foro 2</p>
    <a href="" class="button">Ir al Foro 2</a>
</div>
<div class="add-forum">
    <a href="index.php" class="button">Agregar Foro</a>
</div>
<div class="add-forum">
    <a href="nueva-principal.php" class="button">Nueva Página Principal</a>
</div>
</body>
</html>