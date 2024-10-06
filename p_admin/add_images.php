<?php
include('./includes/connect_db.php');
session_start(); // Start the session

$token = $_SESSION['token'];

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
    <title>ajouter images | Location</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include('includes/nav.php')?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php  include("includes/header.php") ?>
            <!-- Navbar End -->


            

           


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
                            <h6 class="mb-4">Ajouter des images à <?= $categorie?></h6>
                            <h6><?= $title ?></h6>
                            <form action="./service_admin/add_image_action.php?id=<?= $id_annonce?>" method="post" enctype="multipart/form-data">
                                
                                <input type="hidden" name="title" value="<?= $title?>">
                                <input type="hidden" name="categorie" value="<?= $categorie?>">
                                
                                
                                
                                
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Images</label>
                                <input class="form-control" type="file" name="images[]" id="formFileMultiple" multiple accept="image/*" onchange="previewImages(this)">
                                
                                <span class="mt-2 mr-2 d-flex" id="listImage" style="flex-wrap: wrap;
    row-gap: 5px;"></span>
                            </div>

                                
                            <button type="submit" id="submitButton" class="btn btn-primary" disabled>Ajouter Images</button>     
                        
                        </form>
                        </div>
                    </div>
            <!-- Recent Sales End -->


           


            <!-- Footer Start -->
            <?php include('includes/footer.php'); ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
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
                img.style.maxWidth = "100px";
                img.style.maxHeight = "100px";
                img.style.marginRight = "5px";
                listImage.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    }

    // Activer le bouton de soumission si des images sont sélectionnées
    var submitButton = document.getElementById('submitButton');
    submitButton.disabled = fileList.length === 0;
}

function submitForm() {
    document.getElementById("imageForm").submit();
}

    </script>
 
    
</body>

</html>