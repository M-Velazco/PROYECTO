<?php
session_start();
include_once "config.php";
$Email = mysqli_real_escape_string($conn, $_POST['Email']);
$Password = mysqli_real_escape_string($conn, $_POST['Pasword']);
if (!empty($Email) && !empty($Password)) {
    $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE Email = '{$Email}'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $user_pass = md5($Password);
        $enc_pass = $row['Pasword'];
        if ($user_pass === $enc_pass) {
            $status = "Disponible";
            $sql2 = mysqli_query($conn, "UPDATE usuarios SET status = '{$status}' WHERE Idusuarios = {$row['Idusuarios']}");
            if ($sql2) {
                $_SESSION['Idusuarios'] = $row['Idusuarios'];
                echo "Proceso Exitoso";
                header("Location: " . $_SERVER['HTTP_REFERER']);
            } else {
                echo "Algo salió mal. ¡Inténtalo de nuevo!";
            }
        } else {
            echo "¡Correo electrónico o la contraseña son incorrectos!";
        }
    } else {
        echo "$Email - ¡Este correo electrónico no existe!";
    }
} else {
    echo "¡Todos los campos de entrada son obligatorios!";
}
