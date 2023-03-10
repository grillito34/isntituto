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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO docentes (cod_ci, nom_doc, ape_doc, us_doc, gr_acad, di_doc, talla, cel_doc, cel_ref, nom_ref, ed_doc, ca_hij) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ci'], "int"),
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
                       GetSQLValueString($_POST['nh'], "int"));

  mysql_select_db($database_p, $p);
  $Result1 = mysql_query($insertSQL, $p) or die(mysql_error());

  $insertGoTo = "registrodoc.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_p, $p);
$query_Recordset1 = "SELECT * FROM docentes";
$Recordset1 = mysql_query($query_Recordset1, $p) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);mysql_select_db($database_p, $p);
$query_Recordset1 = "SELECT * FROM docentes";
$Recordset1 = mysql_query($query_Recordset1, $p) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin t??tulo</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  <table width="457" border="1">
    <tbody>
      <tr>
        <td>CI</td>
        <td><input type="text" name="ci" id="ci"></td>
      </tr>
      <tr>
        <td>Nombre </td>
        <td><input type="text" name="nomdoc" id="nomdoc"></td>
      </tr>
      <tr>
        <td>Apellidos</td>
        <td><input type="text" name="apdoc" id="apdoc"></td>
      </tr>
      <tr>
        <td>Usuario</td>
        <td><input type="text" name="usdoc" id="usdoc"></td>
      </tr>
      <tr>
        <td>Grado Academico</td>
        <td><input type="text" name="gdoc" id="godc"></td>
      </tr>
      <tr>
        <td>Direccion</td>
        <td><input type="text" name="direc" id="direc"></td>
      </tr>
      <tr>
        <td>Talla</td>
        <td><input type="text" name="talla" id="talla"></td>
      </tr>
      <tr>
        <td>Celular</td>
        <td><input type="tel" name="celdoc" id="celdoc"></td>
      </tr>
      <tr>
        <td>Celular de Referencia</td>
        <td><input type="tel" name="celref" id="celref"></td>
      </tr>
      <tr>
        <td>Nombre de Familiar</td>
        <td><input type="text" name="nomf" id="nomf"></td>
      </tr>
      <tr>
        <td>Edad</td>
        <td><input type="number" name="edad" id="edad"></td>
      </tr>
      <tr>
        <td>N?? Hijos</td>
        <td><input type="number" name="nh" id="nh"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="submit" id="submit" value="Enviar"></td>
      </tr>
    </tbody>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
