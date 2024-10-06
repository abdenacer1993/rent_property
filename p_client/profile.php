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



    // If id is not provided in the URL, use session data
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $statut = $_SESSION['statut'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['telephone'];
    $birth_day = $_SESSION['date_naissance'];
    $cin =  $_SESSION['cin'];
    $btn = true;


// Now you can use $nom, $prenom, $statut, $email, $phone, $birth_day, $cin, and $btn as needed
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>My profile | Location</title>

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
          <span class="breadcrumb"><a href="index.php">Home</a>  /  My profile</span>
          <h3>My profile</h3>
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

<div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="https://via.placeholder.com/150" alt="Profile Picture" class="img-thumbnail">
            </div>
            <div class="col-md-9">
                <h3 class="text-capitalize">Welcome <?= $nom ." ". $prenom?></h3>
                <p>Your status: <strong><?= $statut ?></strong></p>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Like</button>
                    <button type="button" class="btn btn-primary">Message</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12  mt-4">
                <h4>Details</h4>
                <div class="card pflcard">
                    <div class="col-md-6">
                        <div class="card-body">
                            <p class="card-title"><strong>Full name</strong></p>
                            <p class="card-text text-capitalize"><?= $nom ." ". $prenom?></p>
                            <p class="card-title"><strong>Adresse mail</strong></p>
                            <p class="card-text"><?= $email?></p>
                            <p class="card-title"><strong>Phone number</strong></p>
                            <p class="card-text"><?= $phone?></p>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <p class="card-title"><strong>Identity card</strong></p>
                            <p class="card-text"><?= $cin?></p>
                            <p class="card-title"><strong>Date of birth</strong></p>
                            <p class="card-text"><?= $birth_day?></p>
                            <p class="card-title"><strong>Status</strong></p>
                            <p class="card-text text-capitalize"><?= $statut?></p>
                            <?php if ($btn==true){?>
                            <a href="./profil_verif_edit.php" class="btn btn-primary">Edit profile</a>
                            <?php }?>
                        </div>
                    </div>
                    
                </div>
                <!-- Add more posts here -->
            </div>
        </div>
    </div>
            </div>

            <!-- Recent Sales End -->
      </div>
    </div>
  </div>

 <!-- footer start -->
 <?php include('./includes/footer.php'); ?>
  <!--  footer end -->
  <style>
    .contact-page p {
    margin-bottom: 10px;
}
    @media (min-width: 768px) {
        .pflcard{
            flex-direction: row;
        }
    }
</style>
  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>
  


  </body>
</html>