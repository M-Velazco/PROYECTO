<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h3 class="modal-title" id="exampleModalLabel">Agregar registro</h3>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="includes/upload.php" method="POST" enctype="multipart/form-data">
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
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="Docente" class="form-label">Docente</label>
                                    <select id="Docente" name="Docente" class="form-control">
                                        <option value=""></option>
                                        <?php
                                        // Conexión a la base de datos y consulta de los docentes
                                        $conexion = new mysqli("localhost", "root", "sena", "digiworm_04");
                                        if ($conexion->connect_error) {
                                            die("Error de conexión: " . $conexion->connect_error);
                                        }
                                        $consulta = $conexion->query("SELECT idDocente, Nombres, Apellidos FROM docente");

                                        // Generar las opciones del select
                                        while ($fila = $consulta->fetch_assoc()) {
                                            echo "<option value='" . $fila['idDocente'] . "'>" . $fila['Nombres'] . " " . $fila['Apellidos'] . "</option>";
                                        }
                                        // Cerrar la conexión
                                        $conexion->close();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="FechaEntrega" class="form-label">Fecha de entrega</label>
                                    <input type="date" id="FechaEntrega" name="FechaEntrega" class="form-control" min="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="Descripcion" class="form-label">Descripción</label>
                                    <textarea id="Descripcion" name="Descripcion" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="file" class="form-label">Archivo (WORD & PDF)</label>
                            <input type="file" name="Archivo" id="Archivo" class="form-control" required>
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