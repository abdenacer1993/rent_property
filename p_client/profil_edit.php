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

$id = $_SESSION['id'];
$req = $bdd->query("SELECT * FROM utilisateur where utilisateurID = $id");
$donnees = $req->fetch();
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$statut = $_SESSION['statut'];
$email = $_SESSION['email'];
$phone = $_SESSION['telephone'];
$birth_day = $_SESSION['date_naissance'];
$formatted_birth_day = date('Y-m-d', strtotime($birth_day));
// print_r($birth_day);die();
$cin =  $_SESSION['cin'];
$password = $donnees['password'];

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Edit Profile | Location</title>

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
          <span class="breadcrumb"><a href="index.php">Home</a>  /  Edit profile</span>
          <h3>Edit profile</h3>
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
                            <h6 class="mb-4">Edit user</h6>
                            <form action="./service_user/edit_action.php" method="post">
                                <input type="hidden" value="<?=$id?>" name="id">
                                <div class="mb-3">
                                    <label for="fsname" class="form-label">First name</label>
                                    <input type="text" class="form-control" name="nom" value="<?= $nom ?>" required id="fsname"
                                        aria-describedby="nameHelp">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="lsname" class="form-label">Last name</label>
                                    <input type="text" class="form-control" name="prenom" value=" <?= $prenom ?>" required id="lsname"
                                        aria-describedby="nameHelp">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= $email?>" required id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone number</label>
                                    <input type="number" class="form-control" name="telephone" value="<?= $phone?>" required id="phone"
                                        aria-describedby="phoneHelp">
                                    
                                </div>
                                <input type="hidden" name="statut"  value="<?= $statut?>"/>
                                

                                <div class="mb-3">
                                    <label for="date" class="form-label">Date of birth</label>
                                    <input type="date" class="form-control" name="date_naissance" value="<?= $formatted_birth_day ?>" required id="date"
                                        aria-describedby="dateHelp">
                                    
                                </div>

                                <div class="mb-3">
                                    <label for="cin" class="form-label">Identity card</label>
                                    <input type="number" class="form-control" name="cin" value="<?= $cin?>" required id="cin"
                                        aria-describedby="numberHelp">
                                    
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" value="<?= $password?>" required id="exampleInputPassword1">
                                    <span id="min_number_error"class="mt-2"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword2" class="form-label">Confirm password</label>
                                    <input type="password" class="form-control" name="password" value="<?= $password?>" required id="exampleInputPassword2">
                                    <span id="match_error"class="mt-2"></span>
                                </div>
                                

                                
                                <button type="submit" id="submitButton" class="btn btn-primary">Edit</button>
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
  <style>
    .contact-page p {
    margin-bottom: 10px;
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