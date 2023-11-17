<?php
extract($_REQUEST);
if (!isset($_REQUEST['x']))
	$x=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="../style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>El único límite es el que te impones a ti mismo. ¡Persigue tus sueños! </title>
</head>

<body>

<br>
<br>
<form id="form1" name="form1" method="post" action="frmactualizarDocente.php">
  <table width="31%" border="0" align="center">
    <tr >
      <td colspan="2" align="center" bgcolor="85e4cd" class="texto" >Identificación del Docente a Actualizar</td>
    </tr>
    
    <tr>
      <td align="right">Numero de Docente</td>
      <td><label for="iddocente"></label>
      <input name="iddocente" type="text" id="iddocente" size="40" required/></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="85e4cd"><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>

<?php


?>


</body>
</html>