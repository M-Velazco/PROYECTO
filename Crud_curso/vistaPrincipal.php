<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Digiworm</title>
<style type="text/css">
#divContenedor {
	
	left:13px;
	top:19px;
	width:1073px;
	height:700px;
	z-index:1;
	margin:0 auto;
 background-color:#ADD8E6;
}
#divEncabezado {
	
	left:26px;
	top:27px;
	width:1047px;
	height:98px;
	z-index:2;
	background-color:#ADD8E6;
}
#divMenu {

	left:26px;
	top:136px;
	width:173px;
	height:200px;
	z-index:3;
	background-color:#ADD8E6
}
#divContenido {
	position:absolute;
	left:320px;
	top:120px;
	width:858px;
	height:350px;
	z-index:4;
	overflow:auto
	}
#divPiePagina {
	left:25px;
	top:442px;
	width:1155px;
	height:77px;
	z-index:5;
	background-color:#ADD8E6
}

</style>
</head>

<body>
<div id="divContenedor">
    <div id="divMenu">
      <table width="86%" height="254" border="0" align="center">
        <tr>
          <td align="center"><a href="Crud_curso\Controlador\frmAgregarCursosObjetos.php">Crear curso</a></td>
        </tr>
         <tr>
          <td align="center"><a href="Crud_curso\Controlador\listarCursosObjetos.php">Listar cursos</a></td>
        </tr>
		<tr>
          <td align="center"><a href="Crud_curso\Controlador\tablaCursos.php">Cantidad de Cursos</a></td>
        </tr>
          <td align="center"><a href="salir.php">Salir</a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      </div>
    </div>
</div>
</body>
</html>
