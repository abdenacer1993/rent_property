<?php
ob_start();
require_once('../model/Utilisateur.class.php');
$user = new Utilisateur($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['password'],$_POST['telephone'],$_POST['cin'],$_POST['date_naissance'],$_POST['statut']);
// print_r($_POST['nom']);die("tessssssssst");
$user->supprimer();

if ($user) {
    $msg =  "The user has been successfully deleted.";
    $msg = $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../list_users.php?result=".$msg."&error=".$error);
}else{
    $msg = "An error occurred during the deletion of this user, please try again later";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../list_users.php?result=".$msg."&error=".$error);
}

?>