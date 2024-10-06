<?php 

require_once('../Model/CnxAdmin.class.php');

$admin = new CnxAdmin($_POST['email'],$_POST['password']);
$admin->verifier();

?>
