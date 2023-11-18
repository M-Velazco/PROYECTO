<?php
require "../Modelo/conexionBasesDatos.php";
require "../Modelo/Cursos.php";
extract($_REQUEST);

$objConexion = Conectarse();

$sql = "SELECT * FROM curso WHERE idcurso = '$_REQUEST[idcurso]'";
$resultadoCurso = $objConexion->query($sql);

$curso = $resultadoCurso->fetch_object();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Actualizar Curso</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="validarActualizarCursosObjetos.php">
    <table width="42%" border="0" align="center">
        <tr>
            <td colspan="2" align="center" bgcolor="#FFCC00">ACTUALIZAR CURSO</td>
        </tr>
        <tr>
            <td width="37%" align="right" bgcolor="#EAEAEA">ID del Curso</td>
            <td width="63%"><label for="idcurso"></label>
                <input name="idcurso" type="int" id="idcurso" value="<?php echo $curso->idcurso ?>" readonly size="40" />
            </td>
        </tr>
        <tr>
            <td align="right" bgcolor="#EAEAEA">Nombre del Curso</td>
            <td><label for="nombre"></label>
                <input name="nombre" type="text" id="nombre" value="<?php echo $curso->nom_curso ?>" size="40" readonly />
            </td>
        </tr>
        <tr>
            <td align="right" bgcolor="#EAEAEA">Estado</td>
            <td>
                <label for="estado"></label>
                <select name="estado" id="estado">
                    <option value="Activo" <?php if ($curso->estado === 'Activo') echo 'selected'; ?>>Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" bgcolor="#FFCC00"><input type="submit" name="button" id="button" value="Enviar" /></td>
        </tr>
    </table>

    <input name="Numero" type="hidden" value="<?php echo $_REQUEST['idcurso'] ?>" size="40"/>
</form>
</body>
</html>
