<?php
while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM mensajes WHERE (Mensaje_entrante = {$row['unique_id']}
                OR Mensaje_saliente = {$row['unique_id']}) AND (Mensaje_saliente = {$Mensaje_saliente} 
                OR Mensaje_entrante = {$Mensaje_saliente}) ORDER BY idmensaje DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['Mensaje'] : $result = "No hay mensajes disponibles";
    (strlen($result) > 28) ? $Mensaje =  substr($result, 0, 28) . '...' : $Mensaje = $result;
    if (isset($row2['Mensaje_saliente'])) {
        ($Mensaje_saliente == $row2['Mensaje_saliente']) ? $you = "Tu: " : $you = "";
    } else {
        $you = "";
    }
    ($row['status'] == "Fuera de Línea") ? $offline = "offline" : $offline = "";
    ($Mensaje_saliente == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

    $output .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                    <div class="content">
                    <img src="php/images/' . $row['img'] . '" alt="">
                    <div class="details">
                        <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
}
