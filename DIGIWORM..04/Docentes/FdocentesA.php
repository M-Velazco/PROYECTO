<?php 
require_once "../modelo/conexion.php";
?>


<form action="procesar_actualizacion.php" method="POST">
  <label for="id_docente">Seleccionar docente:</label>
  <select name="id_docente" id="id_docente" onchange="mostrarDatosDocente(this.value)" required>
  <option value=""></option>
    <?php
      // Conexión a la base de datos
      $conn = Conectarse();
      // Crear conexión
      

      // Verificar conexión
      if ($conn->connect_error) {
          die("Conexión fallida: " . $conn->connect_error);
      }

      // Consulta para obtener los ID de los docentes y sus nombres y apellidos asociados
      $sql = "SELECT idDocente, Nombres, Apellidos FROM docente";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Generar opciones del select con los ID de los docentes y sus nombres y apellidos
          while ($row = $result->fetch_assoc()) {
              echo "<option value='" . $row['idDocente'] . "'>" . $row['Nombres'] . " " . $row['Apellidos'] . "</option>";
          }
      }

      // Cerrar conexión
      $conn->close();
    ?>
  </select><br><br>
  
  <label for="nombres">Nombres:</label>
  <input type="text" id="nombres" name="nombres" readonly><br><br>
  
  <label for="apellidos">Apellidos:</label>
  <input type="text" id="apellidos" name="apellidos" readonly><br><br>
  
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" readonly><br><br>
  
  <label for="curso">Curso:</label>
  
  <select name="curso" id="curso" required>
  
  <?php
      // Conexión a la base de datos
      $conn = Conectarse();
      // Crear conexión
      

      // Verificar conexión
      if ($conn->connect_error) {
          die("Conexión fallida: " . $conn->connect_error);
      }

      // Consulta para obtener los ID de los docentes y sus nombres y apellidos asociados
      $sql = "SELECT * FROM curso";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Generar opciones del select con los ID de los docentes y sus nombres y apellidos
          while ($row = $result->fetch_assoc()) {
              echo "<option value='" . $row['idCurso'] . "'>" . $row['Nombre_curso'] . "-" . $row ['Jornada'] .  "</option>";
          }
      }

      // Cerrar conexión
      $conn->close();
    ?>
  </select><br><br>
  
  <label for="materia">Materia:</label>
  <select name="materia" id="materia" required>
    
  <?php
      // Conexión a la base de datos
      $conn = Conectarse();
      // Crear conexión
      

      // Verificar conexión
      if ($conn->connect_error) {
          die("Conexión fallida: " . $conn->connect_error);
      }

      // Consulta para obtener los ID de los docentes y sus nombres y apellidos asociados
      $sql = "SELECT * FROM materias";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Generar opciones del select con los ID de los docentes y sus nombres y apellidos
          while ($row = $result->fetch_assoc()) {
              echo "<option value='" . $row['idMaterias'] . "'>" . $row['Nombre_Materia'] . "</option>";
          }
      }

      // Cerrar conexión
      $conn->close();
    ?>
  </select> <br><br>
  
  
  <label for="jornada">Jornada:</label>
  <select name="jornada" id="jornada" required>
  <option value=""></option>
    <option value="Mañana">Mañana</option>
    <option value="Tarde">Tarde</option>
  </select><br><br>
  
  <button type="submit">Actualizar</button>
</form>

<script>
function mostrarDatosDocente(idDocente) {
  // Realizar una solicitud AJAX para obtener los datos del docente
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var docente = JSON.parse(xhr.responseText);
        // Llenar los campos del formulario con los datos del docente
        document.getElementById('nombres').value = docente.Nombres;
        document.getElementById('apellidos').value = docente.Apellidos;
        document.getElementById('email').value = docente.Email;
        document.getElementById('curso').value = docente.Curso;
        document.getElementById('materia').value = docente.Materia;
        document.getElementById('jornada').value = docente.Jornada;
      } else {
        alert('Hubo un error al obtener los datos del docente');
      }
    }
  };
  xhr.open('GET', 'obtener_datos_docente.php?id=' + idDocente, true);
  xhr.send();
}
</script>
