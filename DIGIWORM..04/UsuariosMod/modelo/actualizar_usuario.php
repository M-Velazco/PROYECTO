<?php
// Verificar si se reciben los datos esperados
if(isset($_POST['id']) && isset($_POST['rol']) && isset($_POST['estado'])) {
    // Incluir el archivo de conexión a la base de datos
    include_once "../../modelo/conexion.php";
    $conn = Conectarse();

    // Obtener los datos recibidos
    $id_usuario = $_POST['id'];
    $nuevo_rol = $_POST['rol'];
    $nuevo_estado = $_POST['estado'];
    $Curso = 0;

    // Obtener el rol anterior del usuario
    $sql_select_rol = "SELECT Rol FROM usuarios WHERE Idusuarios = $id_usuario";
    $result_select_rol = $conn->query($sql_select_rol);
    if ($result_select_rol && $result_select_rol->num_rows > 0) {
        $row = $result_select_rol->fetch_assoc();
        $rol_anterior = $row['Rol'];

        // Eliminar el registro de la tabla correspondiente al rol anterior
        switch ($rol_anterior) {
            case 'Docente':
                $sql_delete_docente = "DELETE FROM docente WHERE idDocente = $id_usuario";
                $conn->query($sql_delete_docente);
                break;
            case 'Coordinador':
                $sql_delete_coordinador = "DELETE FROM coordinador WHERE idCoordinador = $id_usuario";
                $conn->query($sql_delete_coordinador);
                break;
            case 'Estudiante':
                $sql_delete_estudiante = "DELETE FROM estudiante WHERE idEstudiante = $id_usuario";
                $conn->query($sql_delete_estudiante);
                break;
            case 'Padre_familia':
                $sql_delete_padre = "DELETE FROM padre_familia WHERE idPadre_Familia = $id_usuario";
                $conn->query($sql_delete_padre);
                break;
            // Agrega más casos según tus necesidades para otros roles
            default:
                // Manejo para otros roles si es necesario
                break;
        }

        // Actualizar los datos del usuario en la tabla de usuarios
        $sql_update_usuario = "UPDATE usuarios SET Rol = '$nuevo_rol', Estado = '$nuevo_estado' WHERE Idusuarios = $id_usuario";
        $result_update_usuario = $conn->query($sql_update_usuario);

        if ($result_update_usuario) {
            // Insertar los datos en la tabla correspondiente al nuevo rol
            switch ($nuevo_rol) {
                case 'Docente':
                    $sql_insert_docente = "INSERT INTO docente (idDocente, Nombres, Apellidos, Email, Pasword, Curso)
                                           SELECT Idusuarios, Nombres, Apellidos, Email, Pasword, $Curso FROM usuarios WHERE Idusuarios = $id_usuario";
                    $result_insert_docente = $conn->query($sql_insert_docente);
                    if ($result_insert_docente) {
                        echo "¡Datos actualizados correctamente y agregados a la tabla de docente!";
                    } else {
                        echo "¡Error al agregar datos a la tabla de docente!";
                    }
                    break;
                case 'Coordinador':
                    $sql_insert_coordinador = "INSERT INTO coordinador (idCoordinador, Nombres, Apellidos, Email, Pasword, Curso)
                                               SELECT Idusuarios, Nombres, Apellidos, Email, Pasword, $Curso FROM usuarios WHERE Idusuarios = $id_usuario";
                    $result_insert_coordinador = $conn->query($sql_insert_coordinador);
                    if ($result_insert_coordinador) {
                        echo "¡Datos actualizados correctamente y agregados a la tabla de coordinador!";
                    } else {
                        echo "¡Error al agregar datos a la tabla de coordinador!";
                    }
                    break;
                case 'Estudiante':
                    $sql_insert_estudiante = "INSERT INTO estudiante (idEstudiante, Nombres, Apellidos, Email, Pasword, Curso, Estado)
                                              SELECT Idusuarios, Nombres, Apellidos, Email, Pasword, $Curso, '$nuevo_estado' FROM usuarios WHERE Idusuarios = $id_usuario";
                    $result_insert_estudiante = $conn->query($sql_insert_estudiante);
                    if ($result_insert_estudiante) {
                        echo "¡Datos actualizados correctamente y agregados a la tabla de estudiante!";
                    } else {
                        echo "¡Error al agregar datos a la tabla de estudiante!";
                    }
                    break;
                case 'Padre_familia':
                    $sql_insert_padre = "INSERT INTO padre_familia (idPadre_Familia, Nombres, Apellidos, Email, Pasword, Estado_representante, Estado)
                                         SELECT Idusuarios, Nombres, Apellidos, Email, Pasword, 'Representante', '$nuevo_estado' FROM usuarios WHERE Idusuarios = $id_usuario";
                    $result_insert_padre = $conn->query($sql_insert_padre);
                    if ($result_insert_padre) {
                        echo "¡Datos actualizados correctamente y agregados a la tabla de padre de familia!";
                    } else {
                        echo "¡Error al agregar datos a la tabla de padre de familia!";
                    }
                    break;
                // Agrega más casos según tus necesidades para otros roles
                default:
                    // Manejo para otros roles si es necesario
                    break;
            }
        } else {
            echo "¡Error al actualizar los datos!";
        }
    } else {
        echo "¡Error al obtener el rol anterior del usuario!";
    }
} else {
    echo "¡Error! No se recibieron todos los datos esperados.";
}
?>
