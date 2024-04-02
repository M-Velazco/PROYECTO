<?php
// Inicia la sesión

// Verifica si la variable de sesión 'Idusuario' está establecida para determinar si el usuario está conectado
if(isset($_SESSION['Idusuario'])) {
    $usuario_conectado = true;
    // Crea una instancia de la clase Usuario y conecta a la base de datos
    require_once "modelo/USUARIO.php";
    require_once "modelo/conexion.php";
    $objConexion = Conectarse();
    $objUsuarios = new Usuario($objConexion);
    // Obtiene el nombre del usuario basado en su ID
    $nombre_usuario = $objUsuarios->obtenerNombreUsuario($_SESSION['Idusuario']);
    // Obtiene la ruta de la imagen de perfil del usuario
    $ruta_imagen = $objUsuarios->obtenerRutaImagenUsuario($_SESSION['Idusuario']);
    $rol_usuario = $objUsuarios->obtenerRolUsuario($_SESSION['Idusuario']);
    
} else {
    $usuario_conectado = false;
    header('Location: form.php?error=nologeado');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Estudiante</title>
    <link rel="stylesheet" href="css/Boletins.css">
</head>
<body>
    <div class="container">
        <h2>Formulario de Estudiante</h2>
        <form action="Boletines/Validacion/procesar_formulario.php" method="post" id="formulario">
       
            <label for="curso">Seleccionar Curso:</label>
            <select name="curso" id="curso" onchange="mostrarEstudiantes()">
                <option value="">Selecciona un curso</option>
                <?php
                // Conexión a la base de datos
                $conn = Conectarse();
                // Consulta para obtener los cursos disponibles
                $sql_cursos = "SELECT * FROM curso";
                $result_cursos = $conn->query($sql_cursos);
                // Generar opciones del select con los cursos
                while ($row_curso = $result_cursos->fetch_assoc()) {
                    echo "<option value='" . $row_curso['idCurso'] . "'>" . $row_curso['Nombre_curso'] ." -- ". $row_curso['Jornada'] . "</option>";
                }
                ?>
            </select><br><br>
            
            <label for="id">ID del Estudiante:</label>
            <select name="id" id="id" onchange="mostrarDatosEstudiante(this.value)">
                <option value="">Selecciona un curso primero</option>
            </select>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="trimestre">Periodos:</label>
            <select id="trimestre" name="trimestre" required>
                <option value="1">Periodo 1</option>
                <option value="2">Periodo 2</option>
                <option value="3">Periodo 3</option>
            </select>

            <label for="cantidad_materias">Cantidad de Materias:</label>
            <select id="cantidad_materias" name="cantidad_materias" required>
                <option value=""></option>
                <?php for ($i = 1; $i <= 13; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>   

            <div id="campos_materias"></div>
            
            <?php if($rol_usuario == 'Docente'): ?>
            <input type="submit" value="Enviar">
            <?php endif; ?>
            <input type="button" value="Volver" onclick="window.location.href='../index04.php'">
        </form>
    </div>
    <script>
    function mostrarEstudiantes() {
        var cursoSeleccionado = document.getElementById("curso").value;
        var selectEstudiante = document.getElementById("id");
        // Vaciar opciones del select
        selectEstudiante.innerHTML = "";
        // Realizar solicitud AJAX para obtener los estudiantes asociados al curso seleccionado
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var estudiantes = JSON.parse(xhr.responseText);
                    // Llenar select con los ID de los estudiantes
                    for (var i = 0; i < estudiantes.length; i++) {
                        var option = document.createElement("option");
                        option.value = estudiantes[i].idEstudiante;
                        option.text = estudiantes[i].idEstudiante;
                        selectEstudiante.appendChild(option);
                    }
                    // Una vez llenado el select de estudiantes, mostrar los datos del estudiante seleccionado
                    mostrarDatosEstudiante(selectEstudiante.value);
                } else {
                    alert("Error al obtener los estudiantes asociados al curso");
                }
            }
        };
        xhr.open("GET", "Boletines/obtener_estudiantes_por_curso.php?curso=" + cursoSeleccionado, true);
        xhr.send();
    }
    </script>

    <!-- Script para mostrar los datos del estudiante seleccionado -->
    <script>
    function mostrarDatosEstudiante(idEstudiante) {
        // Realizar una solicitud AJAX para obtener los datos del estudiante
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var estudiante = JSON.parse(xhr.responseText);
                    // Llenar los campos del formulario con los datos del estudiante
                    document.getElementById('nombre').value = estudiante.Nombres;
                    document.getElementById('apellido').value = estudiante.Apellidos;
                    // Puedes agregar aquí más campos del estudiante si es necesario
                } else {
                    alert('Hubo un error al obtener los datos del estudiante');
                }
            }
        };
        xhr.open('GET', 'Boletines/obtener_datos_estudianteN.php?id=' + idEstudiante, true);
        xhr.send();
    }
    </script>
    <script>
        document.getElementById('cantidad_materias').addEventListener('change', function() {
            var cantidad = parseInt(this.value);
            var camposMaterias = document.getElementById('campos_materias');
            camposMaterias.innerHTML = '';

            for (var i = 1; i <= cantidad; i++) {
                var divMateria = document.createElement('div');
                divMateria.classList.add('materia');

                var label = document.createElement('label');
                label.textContent = 'Materia ' + i + ':';
                divMateria.appendChild(label);

                var selectMateria = document.createElement('select');
                selectMateria.name = 'materia' + i;
                selectMateria.classList.add('form-control');
                <?php
                    $conexion = new mysqli("localhost", "root", "sena", "digiworm_04");
                    if ($conexion->connect_error) {
                        die("Error de conexión: " . $conexion->connect_error);
                    }
                    $consulta = $conexion->query("SELECT Nombre_Materia FROM materias");
                    while ($fila = $consulta->fetch_assoc()) {
                        echo "var option = document.createElement('option');";
                        echo "option.value = '" . $fila['Nombre_Materia'] . "';";
                        echo "option.textContent = '" . $fila['Nombre_Materia'] . "';";
                        echo "selectMateria.appendChild(option);";
                    }
                    $conexion->close();
                ?>
                divMateria.appendChild(selectMateria);

                var inputNota = document.createElement('input');
                inputNota.type = 'number';
                inputNota.name = 'nota' + i;
                inputNota.placeholder = 'Nota Materia ' + i;
                inputNota.step = '0.01';
                inputNota.min = '0';
                inputNota.max = '10';
                inputNota.required = true;
                divMateria.appendChild(inputNota);

                var textareaObservacion = document.createElement('textarea');
                textareaObservacion.name = 'observacion' + i;
                textareaObservacion.placeholder = 'Observaciones Materia ' + i;
                divMateria.appendChild(textareaObservacion);

                camposMaterias.appendChild(divMateria);
            }
        });
    </script>
</body>
</html>
