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
<title>Documento sin título</title>
</head>

<body>
<form id="form1" name="form1" method="post">
</form>
<?php do { ?>
  <table width="1436" border="1">
    <tbody>
      <tr>
        <td width="167" height="80"><?php echo $row_Recordset1['cod_admin']; ?></td>
        <td width="259"><?php echo $row_Recordset1['nom_admin']; ?></td>
        <td width="241"><?php echo $row_Recordset1['ap_paterno']; ?></td>
        <td width="203"><?php echo $row_Recordset1['ap_materno']; ?></td>
        <td width="131"><?php echo $row_Recordset1['cel']; ?></td>
        <td width="191"><?php echo $row_Recordset1['email']; ?></td>
        <td width="98"><a href="actuadm.php?cod_e=<?php echo $row_Recordset1['cod_admin']; ?>"><img src="46640.png" width="94" height="76" alt=""/></a></td>
        <td width="94"><img src="eliminar.png" width="76" height="70" alt=""/></td>
      </tr>
    </tbody>
  </table>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
