<?php
ob_start();
require_once('../model/Utilisateur.class.php');
$user = new Utilisateur($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['password'],$_POST['telephone'],$_POST['cin'],$_POST['date_naissance'],$_POST['statut']);

$result = $user->ajouter();

if ($result == 1) {
    $msg = "Utilisateur ajouer avec succes";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../list_administrator.php?result=".$msg."&error=".$error);
} elseif ($result == -1) {
    $msg = "Une erreur s'est produite lors de l'ajout de cet utilisateur, veuillez réessayer";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../add_administrator.php?result=".$msg."&error=".$error);
} else {
    $msg = "Email <strong>".$_POST['email']."</strong>  est déjà utilisé, veuillez réessayer avec une autre adresse e-mail";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../add_administrator.php?result=".$msg."&error=".$error);
}

ob_end_clean();
?>
