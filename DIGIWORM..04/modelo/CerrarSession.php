<?php
// Inicia la sesión
session_start();

// Cierra la sesión si el usuario ha iniciado sesión
if (isset($_SESSION['Idusuario'])) {
    // Elimina todas las variables de sesión
    session_unset();

    // Destruye la sesión
    session_destroy();

    // Redirige a la página de inicio de sesión u otra página deseada
    header("Location: ../index.html");
    exit();
} else {
    // Si el usuario no ha iniciado sesión, simplemente redirige a la página de inicio de sesión
    header("Location: ../form.php");
    exit();
}
?>
