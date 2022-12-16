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
  $insertSQL = sprintf("INSERT INTO ``admin`` (cod_admin, nom_admin, ap_paterno, ap_materno, cel, email) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cod_admi'], "int"),
                       GetSQLValueString($_POST['nom'], "text"),
                       GetSQLValueString($_POST['ap_mat'], "text"),
                       GetSQLValueString($_POST['ap_mat'], "text"),
                       GetSQLValueString($_POST['tel'], "int"),
                       GetSQLValueString($_POST['email'], "text"));

  mysql_select_db($database_p, $p);
  $Result1 = mysql_query($insertSQL, $p) or die(mysql_error());

  $insertGoTo = "../resgistroadmin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_p, $p);
$query_Recordset1 = "SELECT * FROM `admin`";
$Recordset1 = mysql_query($query_Recordset1, $p) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>registroadmin</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  <table width="464" border="1">
    <tbody>
      <tr>
        <td width="134" style="text-align: center">Cod. Administrador</td>
        <td width="280"><input type="text" name="cod_admi" id="cod_admi"></td>
      </tr>
      <tr>
        <td style="text-align: center">Nombres</td>
        <td><label for="textfield"></label>
        <input type="text" name="nom" id="nom"></td>
      </tr>
      <tr>
        <td style="text-align: center">Apellido Paterno</td>
        <td><input type="text" name="ap_pat" id="ap_pat"></td>
      </tr>
      <tr>
        <td style="text-align: center">Apellido Materno</td>
        <td><input type="text" name="ap_mat" id="ap_mat"></td>
      </tr>
      <tr>
        <td style="text-align: center">Celular</td>
        <td><input type="tel" name="tel" id="tel"></td>
      </tr>
      <tr>
        <td style="text-align: center">Correo Electronico</td>
        <td><input type="email" name="email" id="email"></td>
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
