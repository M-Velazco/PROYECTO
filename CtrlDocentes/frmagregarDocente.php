<?php
require "../CtrlDocentes/modeloDocentes/conexion.php";
$objConexion = Conectarse();


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Formulario agregar Docente</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="validaragregarDocente.php">
  <table width="42%" border="0" align="center">
    <tr>
      <td colspan="2" align="center" bgcolor="#8eefce">Agregar Docente</td>
    </tr>
    <tr>
      <td width="37%" align="right" bgcolor="#EAEAEA">Numero de identificacion del Docente</td>
      <td width="63%">
        <label for="IDdocente"></label>
        <input name="IDdocente" type="int" id="IDdocente" size="40"  required>
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EAEAEA">Nombre y Apellido</td>
      <td>
        <label for="DocNombre"></label>
        <input name="DocNombre" type="text" id="DocNombre" size="40"  required>
      </td>
      
    </tr>
    <td align="right" bgcolor="#EAEAEA">Correo</td>
      <td>
        <label for="Correo"></label>
        <input name="Correo" type="email" id="Correo" size="40"  required>
      </td>
      </tr>
    <td align="right" bgcolor="#EAEAEA">Contraseña</td>
      <td>
        <label for="Contraseña"></label>
        <input name="Contraseña" type="password" id="Contraseña" size="40"   required>
      </td>
</tr>
    <td align="right" bgcolor="#EAEAEA">Director del Curso</td>
      <td>
        <label for="Curso_pr"></label>
        <input name="Curso_pr" type="int" id="Curso_pr" size="40"  required>
      </td>
      </tr>
    <td align="right" bgcolor="#EAEAEA">Materia</td>
      <td>
        <label for="Materia"></label>
        <input name="Materia" type="int" id="Materia" size="40" required>
      </td>
    <tr>
      <!-- Add similar code for other fields -->
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#8eefce"><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>
</body>
</html>
