<?php
ob_start();
require_once('../model/Utilisateur.class.php');
$user = new Utilisateur($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['password'],$_POST['telephone'],$_POST['cin'],$_POST['date_naissance'],$_POST['statut']);

$result = $user->ajouter();

if ($result == 1) {
    $msg = "User added successfully";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../list_users.php?result=".$msg."&error=".$error);
} elseif ($result == -1) {
    $msg = "An error occurred during the addition of this user, please try again";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../add_users.php?result=".$msg."&error=".$error);
} else {
    $msg = "This email <strong>".$_POST['email']."</strong>  is already in use, please try again with another email address";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../add_users.php?result=".$msg."&error=".$error);
}

ob_end_clean();
?>
