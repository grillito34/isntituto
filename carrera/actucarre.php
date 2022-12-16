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
  $updateSQL = sprintf("UPDATE carrera SET nom_car=%s WHERE cod_car=%s",
                       GetSQLValueString($_POST['nomcar'], "text"),
                       GetSQLValueString($_POST['codcar'], "text"));

  mysql_select_db($database_p, $p);
  $Result1 = mysql_query($updateSQL, $p) or die(mysql_error());

  $updateGoTo = "actulizarcar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['cod_b'])) {
  $colname_Recordset1 = $_GET['cod_b'];
}
mysql_select_db($database_p, $p);
$query_Recordset1 = sprintf("SELECT * FROM carrera WHERE cod_car = %s", GetSQLValueString($colname_Recordset1, "text"));
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
  <table width="354" border="1">
    <tbody>
      <tr>
        <td width="155">Codigo de Carrera</td>
        <td width="183"><input name="codcar" type="text" id="codcar" value="<?php echo $row_Recordset1['cod_car']; ?>"></td>
      </tr>
      <tr>
        <td>Nombre de Carrera</td>
        <td><input name="nomcar" type="text" id="nomcar" value="<?php echo $row_Recordset1['nom_car']; ?>"></td>
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
