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
<body>
  <div class="wrapper">
    <section class="form login">
      <header>Ingresar a Chat en Línea </header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Dirección de Correo Electrónico</label>
          <input type="text" name="Email" placeholder="Ingresa tu Correo Registrado" required>
        </div>
        <div class="field input">
          <label>Contraseña</label>
          <input type="password" name="Pasword" placeholder="Ingresa tu Contraseña" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
    
</div>

        <div class="field button">
          <input type="submit" name="submit" value="Chatear">
        </div>
      </form>
     
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>

</html>