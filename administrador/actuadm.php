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
  $updateSQL = sprintf("UPDATE ``admin`` SET nom_admin=%s, ap_paterno=%s, ap_materno=%s, cel=%s, email=%s WHERE cod_admin=%s",
                       GetSQLValueString($_POST['nom'], "text"),
                       GetSQLValueString($_POST['ap_pat'], "text"),
                       GetSQLValueString($_POST['ap_mat'], "text"),
                       GetSQLValueString($_POST['tel'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['cod_admi'], "int"));

  mysql_select_db($database_p, $p);
  $Result1 = mysql_query($updateSQL, $p) or die(mysql_error());

  $updateGoTo = "actualizarad.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['cod_e'])) {
  $colname_Recordset1 = $_GET['cod_e'];
}
mysql_select_db($database_p, $p);
$query_Recordset1 = sprintf("SELECT * FROM `admin` WHERE cod_admin = %s", GetSQLValueString($colname_Recordset1, "int"));
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
  <table width="464" border="1">
    <tbody>
      <tr>
        <td width="134" style="text-align: center">Cod. Administrador</td>
        <td width="280"><input name="cod_admi" type="text" id="cod_admi" value="<?php echo $row_Recordset1['cod_admin']; ?>"></td>
      </tr>
      <tr>
        <td style="text-align: center">Nombres</td>
        <td><label for="textfield"></label>
          <input name="nom" type="text" id="nom" value="<?php echo $row_Recordset1['nom_admin']; ?>"></td>
      </tr>
      <tr>
        <td style="text-align: center">Apellido Paterno</td>
        <td><input name="ap_pat" type="text" id="ap_pat" value="<?php echo $row_Recordset1['ap_paterno']; ?>"></td>
      </tr>
      <tr>
        <td style="text-align: center">Apellido Materno</td>
        <td><input name="ap_mat" type="text" id="ap_mat" value="<?php echo $row_Recordset1['ap_materno']; ?>"></td>
      </tr>
      <tr>
        <td style="text-align: center">Celular</td>
        <td><input name="tel" type="tel" id="tel" value="<?php echo $row_Recordset1['cel']; ?>"></td>
      </tr>
      <tr>
        <td style="text-align: center">Correo Electronico</td>
        <td><input name="email" type="email" id="email" value="<?php echo $row_Recordset1['email']; ?>"></td>
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
