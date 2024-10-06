<?php
ob_start();
require_once('../model/Contact.class.php');
$currentDate = date("Y-m-d H:i:s");  // Get the current date and time
$msgg = new Contact(
    $_POST['full_name'],
    $_POST['email'],
    $_POST['sujet'],
    $_POST['msg'],
    $currentDate,
    "0",
    "No one"
    
);

$result = $msgg->ajouter();
// print_r($result);die();
if ($result == 1) {
    $msg = "Message added successfully";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../list_msg.php?result=".$msg."&error=".$error);
} else {
    $msg = "An error occurred during the addition of this message, please try again";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../add_msg.php?result=".$msg."&error=".$error);
}

ob_end_clean();
?>
