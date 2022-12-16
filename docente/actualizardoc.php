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
$query_Recordset1 = "SELECT * FROM docentes";
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
  <table width="1843" height="77" border="1">
    <tbody>
      <tr>
        <td width="130"><?php echo $row_Recordset1['cod_ci']; ?></td>
        <td width="146"><?php echo $row_Recordset1['nom_doc']; ?></td>
        <td width="142"><?php echo $row_Recordset1['ape_doc']; ?></td>
        <td width="133"><?php echo $row_Recordset1['us_doc']; ?></td>
        <td width="138"><?php echo $row_Recordset1['gr_acad']; ?></td>
        <td width="131"><?php echo $row_Recordset1['di_doc']; ?></td>
        <td width="113"><?php echo $row_Recordset1['talla']; ?></td>
        <td width="137"><?php echo $row_Recordset1['cel_doc']; ?></td>
        <td width="130"><?php echo $row_Recordset1['cel_ref']; ?></td>
        <td width="139"><?php echo $row_Recordset1['nom_ref']; ?></td>
        <td width="135"><?php echo $row_Recordset1['ed_doc']; ?></td>
        <td width="125"><?php echo $row_Recordset1['ca_hij']; ?></td>
        <td width="72"><a href="actuadoc.php?cod_f=<?php echo $row_Recordset1['cod_ci']; ?>"><img src="46640.png" width="72" height="65" alt=""/></a></td>
        <td width="193"><img src="eliminar.png" width="81" height="69" alt=""/></td>
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
