<?php
ob_start();
require_once('../model/Images.class.php');

// Récupérer l'ID de l'annonce envoyé
$id_annonce = $_GET['id']; // Vérifie si id est défini

// Récupérer la date et l'heure actuelles
$currentDate = date("Y-m-d H:i:s");

// Déclarer la variable $targetFile en dehors de la boucle foreach
$targetFile = null;

// Traitement des images téléchargées
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["images"])) {
    $images = $_FILES["images"];
    $uploadDir = '../../p_admin/img/imgfromBD/images/'.$id_annonce."/";
    // Check if the directory exists, if not, create it
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Creates the directory recursively with full permissions
    }
    $uploadedFiles = array(); // Array pour stocker les chemins des fichiers téléchargés

    foreach ($images["name"] as $key => $name) {
        $tempName = $images["tmp_name"][$key];
        $filename = uniqid() . "-" . time();
    
        // Get the file extension from the original file name
        $extension = pathinfo($name, PATHINFO_EXTENSION);
    
        // Concatenate filename and extension
        $basename = $filename . "." . $extension;
        $targetFile = $uploadDir . $basename;
    
        if (move_uploaded_file($tempName, $targetFile)) {
            // Image uploaded successfully, store just the filename
            $uploadedFiles[] = $basename;
            echo "Image $name uploaded successfully.<br>";
        } else {
            // Error uploading image
            $error = error_get_last();
            echo "Error uploading image $name: " . $error['message'] . "<br>";
            $msg = "Error uploading image $name.<br>";
            $msg = base64_encode($msg);
            $error = "true";
            $error = base64_encode($error);
            header("location:../list_property.php?result=".$msg."&error=".$error);
            exit; // Stop script execution
        }
    }
    

    // Si aucune image n'a été téléchargée, arrêter le script
    if (empty($uploadedFiles)) {
        $msg = "No images have been uploaded.";
        $msg = base64_encode($msg);
        $error = "true";
        $error = base64_encode($error);
        header("location:../add_images.php?result=".$msg."&error=".$error);
        exit; // Arrêter l'exécution du script
    }
} else {
    // Gérer le cas où aucune donnée d'image n'est soumise
    // echo "Aucune image n'a été téléchargée.";
    $msg = "No images have been uploaded.";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../add_images.php?result=".$msg."&error=".$error);
    exit; // Arrêter l'exécution du script
}

// Créer une instance de la classe Images avec les données reçues
$image = new Images(
    $id_annonce,
    $_POST['title'],
    $_POST['categorie'],
    $uploadedFiles, // Utiliser les chemins des images téléchargées
    $currentDate
);
// print_r($image);die();
// Appeler la méthode pour ajouter l'image
$result = $image->ajouter();
// print_r($result);die();
if ($result == 1) {
    // Si l'ajout réussit, rediriger vers la page de liste avec un message de succès
    $msg = "Your property was successfully added.Wait for confirmation from the administrator";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("location:../list_property.php?result=".$msg."&error=".$error);
} else {
    // Si une erreur se produit, rediriger vers la page d'ajout avec un message d'erreur
    $msg = "An error occurred when adding this property, please try again.";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../add_images.php?result=".$msg."&error=".$error);
}

// Nettoyer le tampon de sortie
ob_end_clean();
?>
