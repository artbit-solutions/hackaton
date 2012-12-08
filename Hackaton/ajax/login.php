<?php
require_once("includes.php");
$username = $_POST['username'];
$password = $_POST['password'];
echo Query::login($username, $password);
?>
