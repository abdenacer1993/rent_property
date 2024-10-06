<?php
ob_start();
require_once('../model/Demande.class.php');
session_start( ); 
$id=$_GET['id'];
$demande = new Demande(
    "",
    "",
    "",
    "",
    "",
    "",
    "",
    "",
    ""
    
);
// print_r($demande);die();
$result = $demande->supprimer($id);
// print_r($result);die();
if ($result == 1) {
    $msg = "Deleted successfully from the list !";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../list_demande.php?result=".$msg."&error=".$error);
} else {
    $msg = "An error occurred during the deletion of this request, please try again";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../list_demande.php?result=".$msg."&error=".$error);
}

ob_end_clean();
?>
