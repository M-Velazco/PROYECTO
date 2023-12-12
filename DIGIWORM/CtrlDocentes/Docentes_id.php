<?php
extract($_REQUEST);
if (!isset($_REQUEST['x']))
	$x=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BIENVENIDOS AL SITIO OFICIAL DEL CONSULTORIO DE MAGDY</title>
</head>

<body>

<br>
<br>
<form id="form1" name="form1" method="post" action="validarDocente_id.php">
  <table width="31%" border="0" align="center">
    <tr bgcolor="#ef7aec">
      <td colspan="2" align="center" bgcolor="#ef7aec" class="texto" >ingresa numero de identificacion del Docente</td>
    </tr>
    
    <tr>
      <td align="right">Numero de  Docente:</td>
      <td><label for="IDdocente"></label>
      <input name="IDdocente" type="int" id="IDdocente" size="40" required/></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#ef7aec"><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>

<?php


?>


</body>
</html>