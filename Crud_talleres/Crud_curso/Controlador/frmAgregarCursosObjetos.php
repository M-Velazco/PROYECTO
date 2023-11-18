<?php
require "../Modelo/conexionBasesDatos.php";
$objConexion = Conectarse();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Agregar Curso</title>
</head>
<body>

<form id="form1" name="form1" method="post" action="validarAgregarCursosObjetos.php">

  <table width="35%" border="0" align="center">
    <tr>
      <td colspan="2" align="center" bgcolor="#EAEAEA">AGREGAR CURSO</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EAEAEA">ID Curso</td>
      <td>
        <label for="idcurso"></label>
        <input name="idcurso" type="text" id="idcurso" class="textbox" />
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EAEAEA">Nombre del Curso</td>
      <td>
        <label for="nom_curso"></label>
        <select name="nom_curso" id="nom_curso" class="textbox">
          <option value="Primero A">Primero A</option>
          <option value="Primero B">Primero B</option>
          <option value="Primero C">Primero C</option>
          <option value="Segundo A">Segundo A</option>
          <option value="Segundo B">Segundo B</option>
          <option value="Segundo C">Segundo C</option>
          <option value="Tercero A">Tercero A</option>
          <option value="Tercero B">Tercero B</option>
          <option value="Tercero C">Tercero C</option>
          <option value="Cuarto A">Cuarto A</option>
          <option value="Cuarto B">Cuarto B</option>
          <option value="Cuarto C">Cuarto C</option>
          <option value="Quinto A">Quinto A</option>
          <option value="Quinto B">Quinto B</option>
          <option value="Quinto C">Quinto C</option>
          <option value="Sexto A">Sexto A</option>
          <option value="Sexto B">Sexto B</option>
          <option value="Sexto C">Sexto C</option>
          <option value="Séptimo A">Séptimo A</option>
          <option value="Séptimo B">Séptimo B</option>
          <option value="Séptimo C">Séptimo C</option>
          <option value="Octavo A">Octavo A</option>
          <option value="Octavo B">Octavo B</option>
          <option value="Octavo C">Octavo C</option>
          <option value="Noveno A">Noveno A</option>
          <option value="Noveno B">Noveno B</option>
          <option value="Noveno C">Noveno C</option>
          <option value="Décimo A">Décimo A</option>
          <option value="Décimo B">Décimo B</option>
          <option value="Décimo C">Décimo C</option>
          <option value="Undécimo A">Undécimo A</option>
          <option value="Undécimo B">Undécimo B</option>
          <option value="Undécimo C">Undécimo C</option>
        </select>
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EAEAEA">Estado</td>
      <td>
        <label for="estado"></label>
        <select name="estado" id="estado" class="textbox">
          <option value="Activo">Activo</option>
          <option value="Inactivo">Inactivo</option>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#EAEAEA"><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>
</body>
</html>
