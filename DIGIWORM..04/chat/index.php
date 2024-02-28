<?php
session_start();
if (isset($_SESSION['Idusuarios'])) {
  header("location: users.php");
}
?>

<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <nav>
      <ul>
      <ul>
  <li><a href="javascript:history.go(-1);" style="background-color: #FF5733; color: white; padding: 10px 20px; border-radius: 3px; text-decoration: none;">Salir</a></li>
</ul>

      </ul>
    </nav>
    <section class="form signup">
      <header> Registro De Chat en Línea </header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label> Nombre</label>
            <input type="text" name="Nombres" placeholder="Nombre" required>
          </div>
          <div class="field input">
            <label>Apellido</label>
            <input type="text" name="Apellidos" placeholder="Apellido" required>
          </div>
        </div>
        <div class="field input">
          <label>Correo</label>
          <input type="text" name="Email" placeholder="tucorreo@correo.com" required>
        </div>
        <div class="field input">
          <label>Contraseña</label>
          <input type="password" name="Password" placeholder="Ingresa tu contraseña" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Avatar</label>
          <input type="file" name="img" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Acceder al Chat">
        </div>
      </form>
      <div class="link">Aun no te has registrado? <a href="login.php">Iniciar Sesion</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>

</html>
