<?php
ob_start();
require_once('../model/Contact.class.php');
$id=intval($_GET['id']);
$msgg = new Contact(
    "",
    "",
    "",
    "",
    "",
    "",
    ""
    
);

$result = $msgg->supprimer($id);
// print_r($result);die();
if ($result == 1) {
    $msg = "Message deleted successfully";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../list_msg.php?result=".$msg."&error=".$error);
} else {
    $msg = "An error occurred during the deleted of this message, please try again";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../add_msg.php?result=".$msg."&error=".$error);
}

ob_end_clean();
?>
