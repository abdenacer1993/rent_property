<?php
include('./includes/connect_db.php');
session_start(); // Start the session

$token = $_SESSION['token'];
$id = $_SESSION['id'];

// Check if the token doesn't exist
if (!$token) {
    $msg = 'Please login first';
    $msg = base64_encode($msg);

    // Redirect to login page with error message
    header('location: ./login/login.php?result=' . $msg);
    exit; // Stop further execution
} 



if (isset( $_GET["id"])) {
    $id_annonce = $_GET["id"];
    $annonce = $bdd->query("SELECT * FROM annonce where  annonceID=".$id_annonce."");
    $data=$annonce -> fetch();
    $title = $data['title'];
    $categorie = $data['categorie'];
    

}else{
    
    $msg = 'Data not found';
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    // Redirect to property page with error message
    header("location:../liste_property.php?result=".$msg."&error=".$error);
    exit; // Stop further execution
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>My listing | Location</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

 <!--  Header start -->

 <?php include("./includes/header.php"); ?>
 
 <!-- Header end -->

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="index.php">Home</a>  /  Add pictures</span>
          <h3>Add pictures</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page section">
    <div class="container">
      <div class="row">
        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
                <?php 
                // Check if 'error' and 'result' parameters are set in the URL
                if (isset($_GET['error']) && base64_decode($_GET['error']) == "true" && isset($_GET['result'])) {
                    $msg = $_GET['result'];
                    $msg = base64_decode($msg);
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i><?= $msg ?>!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                } else if (isset($_GET['result'])) { // Check if only 'result' parameter is set
                    $msg = $_GET['result'];
                    $msg = base64_decode($msg);
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i><?= $msg ?>!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    } 
                ?>

                    <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Add pictures to <?= $categorie?></h6>
                            <h6><?= $title ?></h6>
                            <form action="./service_user/add_image_action.php?id=<?= $id_annonce?>" method="post" enctype="multipart/form-data">
                                
                                <input type="hidden" name="title" value="<?= $title?>">
                                <input type="hidden" name="categorie" value="<?= $categorie?>">
                                
                                
                                
                                
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Pictures</label>
                                <input class="form-control" type="file" name="images[]" id="formFileMultiple" multiple accept="image/*" onchange="previewImages(this)">
                                
                                <span class="mt-2 mr-2 d-flex" id="listImage" style=""></span>
                            </div>

                                
                            <button type="submit" id="submitButton" class="btn btn-primary" disabled>Add pictures</button>     
                        
                        </form>
                        </div>
            </div>
            <!-- Recent Sales End -->
      </div>
    </div>
  </div>

 <!-- footer start -->
 <?php include('./includes/footer.php'); ?>
  <!--  footer end -->

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>
  <script>
 function previewImages(fileInput) {
    var fileList = fileInput.files;
    var listImage = document.getElementById("listImage");
    listImage.innerHTML = "";

    for (var i = 0; i < fileList.length; i++) {
        var file = fileList[i];
        if (file.type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = function(event) {
                var img = document.createElement("img");
                img.src = event.target.result;
                img.style.maxWidth = "100%";
                img.style.maxHeight = "100%";
                img.style.marginRight = "5px";
                listImage.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    }

    // Activer le bouton de soumission si des images sont sélectionnées
    var submitButton = document.getElementById('submitButton');
    submitButton.disabled = fileList.length !== fileList.length;
    
}

function submitForm() {
    document.getElementById("imageForm").submit();
}
</script>


  </body>
</html>