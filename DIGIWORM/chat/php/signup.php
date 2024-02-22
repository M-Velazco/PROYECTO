<?php
session_start();
include_once "config.php";
$Nombres = mysqli_real_escape_string($conn, $_POST['Nombres']);
$Apellidos = mysqli_real_escape_string($conn, $_POST['Apellidos']);
$Email = mysqli_real_escape_string($conn, $_POST['Email']);
$Password = mysqli_real_escape_string($conn, $_POST['Password']);
if (!empty($Nombres) && !empty($Apellidos) && !empty($Email) && !empty($Password)) {
    if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE Email = '{$Email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$Email - ¡Este e-mail ya existe!";
        } else {
            if (isset($_FILES['image'])) {
                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);

                $extensions = ["jpeg", "png", "jpg"];
                if (in_array($img_ext, $extensions) === true) {
                    $types = ["image/jpeg", "image/jpg", "image/png"];
                    if (in_array($img_type, $types) === true) {
                        $time = time();
                        $new_img_name = $time . $img_name;
                        if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                            $ran_id = rand(time(), 100000000);
                            $status = "Disponible";
                            $encrypt_pass = md5($Password);
                            $insert_query = mysqli_query($conn, "INSERT INTO usuarios (unique_id, fname, lname, Email, Password, img, status)
                                VALUES ({$ran_id}, '{$Nombres}','{$Apellidos}', '{$Email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                            if ($insert_query) {
                                $select_sql2 = mysqli_query($conn, "SELECT * FROM usuarios WHERE Email = '{$Email}'");
                                if (mysqli_num_rows($select_sql2) > 0) {
                                    $result = mysqli_fetch_assoc($select_sql2);
                                    $_SESSION['unique_id'] = $result['unique_id'];
                                    echo "Proceso Exitoso";
                                } else {
                                    echo "¡Esta dirección de correo electrónico no existe!";
                                }
                            } else {
                                echo "Algo salió mal. ¡Inténtalo de nuevo!";
                            }
                        }
                    } else {
                        echo "Cargue un archivo de imagen: jpeg, png, jpg";
                    }
                } else {
                    echo "Cargue un archivo de imagen: jpeg, png, jpg";
                }
            }
        }
    } else {
        echo "$email ¡No es un correo electrónico válido!";
    }
} else {
    echo "¡Todos los campos de entrada son obligatorios!";
}
