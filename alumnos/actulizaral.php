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
<form id="form1" name="form1" method="post">
</form>
<?php do { ?>
  <table width="1484" border="1">
    <tbody>
      <tr>
        <td width="229"><?php echo $row_Recordset1['cod_alumno']; ?></td>
        <td width="207"><?php echo $row_Recordset1['nombre']; ?></td>
        <td width="236"><?php echo $row_Recordset1['apellido']; ?></td>
        <td width="161"><?php echo $row_Recordset1['telefono']; ?></td>
        <td width="141"><?php echo $row_Recordset1['email']; ?></td>
        <td width="138"><?php echo $row_Recordset1['tutor']; ?></td>
        <td width="163"><?php echo $row_Recordset1['tel_tutor']; ?></td>
        <td width="48"><a href="actualu.php?cod_c=<?php echo $row_Recordset1['cod_alumno']; ?>"><img src="46640.png" width="72" height="65" alt=""/></a></td>
        <td width="41"><img src="eliminar.png" width="81" height="69" alt=""/></td>
      </tr>
    </tbody>
  </table>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
