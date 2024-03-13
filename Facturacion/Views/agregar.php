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
                <form action="../Modelo/AgregarF.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <input type="text" name="IdUser" placeholder="Ingrese Id del facturador" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Motivo" class="form-label">Motivo</label>
                                <select id="Motivo" name="Motivo" class="form-control">
                                    <option value=""></option>
                                    <option value="Consulta">Consulta</option>
                                    <option value="Medicamentos">Medicamentos</option>
                                    <option value="Laboratorios">Laboratorios</option>
                                </select> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Cancelacion" class="form-label">Estado de Facturación</label>
                                <select id="Cancelacion" name="Cancelacion" class="form-control">
                                    <option value="Cancelado">Cancelado</option>
                                    <option value="NoCancelado">Sin Cancelar</option>
                                </select> 
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <input type="text" name="Nombre_A" placeholder="Ingrese Nombres Y Apellidos" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <input type="text" name="Costo" placeholder="Ingrese El costo total" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <input type="text" name="Cantidad" placeholder="Ingrese La Cantidad" class="form-control">
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
