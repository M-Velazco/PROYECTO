<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Agregar Taller</title>
</head>
<body>

<form id="form1" name="form1" method="post" action="validarAgregarTalleresObjetos.php" enctype="multipart/form-data">

  <table width="35%" border="0" align="center">
    <tr>
      <td colspan="2" align="center" bgcolor="#EAEAEA">AGREGAR TALLER</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EAEAEA">ID Taller</td>
      <td>
        <label for="idtalleres"></label>
        <input name="idtalleres" type="text" id="idtalleres" class="textbox" />
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EAEAEA">Nombre del Taller</td>
      <td>
        <label for="Nom_taller"></label>
        <input name="Nom_taller" type="text" id="Nom_taller" class="textbox" />
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EAEAEA">Materia del Taller</td>
      <td>
        <label for="Materia_taller"></label>
        <input name="Materia_taller" type="text" id="Materia_taller" class="textbox" />
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EAEAEA">Docente</td>
      <td>
        <label for="Docente"></label>
        <input name="Docente" type="text" id="Docente" class="textbox" />
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EAEAEA">Archivo</td>
      <td>
        <label for="Archivo"></label>
        <input name="Talleres" type="file" id="Archivo" />
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#EAEAEA"><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>
</body>
</html>
