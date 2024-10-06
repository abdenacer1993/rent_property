<?php 

require_once('../model/Verifpass.class.php');

$admin = new Verifpass($_POST['password']);
// print_r($_POST['password']);die();
$result = $admin->verifier_password();

if ($result == -1) {
    $msg = "Incorrect password";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../profil_verif_edit.php?result=".$msg);
}else{
    
    header("location:../profil_edit.php");
}
?>
