<?php
ob_start();
require_once('../model/Utilisateur.class.php');
$user = new Utilisateur($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['password'],$_POST['telephone'],$_POST['cin'],$_POST['date_naissance'],$_POST['statut']);
// print_r($user);die();
$result = $user->modifier($_POST['id']);

if ($result == 1) {
    $msg = "User edited successfully";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../profile.php?result=".$msg."&error=".$error);
} else {
    $msg = "An error occurred during the edition of this user, please try again";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../profil_edit.php?result=".$msg."&error=".$error);
} 

ob_end_clean();
?>
