<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap">
	<link rel="stylesheet" href="css/recovery_contraseña.css">
</head>
<body>
    <section>
        <!-- Puedes mantener el formulario aquí -->
        <h2>Restablecer Contraseña</h2>
        <form action="validacion/reset_password.php" method="post" class="form">
            <div class="inputBox">
                <label for="password">Nueva Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="inputBox">
                <label for="confirm_password">Confirmar Nueva Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
           
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">
            <div class="inputBox">
              <h1><input type="submit" value="Restablecer Contraseña"></h1>  
            </div>
        </form>
    </section>
</body>
</html>
