<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

</head>
<body>
    

                <h3 class="modal-title" id="exampleModalLabel">Agregar registro</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    
            </div>
            <div class="modal-body">

                <form action="../includes/upload.php" method="POST" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombreA" class="form-label">Nombre de la actividad</label>
                                <input type="text" id="nombreA" name="nombreA" class="form-control" required>

                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Materia" class="form-label">Materia</label>
                                <select id="Materia" name="Materia" class="form-control">
                        <option value=""></option>
                       <?php
                                    // Conexión a la base de datos y consulta de las materias
                                    $conexion = new mysqli("localhost", "root", "sena", "digiworm_04");
                                    if ($conexion->connect_error) {
                                        die("Error de conexión: " . $conexion->connect_error);
                                    }
                                    $consulta = $conexion->query("SELECT Nombre_Materia FROM materias");

                                    // Generar las opciones del select
                                    while ($fila = $consulta->fetch_assoc()) {
                                        echo "<option value='" . $fila['Nombre_Materia'] . "'>" . $fila['Nombre_Materia'] . "</option>";
                                    }
                                    // Cerrar la conexión
                                    $conexion->close();
                                    ?>
                    </select> 
                            </div>
                        </div>
                    </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Docente" class="form-label">Docente</label>
                                <select id="Docente" name="Docente" class="form-control">
                        <option value=""></option>
                        <?php
                        // Conexión a la base de datos y consulta de las materias
                        $conexion = new mysqli("localhost", "root", "sena", "digiworm_04");
                        if ($conexion->connect_error) {
                            die("Error de conexión: " . $conexion->connect_error);
                        }
                        $consulta = $conexion->query("SELECT  idDocente, Nombres, Apellidos FROM docente");

                        // Generar las opciones del select
                        while ($fila = $consulta->fetch_assoc()) {
                            echo "<option value='" . $fila['idDocente'] . "'>" . $fila['Nombres'] . "' " . $fila['Apellidos'] . "</option>";
                        }
                        // Cerrar la conexión
                        $conexion->close();
                        ?>
                    </select> 
                            </div>
                        </div>
                    </div>




                    <div class="col-12">
                        <label for="file" class="form-label">Archivo (WORD & PDF)</label>
                        <input type="file" name="Archivo" id="Archivo" class="form-control" required>

                    </div>
                    <div class="col-sm-6">
                            <div class="mb-3">
                    <select id="Estado" name="Estado" >
    <option value="">Selecciona una opción</option>
    <option value="Activo">Activo</option>
    <option value="Inactivo">Inactivo</option>
</select>  </div>
                        </div>

                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="register" name="registrar">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

            </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>