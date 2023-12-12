<?php
require("../CtrlDocentes/modeloDocentes/Docentes.php");
require("../CtrlDocentes/modeloDocentes/conexion.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the key "IDdocente" exists in the $_POST array
    if (isset($_POST['IDdocente'])) {
        // Retrieve form data
        $Docidentificacion = $_POST['IDdocente'];
        $DocNombres = $_POST['DocNombre'];
        $Correo = $_POST['Correo'];
        $Contraseña = $_POST['Contraseña'];
        $Curso_pr = $_POST['Curso_pr'];
        $Materia = $_POST['Materia'];
        $Contraseñamd5 = md5($Contraseña);

        // Create a Docentes object
        $objDocentes = new Docentes();

        // Set values for the object's properties
        $objDocentes->crearDocente($Docidentificacion, $DocNombres, $Correo, $Contraseñamd5, $Curso_pr, $Materia);

        // Attempt to add the docente to the database
        $resultado = $objDocentes->agregarDocente();

        if ($resultado) {
            
            header("location: listarDocente.php?x=5"); 
        } else {
           
            header("location: listarDocente.php?x=6"); 
        }
    } 
}
?>
