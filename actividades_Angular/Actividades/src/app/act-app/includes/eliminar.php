<?php
if (isset($_GET['idactividades'])) {
    $idactividades = $_GET['idactividades'];

    // Realiza la conexión a la base de datos (asegúrate de incluir tu archivo de conexión)
    require_once "../includes/db.php";

    // Realiza una consulta para eliminar el registro con el ID proporcionado
    $sql = "DELETE FROM actividades WHERE idactividades = $idactividades";

    if (mysqli_query($conexion, $sql)) {
        // La eliminación se realizó con éxito
        echo "<script language='JavaScript'>
        alert('Registro eliminado con éxito.');
        location.assign('../views/index.php');
        </script>";
    } else {
        // Error en la eliminación
        echo "<script language='JavaScript'>
        alert('Error al eliminar el registro: " . mysqli_error($conexion) . "');
        location.assign('../views/index.php');
        </script>";
    }
} else {
    echo "No se proporcionó un ID de registro para eliminar.";
}
?>
