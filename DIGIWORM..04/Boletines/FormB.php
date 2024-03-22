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
    header( 'Location: form.php?error=nologeado' );
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
        <form action="Validacion/procesar_formulario.php" method="post" id="formulario">
            <h2><label for="id">ID del Estudiante:</label><h2>
            <input type="number" id="id" name="id" required>

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
