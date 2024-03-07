<?php
while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM mensajes WHERE (Mensaje_entrante = {$row['Idusuarios']}
                OR Mensaje_saliente = {$row['Idusuarios']}) AND (Mensaje_saliente = {$outgoing_id} 
                OR Mensaje_entrante = {$outgoing_id}) ORDER BY Idmensaje DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['Mensaje'] : $result = "No hay mensajes disponibles";
    (strlen($result) > 28) ? $Mensaje =  substr($result, 0, 28) . '...' : $Mensaje = $result;
    if (isset($row2['Mensaje_saliente'])) {
        ($outgoing_id == $row2['Mensaje_saliente']) ? $you = "Tu: " : $you = "";
    } else {
        $you = "";
    }

    // Verificar si el usuario está fuera de línea y asignar la clase CSS correspondiente al icono de estado
    ($row['status'] == "Fuera de Línea") ? $offline = "offline" : $offline = "online";

    ($outgoing_id == $row['Idusuarios']) ? $hid_me = "hide" : $hid_me = "";

    $output .= '<a href="chat.php?Idusuarios=' . $row['Idusuarios'] . '">
                    <div class="content">
                    <img src="../' . $row['img'] . '" alt="">
                    <div class="details">
                        <span>' . $row['Nombres'] . " " . $row['Apellidos'] . '</span>
                        <p>' . $you . $Mensaje . '</p>
                    </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
}
?>
