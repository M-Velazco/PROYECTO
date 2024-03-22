<?php
session_start();
if (isset($_SESSION['Idusuarios'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['Idusuarios'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";
    $sql = "SELECT * FROM mensajes LEFT JOIN usuarios ON usuarios.Idusuarios = mensajes.Mensaje_saliente
                WHERE (Mensaje_saliente = {$outgoing_id} AND Mensaje_entrante = {$incoming_id})
                OR (Mensaje_saliente = {$incoming_id} AND Mensaje_entrante = {$outgoing_id}) ORDER BY Idmensaje";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['Mensaje_saliente'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['Mensaje'] . '</p>
                                </div>
                                </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="php/images/' . $row['img'] . '" alt="">
                                <div class="details">
                                    <p>' . $row['Mensaje'] . '</p>
                                </div>
                                </div>';
            }
        }
    } else {
        $output .= '<div class="text">No hay mensajes disponibles. Una vez que envíe el mensaje, aparecerán aquí.</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}
