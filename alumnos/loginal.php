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
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['email'])) {
  $loginUsername=$_POST['email'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "sisal.html";
  $MM_redirectLoginFailed = "erro_login.html";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_p, $p);
  
  $LoginRS__query=sprintf("SELECT email, telefono FROM alumnos WHERE email=%s AND telefono=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "int")); 
   
  $LoginRS = mysql_query($LoginRS__query, $p) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<form ACTION="<?php echo $loginFormAction; ?>" id="form1" name="form1" method="POST">
  <table width="392" height="120" border="1">
    <tbody>
      <tr>
        <th width="178" height="53" scope="row">LOGIN</th>
        <td width="198"><input type="email" name="email" id="email"></td>
      </tr>
      <tr>
        <th scope="row">PASSWORD</th>
        <td><input type="password" name="password" id="password"></td>
      </tr>
      <tr>
        <th scope="row">&nbsp;</th>
        <td><p>
          <input type="submit" name="submit" id="submit" value="Enviar">
        </p></td>
      </tr>
    </tbody>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
