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
  $updateSQL = sprintf("UPDATE docentes SET nom_doc=%s, ape_doc=%s, us_doc=%s, gr_acad=%s, di_doc=%s, talla=%s, cel_doc=%s, cel_ref=%s, nom_ref=%s, ed_doc=%s, ca_hij=%s WHERE cod_ci=%s",
                       GetSQLValueString($_POST['nomdoc'], "text"),
                       GetSQLValueString($_POST['apdoc'], "text"),
                       GetSQLValueString($_POST['usdoc'], "text"),
                       GetSQLValueString($_POST['gdoc'], "text"),
                       GetSQLValueString($_POST['direc'], "text"),
                       GetSQLValueString($_POST['talla'], "text"),
                       GetSQLValueString($_POST['celdoc'], "int"),
                       GetSQLValueString($_POST['celref'], "int"),
                       GetSQLValueString($_POST['nomf'], "text"),
                       GetSQLValueString($_POST['edad'], "int"),
                       GetSQLValueString($_POST['nh'], "int"),
                       GetSQLValueString($_POST['ci'], "int"));

  mysql_select_db($database_p, $p);
  $Result1 = mysql_query($updateSQL, $p) or die(mysql_error());

  $updateGoTo = "actuadoc.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['cod_f'])) {
  $colname_Recordset1 = $_GET['cod_f'];
}
mysql_select_db($database_p, $p);
$query_Recordset1 = sprintf("SELECT * FROM docentes WHERE cod_ci = %s", GetSQLValueString($colname_Recordset1, "int"));
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
  <table width="457" border="1">
    <tbody>
      <tr>
        <td>CI</td>
        <td><input name="ci" type="text" id="ci" value="<?php echo $row_Recordset1['cod_ci']; ?>"></td>
      </tr>
      <tr>
        <td>Nombre </td>
        <td><input name="nomdoc" type="text" id="nomdoc" value="<?php echo $row_Recordset1['nom_doc']; ?>"></td>
      </tr>
      <tr>
        <td>Apellidos</td>
        <td><input name="apdoc" type="text" id="apdoc" value="<?php echo $row_Recordset1['ape_doc']; ?>"></td>
      </tr>
      <tr>
        <td>Usuario</td>
        <td><input name="usdoc" type="text" id="usdoc" value="<?php echo $row_Recordset1['us_doc']; ?>"></td>
      </tr>
      <tr>
        <td>Grado Academico</td>
        <td><input name="gdoc" type="text" id="godc" value="<?php echo $row_Recordset1['gr_acad']; ?>"></td>
      </tr>
      <tr>
        <td>Direccion</td>
        <td><input name="direc" type="text" id="direc" value="<?php echo $row_Recordset1['di_doc']; ?>"></td>
      </tr>
      <tr>
        <td>Talla</td>
        <td><input name="talla" type="text" id="talla" value="<?php echo $row_Recordset1['talla']; ?>"></td>
      </tr>
      <tr>
        <td>Celular</td>
        <td><input name="celdoc" type="tel" id="celdoc" value="<?php echo $row_Recordset1['cel_doc']; ?>"></td>
      </tr>
      <tr>
        <td>Celular de Referencia</td>
        <td><input name="celref" type="tel" id="celref" value="<?php echo $row_Recordset1['cel_ref']; ?>"></td>
      </tr>
      <tr>
        <td>Nombre de Familiar</td>
        <td><input name="nomf" type="text" id="nomf" value="<?php echo $row_Recordset1['nom_ref']; ?>"></td>
      </tr>
      <tr>
        <td>Edad</td>
        <td><input name="edad" type="number" id="edad" value="<?php echo $row_Recordset1['ed_doc']; ?>"></td>
      </tr>
      <tr>
        <td>N° Hijos</td>
        <td><input name="nh" type="number" id="nh" value="<?php echo $row_Recordset1['ca_hij']; ?>"></td>
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
