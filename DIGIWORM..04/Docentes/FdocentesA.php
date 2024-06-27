<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIGIWORM</title>

  <link href="../img/LOGO.png" rel="icon">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
require_once "../modelo/conexion.php";
?>

<style>
    /* Estilo para el fondo */
    body {
      background-image: url('../img/datos.jpg'); /* Ruta a tu imagen de fondo */
      background-size: cover;
      background-repeat: no-repeat;
    }

    /* Estilo para el formulario */
    form {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: rgba(110, 167, 253, 0.6); /* Pastel green con transparencia */
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Estilo para las etiquetas */
    label {
      display: block;
      margin-bottom: 5px;
      color: #333; /* Color de texto oscuro */
    }

    /* Estilo para los campos de entrada y selección */
    input[type="text"],
    input[type="email"],
    select {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    /* Estilo para el botón */
    button {
      padding: 10px 20px;
      background-color: #1a5300; /* Green */
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    /* Estilo para el botón cuando se pasa el mouse por encima */
    button:hover {
      background-color: #45E21E; /* Darker green */
    }
  </style>
  <style>
  .bottonc {
    position: relative;
    display: inline-block;
  }

  .bottonc-content {
    display: none;
    position: absolute;
    background-color: #000000;
    min-width: 160px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    z-index: 1;
  }

  .bottonc-select {
    color: white; /* Cambiar el color del texto */
    background-color: #1a5300; /* Cambiar el color de fondo */
    border: none; /* Cambiar el borde */
    padding: 5px; /* Añadir relleno */
    border-radius: 5px; /* Añadir bordes redondeados */
  }
  .bottonc-select:hover {
    color: white; /* Cambiar el color del texto */
    background-color: #6CF32E; /* Cambiar el color de fondo */
    border: none; /* Cambiar el borde */
    padding: 5px; /* Añadir relleno */
    border-radius: 5px; /* Añadir bordes redondeados */
  }

  .bottonc-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .bottonc-content a:hover {
    background-color: #FFFFFF;
  }

  .bottonc:hover .bottonc-content {
    display: block;
  }

  .bottonc:hover .dropbtn {
    background-color: #6CF32E;
  }
</style>
</head>




    <style>
  .bottoncx {
    display: inline-block;
    position: relative;
  }

  .bottoncx-select {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .bottoncx-select:focus {
    outline: none;
  }

  .bottoncx-select option {
    padding: 10px;
  }
  </style>


<form action="procesar_actualizacion.php" method="POST" enctype="multipart/form-data">

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

  <label for="materia">Materias:</label>
  <ul id="materiasList">

  </ul>
   <br><br>
  <label for="Cursos">Cursos:</label>
  <ul id="CursosList">

  </ul>
   <br><br>


  <label for="jornada">Jornada:</label>
  <select name="jornada" id="jornada" required>
  <option value=""></option>
    <option value="Mañana">Mañana..</option>
    <option value="Tarde">Tarde</option>
  </select><br>
  <input type="text" id="Descripcion" name="Descripcion" placeholder="Ingrese Descripcion de su perfil profesional" oninput="autoSize(this)">



  <input type="file" id="Certificacion" name="Archivo" style="display: none;" title="Ingrese Sus certificados"><br>
<span id="nombreArchivo"></span>

  <button type="submit" name="actualizar">Actualizar</button>
  <button type="submit" name="AgregarMateria" id="AgregarMateria"style="display: none;">Agregar materia</button>
  <button type="submit" name="AgregarCurso" id="AgregarCurso"style="display: none;">Agregar curso</button>

<!-- Agregar materia desde un select -->
<div class="bottoncx">
    <select name="info" class="bottonc-select" id="accion" onchange="mostrarAccion(this.value)">
      <option value="">Agregar</option>
      <option value="Descripcion">Descripción</option>
      <option value="Certificacion">Certificación</option>
      <option value="CertDesc">Certificacion y descripcion</option>
      <option value="AgregarMateria">Agregar Materia</option> <!-- Nueva opción -->
      <option value="AgregarCurso">Agregar Curso</option> <!-- Nueva opción -->
    </select>
  </div>

<!-- Contenedor para el select de agregar materia -->
<div id="selectMateriaContainer" style="display: none;">
    <select id="selectMateria"name="materia">
        <option value="">Seleccionar Materia</option>
        <?php
            // Conexión a la base de datos
            $conn = Conectarse();
            // Crear conexión

            // Verificar conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta para obtener las materias
            $sql = "SELECT idMaterias, Nombre_Materia FROM materias";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Generar opciones del select con las materias
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['idMaterias'] . "'>" . $row['Nombre_Materia'] . "</option>";
                }
            }

            // Cerrar conexión
            $conn->close();
        ?>
    </select>
</div>
<!-- Contenedor para el select de agregar Curso -->
<div id="selectCursoContainer" style="display: none;">
    <select id="selectCurso"name="Curso_ext">
        <option value="">Seleccionar Curso</option>
        <?php
            // Conexión a la base de datos
            $conn = Conectarse();
            // Crear conexión

            // Verificar conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta para obtener las materias
            $sql = "SELECT idCurso, Nombre_curso FROM curso";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Generar opciones del select con las materias
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['idCurso'] . "'>" . $row['Nombre_curso'] ." - ". $row['Jornada'] . "</option>";
                }
            }

            // Cerrar conexión
            $conn->close();
        ?>
    </select>
