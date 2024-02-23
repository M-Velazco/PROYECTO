<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['Idusuarios'])) {
  header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="usuarios">
      <header>
        <div class="content">
          <?php
          $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE Idusuarios = {$_SESSION['Idusuarios']}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }
          ?>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['Nombres'] . " " . $row['Apellidos'] ?></span>
            <p><?php echo $row['status']; ?></p>
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