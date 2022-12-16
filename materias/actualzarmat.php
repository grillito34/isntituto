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
$query_Recordset1 = "SELECT * FROM materias";
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
  <?php do { ?>
    <table width="732" border="1">
      <tbody>
        <tr>
          <td width="260"><blockquote>
            <p><?php echo $row_Recordset1['cod_materia']; ?></p>
          </blockquote></td>
          <td width="233"><blockquote>
            <p><?php echo $row_Recordset1['materia']; ?></p>
          </blockquote></td>
          <td width="108" style="text-align: center"><a href="actumat.php?cod_a=<?php echo $row_Recordset1['cod_materia']; ?>"><img src="46640.png" width="108" height="96" alt=""/></a></td>
          <td width="115" style="text-align: center"><img src="eliminar.png" width="108" height="93" alt=""/></td>
        </tr>
      </tbody>
    </table>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
