<?php
ob_start();
require_once('../model/Avis.class.php');
$currentDate = date("Y-m-d H:i:s");  // Get the current date and time
if ($_POST['annonceID']==null) {
    $id_annonce = 0;
} else {
    $id_annonce=$_POST["annonceID"];
}
$avis = new Avis(
    $id_annonce,
    $currentDate,
    $_POST['text'],
    $_POST['utilisateurID'],
    $_POST['full_name'],
    $_POST['email'],
    "0"
    
);
// print_r($avis);die();
$result = $avis->ajouter();
// print_r($result);die();
if ($result == 1) {
    $msg = "Notice added successfully";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../property_details.php?id=".$id_annonce);
} else {
    $msg = "An error occurred during the addition of this notice, please try again";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../property_details.php?id=".$id_annonce);
}

ob_end_clean();
?>
