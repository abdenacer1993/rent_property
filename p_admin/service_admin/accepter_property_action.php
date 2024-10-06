<?php
include('../includes/connect_db.php');

ob_start();
require_once('../model/Annonce.class.php');
session_start(); // Start the session
$id_post = $_GET['id'];
// print_r($id_post);die();
$poste = $bdd->query("SELECT * FROM annonce where annonceID = $id_post");

// Get the user's data from the database
$data = $poste->fetch();
// print_r($data);die();
$id = $data['utilisateurID'];
$title = $data['title'];
$categorie =  $data['categorie'];
$taille = $data['taille'];
$bed_room = $data['chambre'];
$bath_room = $data["salle_bain"];
$price = $data['prix'];
$description = $data[ 'description'];
$full_name = $data['nom_prenom'];
$email = $data['email'];
$phone = $data['telephone'];
$image = $data['image'];
$accepter = 'Accept';
$currentDate = $data['date_publication'];
$adresse = $data['adresse'];





$post = new Annonce ($id,$title,$categorie,$taille,$bed_room,$bath_room,$price,$description,$full_name,$email,$phone,$image,$accepter,$currentDate,$adresse);
// print_r($post);die();
$result = $post->edit($id_post);
// print_r($result);die();

if ($result == 1) {
    $msg = "Propertie accepter";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../list_property.php?result=".$msg."&error=".$error);
} else{
    $msg = "Une erreur s'est produite lors de l'acceptation de ce bien, veuillez réessayer";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../list_property.php?result=".$msg."&error=".$error);
} 

ob_end_clean();
?>
