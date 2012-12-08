<?php
require_once("../bd/constant.php");
$username = $_POST['username'];
$password = $_POST['password'];
echo Query::login($username, $password);
?>
