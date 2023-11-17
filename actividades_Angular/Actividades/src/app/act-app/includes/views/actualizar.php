<?php
require_once "../includes/db.php";
$consulta = mysqli_query($conexion, "SELECT * FROM actividades");

while ($fila = mysqli_fetch_assoc($consulta)):
?>

<div class="modal fade" id="actualizar_<?php echo $fila['idactividades']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Actualizar registro</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="../includes/update.php?idactividades=<?php echo $fila['idactividades']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombreA" class="form-label">id actividad</label>
                                <input type="text" id="nombreA" name="nombreA" class="form-control" readonly required value="<?php echo $fila['idactividades']; ?>">
                            </div>
                        </div>
                            <div class="mb-3">
                                <label for="nombreA" class="form-label">Nombre de la actividad</label>
                                <input type="text" id="nombreA" name="nombreA" class="form-control" required value="<?php echo $fila['Nom_act']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Materia" class="form-label">Materia</label>
                                <input type="number" id="Materia" name="Materia" class="form-control" required value="<?php echo $fila['Materia_act']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="file" class="form-label">Archivo (WORD & PDF)</label>
                        <input type="file" name="Archivo" id="Archivo" class="form-control" required>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="register" name="registrar">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
endwhile;
?>
