<?php
session_start();
include_once "php/config.php";


include_once "header.php";
?>

<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php
        if (isset($_GET['Idusuarios'])) {
          $user_id = mysqli_real_escape_string($conn, $_GET['Idusuarios']);
          $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE Idusuarios = {$user_id}");
          if ($sql && mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          } else {
            header("location: users.php");
            exit; // Asegúrate de salir del script después de redirigir
          }
        } else {
          // Maneja el caso en que $_GET['Idusuarios'] no está definido
          echo "ID de usuario no definido";
          exit; // Asegúrate de salir del script si no hay ID de usuario
        }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['Nombres'] . " " . $row['Apellidos'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="mensajes" class="input-field" placeholder="Escribe tu mensaje aquí..." autocomplete="off">
        <button class="button" name="button"><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>

</html>
