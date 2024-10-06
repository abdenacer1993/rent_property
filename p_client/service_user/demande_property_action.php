<?php
ob_start();
require_once('../model/Demande.class.php');
session_start( ); 
$currentDate = date("Y-m-d H:i:s");  // Get the current date and time
$demande = new Demande(
    $_POST['annonceID'],
    $_POST['locataireID'],
    $_POST['properietaireID'],
    $_SESSION['nom']. " " . $_SESSION['prenom'] ,
    $_SESSION['telephone'],
    'Pending',
    $currentDate,
    $_POST['checkin'],
    $_POST['checkout']
    
);
// print_r($demande);die();
$result = $demande->ajouter();
// print_r($result);die();
if ($result == 1) {
    $msg = "Added successfully,Wait for the owner to accept your request";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../list_demande.php?result=".$msg."&error=".$error);
} else {
    $msg = "An error occurred during the addition of this requst, please try again";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../list_demande.php?result=".$msg."&error=".$error);
}

ob_end_clean();
?>
