<?php require_once('../Connections/p.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE alumnos SET nombre=%s, apellido=%s, telefono=%s, email=%s, tutor=%s, tel_tutor=%s WHERE cod_alumno=%s",
                       GetSQLValueString($_POST['nomalu'], "text"),
                       GetSQLValueString($_POST['apalu'], "text"),
                       GetSQLValueString($_POST['celalu'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['nomapo'], "text"),
                       GetSQLValueString($_POST['celap'], "int"),
                       GetSQLValueString($_POST['ci'], "int"));

  mysql_select_db($database_p, $p);
  $Result1 = mysql_query($updateSQL, $p) or die(mysql_error());

  $updateGoTo = "actulizaral.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['cod_c'])) {
  $colname_Recordset1 = $_GET['cod_c'];
}
mysql_select_db($database_p, $p);
$query_Recordset1 = sprintf("SELECT * FROM alumnos WHERE cod_alumno = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $p) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  <table width="430" border="1">
    <tbody>
      <tr>
        <td>CI</td>
        <td><input name="ci" type="text" id="ci" value="<?php echo $row_Recordset1['cod_alumno']; ?>"></td>
      </tr>
      <tr>
        <td>Nombre</td>
        <td><input name="nomalu" type="text" id="nomalu" value="<?php echo $row_Recordset1['nombre']; ?>"></td>
      </tr>
      <tr>
        <td>Apellidos</td>
        <td><input name="apalu" type="text" id="apalu" value="<?php echo $row_Recordset1['apellido']; ?>"></td>
      </tr>
      <tr>
        <td>Correo Electronico</td>
        <td><input name="email" type="email" id="email" value="<?php echo $row_Recordset1['email']; ?>"></td>
      </tr>
      <tr>
        <td>Celular</td>
        <td><input name="celalu" type="number" id="celalu" value="<?php echo $row_Recordset1['telefono']; ?>"></td>
      </tr>
      <tr>
        <td>Celular de Apoderado</td>
        <td><input name="celap" type="number" id="celap" value="<?php echo $row_Recordset1['tel_tutor']; ?>"></td>
      </tr>
      <tr>
        <td>Nombre de Apoderado</td>
        <td><input name="nomapo" type="text" id="nomapo" value="<?php echo $row_Recordset1['tutor']; ?>"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="submit" id="submit" value="Actualizar"></td>
      </tr>
    </tbody>
  </table>
  <input type="hidden" name="MM_update" value="form1">
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
