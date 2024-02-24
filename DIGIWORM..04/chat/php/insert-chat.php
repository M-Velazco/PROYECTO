<?php 
    session_start();
    if(isset($_SESSION['Idusuarios'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['Idusuarios'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['mensajes']);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO mensajes (Mensaje_entrante, Mensaje_saliente, Mensaje)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>