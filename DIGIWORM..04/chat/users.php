
<?php
// Inicia la sesión
session_start();

// Verifica si la variable de sesión 'Idusuario' está establecida para determinar si el usuario está conectado
if(isset($_SESSION['Idusuario'])) {
  
  $usuario_conectado = true;

    // Crea una instancia de la clase Usuario y conecta a la base de datos
    require_once "../modelo/USUARIO.php";
    require_once "../modelo/conexion.php";
    $objConexion = Conectarse();
    $objUsuarios = new Usuario($objConexion);

    // Obtiene el nombre del usuario basado en su ID
    $nombre_usuario = $objUsuarios->obtenerNombreUsuario($_SESSION['Idusuario']);
    $Curso_estudiante =$objUsuarios->obtenerCurso( $_SESSION['Idusuario'] ); 

    // Obtiene la ruta de la imagen de perfil del usuario
    $ruta_imagen = $objUsuarios->obtenerRutaImagenUsuario($_SESSION['Idusuario']);
    $rol_usuario = $objUsuarios->obtenerRolUsuario($_SESSION['Idusuario']);


    
} else {
    $usuario_conectado = false;
    header( 'Location: form.php?error=nologeado' );
}
?>
<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="usuarios">
      <header>
        <div class="content">
          <?php
          $sql = mysqli_query($objConexion, "SELECT * FROM usuarios WHERE Idusuarios = {$_SESSION['Idusuario']}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }
          ?>
          <div class="image-container">
    <img src="../<?php echo $row['img']; ?>" alt="Image"style="width: 40px; height: 40px; border-radius: 50%;">
     
</div>

          <div class="details">
            <span>
              <?php echo $row['Nombres'] . " " . $row['Apellidos'] ?>
            </span>
            <p>
              <?php echo $row['status']; ?>
            </p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['Idusuarios']; ?>" class="logout">Cerrar Sesión</a>
      </header>
      <div class="search">
        <span class="text">Selecciona un usuario para iniciar el chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>

</html>