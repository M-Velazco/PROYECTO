


<div class="modal fade" id="agregarP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h3 class="modal-title" id="exampleModalLabel">Agregar registro</h3>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="uploadPublic.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="IDU" class="form-label">Id de usuario</label>
                                    <input type="text" id="IDU" name="IDU" class="form-control" readonly value="<?php echo $_SESSION['Idusuario'] ?>" required>
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