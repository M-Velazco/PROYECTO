<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['Idusuarios'];
    $sql = "SELECT * FROM usuarios WHERE NOT Idusuarios = {$outgoing_id} ORDER BY Idusuarios DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No usuarios are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>