<?php
require "../Modelo/conexionBasesDatos.php";
require "../Modelo/Taller.php"; 

$objTaller = new Taller();
$objConexion = Conectarse();

// Obtener los valores de los campos del formulario
$idtalleres = $_POST['idtalleres'];
$Nom_taller = $_POST['Nom_taller'];
$Materia_taller = $_POST['Materia_taller'];
$Docente = $_POST['Docente'];

// Handling file upload
$Archivo_temp = $_FILES['Talleres']['tmp_name'];
$Archivo_nombre = $_FILES['Talleres']['name'];
$Archivo_destino = "../Talleres/" . $Archivo_nombre;

move_uploaded_file($Archivo_temp, $Archivo_destino);

$objTaller->CrearTaller($idtalleres, $Nom_taller, $Materia_taller, $Docente, $Archivo_destino);

$query = "INSERT INTO talleres (idtalleres, Nom_taller, Materia_taller, Docente, Archivo) VALUES ('$idtalleres', '$Nom_taller', '$Materia_taller', '$Docente', '$Archivo_destino')";
$resultado = mysqli_query($objConexion, $query);

if ($resultado) {
    header("location: listarTalleresObjetos.php?x=1"); // x=1 significa que se agregó correctamente
} else {
    header("location: listarTalleresObjetos.php?x=2"); // x=2 significa que no se pudo agregar
}

mysqli_close($objConexion);
?>
