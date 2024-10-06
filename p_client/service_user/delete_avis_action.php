<?php
ob_start();
require_once('../model/Avis.class.php');
$id=intval($_GET['id']);
$avis = new Avis(
    "",
    "",
    "",
    "",
    "",
    "",
    ""
   );

$result = $avis->supprimer($id);
// print_r($result);die();
if ($result == 1) {
    $msg = "Notice deleted successfully";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../list_avis.php?result=".$msg."&error=".$error);
} else {
    $msg = "An error occurred during the Notice of this notice, please try again";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../add_avis.php?result=".$msg."&error=".$error);
}

ob_end_clean();
?>
