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
  $insertSQL = sprintf("INSERT INTO alumnos (cod_alumno, nombre, apellido, telefono, email, tutor, tel_tutor) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ci'], "int"),
                       GetSQLValueString($_POST['nomalu'], "text"),
                       GetSQLValueString($_POST['apalu'], "text"),
                       GetSQLValueString($_POST['celalu'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['nomapo'], "text"),
                       GetSQLValueString($_POST['celap'], "int"));

  mysql_select_db($database_p, $p);
  $Result1 = mysql_query($insertSQL, $p) or die(mysql_error());

  $insertGoTo = "registroalu.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_p, $p);
$query_Recordset1 = "SELECT * FROM alumnos";
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
        <td><input type="text" name="ci" id="ci"></td>
      </tr>
      <tr>
        <td>Nombre</td>
        <td><input type="text" name="nomalu" id="nomalu"></td>
      </tr>
      <tr>
        <td>Apellidos</td>
        <td><input type="text" name="apalu" id="apalu"></td>
      </tr>
      <tr>
        <td>Correo Electronico</td>
        <td><input type="email" name="email" id="email"></td>
      </tr>
      <tr>
        <td>Celular</td>
        <td><input type="number" name="celalu" id="celalu"></td>
      </tr>
      <tr>
        <td>Celular de Apoderado</td>
        <td><input type="number" name="celap" id="celap"></td>
      </tr>
      <tr>
        <td>Nombre de Apoderado</td>
        <td><input type="text" name="nomapo" id="nomapo"></td>
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
