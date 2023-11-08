<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUBIR WORD & PDF</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <br>

    <div class="container">
        <div class="col-sm-12">
            <h2 style="text-align: center;">Subir Archivos Word & PDF | SoftCodEPM</h2>
            <br>
            <div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar"> Agregar </button>

                <td>
    
    </a>
</td>

            </div>
            <br>
            <br>
            <br>


            <div class="container">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>nombre de la actividad</th>
                            <th>Materia</th>
                            <th>Docente</th>
                            <th>Archivo</th>
                            <th>Descargar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    require_once "../includes/db.php";
                       $consulta = mysqli_query($conexion, "SELECT * FROM actividades");
                    while ($fila = mysqli_fetch_assoc($consulta)):
                    

                    ?>
                            <tr>
                            <td><?php echo $fila['idactividades'] ;?></td>
                            <td><?php echo $fila['Nom_act'] ;?></td>
                            <td><?php echo $fila['Materia_act'] ;?></td>
                            <td><?php echo $fila['Docente'] ;?></td>
                            <td><?php echo $fila['Archivo'] ;?></td>
                                <td>
                                    <a href="../includes/download.php?idactividades= <?php echo $fila['idactividades'] ;?>" class="btn btn-primary">
                                <i class="fas fa-download"></i></a>
                                
                                <a href="actualizar.php?idactividades=<?php echo $fila['idactividades']; ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Actualizar

                                <a href="../includes/eliminar.php?idactividades=<?php echo $fila['idactividades']; ?>" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Eliminar
                                </td>
                            
                                <?php endwhile ;?>

                            </tr>
                    </tbody>
                </table>

            </div>
        </div>

</body>
<style>
    a {
        text-decoration: none;
    }

    .s {
        padding-top: 50px;
        text-align: center;
    }
</style>

<footer>
    
</footer>

<?php include "agregar.php"; ?>

</html>