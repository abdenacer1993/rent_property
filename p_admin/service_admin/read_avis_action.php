<?php
include('../includes/connect_db.php');
ob_start();
require_once('../model/Avis.class.php');
$id = $_GET['id']; 
// print_r($id);die();
    $req_read_avis = $bdd->prepare("SELECT * FROM avis WHERE avisID = :id");
    $req_read_avis->bindParam(':id', $id, PDO::PARAM_INT);
    $req_read_avis->execute();
    $read_avis = $req_read_avis->fetch(PDO::FETCH_ASSOC);
$msg = new Avis(
    $read_avis['annonceID'],
    $read_avis['date'],
    $read_avis['text'],
    $read_avis['utilisateurID'],
    $read_avis['nom_prenom'],
    $read_avis['email'],
    "1"
    
);

$result = $msg->edit($id);
// print_r($result);die();
if ($result == 1) {
    // $msg = "Message added successfully";
    // $msg = base64_encode($msg);
    // $error = "false";
    // $error = base64_encode($error);
    header("location:../read_avis.php?id=".$id);
} else {
    $msg = "Message not readed";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../list_avis.php?result=".$msg."&error=".$error);
}

ob_end_clean();
?>
