<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script
    src="https://kit.fontawesome.com/64d58efce2.js"
    crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Inicio de sesion</title>
</head>
<body>

<form action="formActualizar.php" method="post" class="update-form">
    <h2 class="title">Actualizar Datos de Usuario</h2>
    <div class="input-field">
        <i class="fa-solid fa-id-card"></i>
        <input type="int" id="Idusuario" name="Idusuario" placeholder="Numero Identificacion" required />
    </div>
    
    

    <div>
        <input type="checkbox" /><a href="#" class="href"> <span class="rules-text">"Acepto los términos de servicio"</a></span>
    </div>
    <input type="submit" class="btn" value="Actualizar Datos" />
</form>
</body>
</html>
