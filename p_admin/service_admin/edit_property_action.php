<?php
ob_start();
require_once('../model/Annonce.class.php');
session_start(); // Start the session
$id = $_SESSION['id'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];
$phone = $_SESSION['telephone'];
$currentDate = date("Y-m-d H:i:s");
$id_post = $_POST['id_post'];
$image__ = $_POST['image__'];

// print_r($image__);die();

if ($_FILES["file"]["error"] == UPLOAD_ERR_NO_FILE) {
    // No file uploaded, use the default image or handle the case accordingly
    $img = $_POST['image__'];
} else {
    // Check if file was uploaded successfully
    if (isset($_FILES["file"])) {
        // Create a unique filename
        $filename = uniqid() . "-" . time();

        // Get the file extension
        $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

        // Concatenate filename and extension
        $basename = $filename . "." . $extension;

        // Define the directory path to move the uploaded file
        $directory = "../img/imgfromBD/";

        // Define the full path to the uploaded file
        $filePath = $directory . $basename;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
            // File uploaded successfully
            echo "File uploaded successfully!";
            $img = $filePath;
        } else {
            // Failed to move uploaded file
            echo "Failed to move uploaded file.";
        }
    } else {
        // No file uploaded or file input field not named "file"
        echo "No file uploaded or file input field not named 'file'.";
    }
}





$post = new Annonce ($id,$_POST['title'],$_POST['categorie'],$_POST['taille'],$_POST['bed_room'],$_POST['bath_room'],$_POST['price'],$_POST['description'],$nom." ".$prenom,$email,$phone,$img,$_POST['etat'],$currentDate);
// print_r($post);die();
$result = $post->edit($id_post);
// print_r($result);die();

if ($result == 1) {
    $msg = "Property edited successfully";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../list_property.php?result=".$msg."&error=".$error);
} else{
    $msg = "An error occurred during the edition of this property, please try again";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../add_property.php?result=".$msg."&error=".$error);
} 

ob_end_clean();
?>
