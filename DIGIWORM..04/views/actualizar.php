<?php
require_once "../includes/db.php";

$consulta = mysqli_query($conexion, "SELECT * FROM actividades");
$fila = mysqli_fetch_assoc($consulta);
?>

<div class="modal fade" id="actualizar_<?php echo $fila['idActividades']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Actualizar registro</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="../includes/update.php?idActividades=<?php echo $fila['idActividades']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombreA" class="form-label">ID Actividad</label>
                                <input type="text" id="nombreA" name="nombreA" class="form-control" readonly required value="<?php echo $fila['idActividades']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="nombreAct" class="form-label">Nombre de la actividad</label>
                                <input type="text" id="nombreAct" name="nombreAct" class="form-control" required value="<?php echo $fila['Nombre_act']; ?>">
                            </div>
                            
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Materia" class="form-label">Materia</label>
                                <select id="Materia" name="Materia" class="form-control">
                                    <option value=""></option>
                                    <?php
                                    // Conexión a la base de datos y consulta de las materias
                                    $conexion = new mysqli("localhost", "root", "", "digiworm_04");
                                    if ($conexion->connect_error) {
                                        die("Error de conexión: " . $conexion->connect_error);
                                    }
                                    $consultaMaterias = $conexion->query("SELECT Nombre_Materia FROM materias");

                                    // Generar las opciones del select
                                    while ($filaMateria = $consultaMaterias->fetch_assoc()) {
                                        echo "<option value='" . $filaMateria['Nombre_Materia'] . "'>" . $filaMateria['Nombre_Materia'] . "</option>";
                                    }
                                    // Cerrar la conexión
                                    $conexion->close();
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Docente" class="form-label">Docente</label>
                                <select id="Docente" name="Docente" class="form-control">
                                    <option value=""></option>
                                    <?php
                                    // Conexión a la base de datos y consulta de los docentes
                                    $conexion = new mysqli("localhost", "root", "", "digiworm_04");
                                    if ($conexion->connect_error) {
                                        die("Error de conexión: " . $conexion->connect_error);
                                    }
                                    $consultaDocentes = $conexion->query("SELECT idDocente, Nombres, Apellidos FROM docente");

                                    // Generar las opciones del select
                                    while ($filaDocente = $consultaDocentes->fetch_assoc()) {
                                        echo "<option value='" . $filaDocente['idDocente'] . "'>" . $filaDocente['Nombres'] . " " . $filaDocente['Apellidos'] . "</option>";
                                    }
                                    // Cerrar la conexión
                                    $conexion->close();
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Archivo" class="form-label">Archivo (WORD & PDF)</label>
                                <input type="file" name="Archivo" id="Archivo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select id="estado" name="estado" class="form-control">
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="register" name="registrar">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