</div>




  <a class="Button" href="../Docentes.php">Volver</a>
  <br>

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
        document.getElementById('jornada').value = docente.Jornada;
        document.getElementById('Descripcion').value = docente.Desc_prof;
        document.getElementById('nombreArchivo').innerText = docente.Certificacion;

        // Manejar las materias asignadas al docente
        var materiasList = document.getElementById('materiasList');
        // Limpiar el elemento ul antes de agregar las nuevas materias
        materiasList.innerHTML = '';
        var materias = docente.Materias.split(', ');
        materias.forEach(function(materia) {
          var listItem = document.createElement('li');
          listItem.textContent = materia;
          materiasList.appendChild(listItem);
        });

        // Manejar los cursos asignados al docente
        var cursosList = document.getElementById('CursosList');
        // Limpiar el elemento ul antes de agregar los nuevos cursos
        cursosList.innerHTML = '';
        var cursos = docente.Cursos.split(', ');
        cursos.forEach(function(curso) {
          var listItem = document.createElement('li');
          listItem.textContent = curso;
          cursosList.appendChild(listItem);
        });
      } else {
        alert('Hubo un error al obtener los datos del docente');
      }
    }
  };
  xhr.open('GET', 'obtener_datos_docente.php?id=' + idDocente, true);
  xhr.send();
}

function mostrarAccion(accion) {
    if (accion === 'AgregarMateria') {
        document.getElementById('selectMateriaContainer').style.display = 'block';
        document.getElementById('AgregarMateria').style.display = 'block';
        document.getElementById('selectCursoContainer').style.display = 'none';
        document.getElementById('AgregarCurso').style.display = 'none';
    } else if (accion === 'AgregarCurso') {
        document.getElementById('selectCursoContainer').style.display = 'block';
        document.getElementById('AgregarCurso').style.display = 'block';
        document.getElementById('selectMateriaContainer').style.display = 'none';
        document.getElementById('AgregarMateria').style.display = 'none';
    } else {
        document.getElementById('selectMateriaContainer').style.display = 'none';
        document.getElementById('AgregarMateria').style.display = 'none';
        document.getElementById('selectCursoContainer').style.display = 'none';
        document.getElementById('AgregarCurso').style.display = 'none';
    }
}
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var selectButtons = document.querySelectorAll('select[name="info"]');
    var certificacionField = document.getElementById('Certificacion');
    var descripcionField = document.getElementById('Descripcion');

    // Escuchar el cambio en el select
    selectButtons.forEach(function(selectButton) {
      selectButton.addEventListener('change', function() {
        // Mostrar u ocultar campos según la selección
        if (this.value === 'Certificacion') {
          certificacionField.style.display = 'block';
          descripcionField.style.display = 'none';
        } else if (this.value === 'Descripcion') {
          certificacionField.style.display = 'none';
          descripcionField.style.display = 'block';
        }
        else if (this.value === 'CertDesc') {
          certificacionField.style.display = 'block';
          descripcionField.style.display = 'block';
        } else {
          certificacionField.style.display = 'none';
          descripcionField.style.display = 'none';
        }
      });
    });
  });
</script>

</body>
</html>
