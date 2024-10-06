<?php
include('../includes/connect_db.php');
ob_start();
require_once('../model/Contact.class.php');
$id = $_GET['id']; 
// print_r($id);die();
    $req_read = $bdd->prepare("SELECT * FROM contact WHERE contactID = :id");
    $req_read->bindParam(':id', $id, PDO::PARAM_INT);
    $req_read->execute();
    $read_msg = $req_read->fetch(PDO::FETCH_ASSOC);
$msg = new Contact(
    $read_msg['nom_prenom'],
    $read_msg['email'],
    $read_msg['sujet'],
    $read_msg['msg'],
    $read_msg['date'],
    "1",
    "lu par ".$read_msg['nom_prenom']." ,email:".$read_msg['email']
    
);

$result = $msg->edit($id);
// print_r($result);die();
if ($result == 1) {
    // $msg = "Message added successfully";
    // $msg = base64_encode($msg);
    // $error = "false";
    // $error = base64_encode($error);
    header("location:../read_msg.php?id=".$id);
} else {
    $msg = "Message non lu";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../list_msg.php?result=".$msg."&error=".$error);
}

ob_end_clean();
?>
