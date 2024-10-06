<?php
ob_start();
require_once('../model/Annonce.class.php');
$id = $_GET['id'];
if(isset($id)){
    $post = new Annonce ("","","","","","","","","","","" ,"","","");

    // print_r($_POST['nom']);die("tessssssssst");
    $result = $post->supprimer($id);
    // print_r($result);die();
    if ($result==1) {
        $msg =  "The property has been successfully deleted.";
        $msg = $msg = base64_encode($msg);
        $error = "false";
        $error = base64_encode($error);
        header("location:../list_property.php?result=".$msg."&error=".$error);
    }else{
        $msg = "An error occurred during the deletion of this property, please try again later";
        $msg = base64_encode($msg);
        $error = "true";
        $error = base64_encode($error);
        header("location:../list_property.php?result=".$msg."&error=".$error);
    }
}else {
    $msg = "property  id is missing !";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("location:../list_property.php?result=".$msg."&error=".$error);
}

?>