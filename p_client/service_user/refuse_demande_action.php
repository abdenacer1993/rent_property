<?php
ob_start();
require_once('../model/Demande.class.php');
session_start( ); 
$id = $_GET['id'];
$demande = new Demande(
    null, // Assuming you're passing the demandeID to identify the demande to modify
    null, // Pass null for other parameters that you don't want to modify
    null,
    null,
    null,
    'Refused', // Update the etat column to 'Pending'
    null,
    null,
    null
);

// print_r($demande);die();
$result = $demande->modifier($id);
// print_r($result);die();
if ($result == 1) {
    $msg = "Modification successful. Refused";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../list_demande_prop.php?result=".$msg."&error=".$error);
} else {
    $msg = "An error occurred during the modification of this request. Please try again";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../list_demande_prop.php?result=".$msg."&error=".$error);
}

ob_end_clean();
?>
