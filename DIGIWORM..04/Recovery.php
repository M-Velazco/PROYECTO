<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    
</head>
<body>
    <h2>Restablecer Contraseña</h2>
    <form action="validacion/reset_password.php" method="post">
        <div>
            <label for="password">Nueva Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="confirm_password">Confirmar Nueva Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
       
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">
        <div>
            <button type="submit">Restablecer Contraseña</button>
        </div>
    </form>
</body>
</html>
