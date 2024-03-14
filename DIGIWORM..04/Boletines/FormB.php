<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Estudiante</title>
    <link rel="stylesheet" href="../css/Boletins.css">
</head>
<body>
    <div class="container">
        <h2>Formulario de Estudiante</h2>
        <form action="Validacion/procesar_formulario.php" method="post" id="formulario">
            <label for="id">ID del Estudiante:</label>
            <input type="number" id="id" name="id" required>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="trimestre">Trimestre:</label>
            <select id="trimestre" name="trimestre" required>
                <option value="1">Trimestre 1</option>
                <option value="2">Trimestre 2</option>
                <option value="3">Trimestre 3</option>
            </select>

            <label for="cantidad_materias">Cantidad de Materias:</label>
            <select id="cantidad_materias" name="cantidad_materias" required>
                <?php for ($i = 1; $i <= 13; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>

            <div id="campos_materias"></div>

            <input type="submit" value="Enviar">
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