<?php
require_once("../bd/constant.php");
$username = mysql_real_escape_string($_POST['$username']);
$password = mysql_real_escape_string($_POST['$password']);

echo Query::login($username, $password);
?>
