<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Agregamos SweetAlert -->
    <link rel="stylesheet" href="css/Datos.css" />
</head>
<body>
<?php 
if (isset($_GET['success']) && $_GET['success'] == 'actualizado') {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>"; // Incluye SweetAlert desde CDN

    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Actualización exitosa',
                    text: 'Los datos del usuario se han actualizado correctamente',
                    showConfirmButton: false,
                    timer: 2000 // Muestra el mensaje por 2 segundos antes de redirigir
                })
            });
          </script>";
}
?>

<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['Idusuario'])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no ha iniciado sesión
    exit();
}

require_once "modelo/USUARIO.php";
require_once "modelo/conexion.php";
$objConexion = Conectarse();
$objUsuarios = new Usuario($objConexion);

// Obtiene el nombre del usuario basado en su ID
$nombre_usuario = $objUsuarios->obtenerNombreUsuario($_SESSION['Idusuario']);

// Obtiene la ruta de la imagen de perfil del usuario
$ruta_imagen = $objUsuarios->obtenerRutaImagenUsuario($_SESSION['Idusuario']);
$rol_usuario = $objUsuarios->obtenerRolUsuario($_SESSION['Idusuario']);
$idUsuario = $_SESSION['Idusuario'];

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "sena", "digiworm_04");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener los datos del usuario
$sql = "SELECT * FROM usuarios WHERE Idusuarios = $idUsuario";
$resultado = $conexion->query($sql);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Obtener los datos del usuario
    $fila = $resultado->fetch_assoc();
    $nombres = $fila['Nombres'];
    $apellidos = $fila['Apellidos'];
    $email = $fila['Email'];
    $telefono = $fila['Telefono'];
    $password = $fila['Pasword'];
    $img = $fila['img'];
    $rol = $fila['Rol'];
    $estado = $fila['Estado'];

    // Mostrar los datos del usuario en un formulario
    echo "<h1>Datos del Usuario</h1>"; ?>



    <div class="container">
        <form action="./validacion/actualizar_datos.php" method="POST" enctype="multipart/form-data">
            <div class="img-container">
                <img src="<?php echo $ruta_imagen; ?>" onclick="document.getElementById('imagen').click();" id="preview-image">
                <i class="fas fa-camera camera-icon" onclick="document.getElementById('imagen').click();"></i>
                <input type="file" name="img" id="imagen" accept="image/*" onchange="previewImage()">
            </div>
            Nombres: <input type="text" name="nombres" value="<?php echo $nombres; ?>" readonly class="readonly-input"><br>
            Apellidos: <input type="text" name="apellidos" value="<?php echo $apellidos; ?>"readonly class="readonly-input"><br>
            Email: <input type="text" name="email" value="<?php echo $email; ?>"><br>
            Teléfono: <input type="text" name="telefono" value="<?php echo $telefono; ?>"><br>
            Contraseña: <input type="password" name="password" value="<?php echo $password; ?>" onclick="mostrarSweetAlert()"><br> <!-- Agregamos onclick -->
            Rol: <input type="text" name="rol" value="<?php echo $rol; ?>"readonly class="readonly-input"><br>
            Estado: <input type="text" name="estado" value="<?php echo $estado; ?>"readonly class="readonly-input"><br>
            <input type="submit" value="Actualizar">
        </form>
    </div>

    <script>
        function previewImage() {
            const preview = document.getElementById('preview-image');
            const file = document.getElementById('imagen').files[0];
            const reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "<?php echo $ruta_imagen; ?>";
            }
        }

        function mostrarSweetAlert() {
            Swal.fire({
                title: '¿Quieres cambiar la contraseña?',
                text: 'Ir al siguiente enlace para cambiar la contraseña.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ir al enlace',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aquí puedes redirigir al usuario al enlace donde puede cambiar la contraseña
                    window.location.href = 'Restablecer_Contraseña.html';
                }
            });
        }
    </script>
<?php
} else {
    echo "No se encontraron datos del usuario.";
}

// Cerrar la conexión
$conexion->close();
?>
</body>
</html>
