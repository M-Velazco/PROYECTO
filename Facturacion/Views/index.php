<!DOCTYPE html>
<html lang="en">
<style>
    body{background-image:url(https://th.bing.com/th/id/R.528c21b0e9322c4bdaeaa6fcc9131287?rik=oalbqawLEjXKUw&pid=ImgRaw&r=0);
        background-size: cover;};
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factureitor3000</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <br>

    <div class="container">
        <div class="col-sm-12">
            <h2 class="display-4">Sistema de facturacion</h2>
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
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                           
                            <th scope="col">ID de facturacion</th>
                            <th scope="col">Motivo de visita</th>
                            <th scope="col">Estado de Cancelacion</th>
                            <th scope="col">Nombre Del Paciente</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    require_once "../Modelo/Conexion.php";
                       $consulta = mysqli_query($conexion, "SELECT * FROM cancelacion");
                    while ($fila = mysqli_fetch_assoc($consulta)):
                    

                    ?>
                            <tr>
                            <td><?php echo $fila['iDF'] ;?></td>
                            <td><?php echo $fila['Motivo'] ;?></td>
                            <td><?php echo $fila['Cancelacion'] ;?></td>
                            <td><?php echo $fila['Nombre_A'] ;?></td>
                            
                                <td>
                                  
                                
                                <a href="actualizar.php?iDF=<?php echo $fila['iDF']; ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Actualizar

                               
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