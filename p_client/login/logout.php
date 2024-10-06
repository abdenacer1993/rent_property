<?php

session_start();
$_SESSION = array();
session_destroy();
setcookie('token', '', time() - 3600, '/'); // Change 'token' to your session cookie name if different

// Redirect to the login page or any other page
header('Location: ./login.php'); // Change 'login.php' to your login page URL
exit();
?>
