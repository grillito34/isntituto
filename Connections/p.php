<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_p = "127.0.0.1";
$database_p = "instituto";
$username_p = "root";
$password_p = "";
$p = mysql_pconnect($hostname_p, $username_p, $password_p) or trigger_error(mysql_error(),E_USER_ERROR); 
?>