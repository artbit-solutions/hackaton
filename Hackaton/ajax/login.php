<?php
require_once("includes.php");
$username = $_POST['username'];
$password = $_POST['password'];
$login = Query::login($username, $password);
if (!$login) $admin = 0;
else $admin = $_SESSION['admin'];
echo json_encode(array('result' => $login, 'admin' => $admin));
?>
