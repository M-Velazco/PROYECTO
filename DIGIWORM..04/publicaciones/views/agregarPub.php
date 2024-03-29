<?php

// Esta en una fase de prueba para el backend de publicaciones en espera de aprobacion de parte de la lider y grupo de proyecto
// validar utilizacion e insercion de datos
// Inicia la sesión
session_start();

// Verifica si la variable de sesión 'Idusuario' está establecida para determinar si el usuario está conectado
if(isset($_SESSION['Idusuario'])) {
    $usuario_conectado = true;

    // Crea una instancia de la clase Usuario y conecta a la base de datos
    require_once "../modelo/USUARIO.php";
    require_once "../modelo/conexion.php";
    $objConexion = Conectarse();
    $objUsuarios = new Usuario($objConexion);

    // Obtiene el nombre del usuario basado en su ID
    $nombre_usuario = $objUsuarios->obtenerNombreUsuario($_SESSION['Idusuario']);
    $Curso_estudiante =$objUsuarios->obtenerNombreCurso( $_SESSION['Idusuario'] ); 
    // Obtiene la ruta de la imagen de perfil del usuario
    $ruta_imagen = $objUsuarios->obtenerRutaImagenUsuario($_SESSION['Idusuario']);
    $rol_usuario = $objUsuarios->obtenerRolUsuario($_SESSION['Idusuario']);


    
} else {
    $usuario_conectado = false;
    header( 'Location: form.php?error=nologeado' );
}
?>


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