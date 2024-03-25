<?php
session_start();

$_SESSION = array();

session_destroy();

header("Location: register_login.php");
exit;
?>
