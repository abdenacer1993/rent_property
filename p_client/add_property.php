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




?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Add property | Location</title>

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
          <span class="breadcrumb"><a href="index.php">Home</a>  /  Add property</span>
          <h3>Add property</h3>
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

            <form action="./service_user/add_property_action.php" method="post" enctype="multipart/form-data">
                                
                                <div class="mb-3">
                                    <label for="fsname" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" required id="fsname"
                                        aria-describedby="nameHelp">
                                    
                                </div>
                                
                                <div class="mb-3">
                                    <label for="Status" class="form-label">Categorie</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="categorie" required id="Status">
                                    <option selected>Select categorie</option>
                                    <option value="House">Maison</option>
                                    <option value="Apartment">Appartment</option>
                                    <option value="Student housing">Logement étudiant</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputtaille1" class="form-label">Taille</label>
                                    <input type="number" class="form-control" name="taille" required id="exampleInputtaille1"
                                        aria-describedby="tailleHelp">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="bed_room" class="form-label">Chambre</label>
                                    <input type="number" class="form-control" name="bed_room" required id="bed_room"
                                        aria-describedby="bed_roomHelp">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="bath_room" class="form-label">Salle de bain</label>
                                    <input type="number" class="form-control" name="bath_room" required id="beth_room"
                                        aria-describedby="bed_roomHelp">
                                    
                                </div>


                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" name="adresse" required id="adresse"
                                        aria-describedby="nameHelp">
                                    
                                </div>
                                

                                <div class="mb-3">
                                    <label for="price" class="form-label">prix</label>
                                    <input type="number" class="form-control" name="price" required id="price"
                                        aria-describedby="numberHelp">
                                    
                                </div>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Image principale</label>
                                    <input class="form-control" type="file" name="file" id="fileToUpload" onchange="displayImage()">
                                    <br>
                                    <span id="upload_image" style="max-width: 200px;display: block;"></span>
                                </div>

                                <div class="form-floating mb-3">
                                    
                                    <textarea class="form-control" name="description" placeholder="Leave a comment here"
                                        id="floatingTextarea" style="height: 150px;"></textarea>
                                    <label for="floatingTextarea">Description</label>
                                </div>                               
                                

                                
                                <button type="submit" id="submitButton" class="btn btn-primary">Sauvgarder</button>
                                
                            </form>
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
  <script src="./assets/js/showImg.js"></script>

  </body>
</html>