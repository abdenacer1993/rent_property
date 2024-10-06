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


   
    // Check if 'id' parameter is provided in the URL
if(isset($_GET["id"])) {
    // Convert 'id' parameter to an integer
    $id_for_req = intval($_GET["id"]);

    // Query database to fetch user information based on provided 'id'
    $req = $bdd->prepare("SELECT * FROM avis WHERE avisID = :id");
    $req->bindParam(':id', $id_for_req, PDO::PARAM_INT);
    $req->execute();
    
    // Fetch user data
    $dataUser = $req->fetch(PDO::FETCH_ASSOC);
    
    // Check if user exists
    if ($dataUser) {
        
        $annonceID = $dataUser['annonceID'];
        $date = $dataUser['date'];
        $text = $dataUser['text'];
        $full_name = $dataUser['nom_prenom'];
        $email = $dataUser['email'];
        $lu =  $dataUser['lu'];
        $btn_req = false; // You can set the value of $btn_req as needed
        
    
        // Query database to fetch user information based on provided 'id'
        $req = $bdd->prepare("SELECT * FROM annonce  WHERE annonceID = :id");
        $req->bindParam(':id', $annonceID, PDO::PARAM_INT);
        $req->execute();
        
        // Fetch annonce data
        $data_annonce = $req->fetch(PDO::FETCH_ASSOC);
        // Check if annonce exists
        if ($data_annonce) {
            $title_annonce = $data_annonce['title'];
            $name_annonceur = $data_annonce['nom_prenom'];
            $etat = $data_annonce['etat'];
            $poste_date = $data_annonce['date_publication'];
            $image = $data_annonce['image'];

        }else{
            // Handle case where property does not exist
                
            $msg = 'property not found!';
            $msg = base64_encode($msg);
            $error = "true";
            $error = base64_encode($error);

            // Redirect to list page with error message
            header('location: ./list_avis.php?result=' . $msg. "&error=".$error);
            exit; // Stop further execution
            }
    } else {
        // Handle case where user does not exist
       
        $msg = 'Notice not found!';
        $msg = base64_encode($msg);
        $error = "true";
        $error = base64_encode($error);

    // Redirect to list page with error message
    header('location: ./list_avis.php?result=' . $msg. "&error=".$error);
    exit; // Stop further execution
    }
} else {
    
    $msg = 'Notice ID not provided!';
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);

    // Redirect to list page with error message
    header('location: ./list_avis.php?result=' . $msg. "&error=".$error);
    exit; // Stop further execution
    exit;
}


// Now you can use $nom_req, $prenom_req, $statut_req, $email_req, $phone_req, $birth_day_req, $cin_req, and $btn_req as needed

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Read notice | Location</title>
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

<div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="./img/imgfromBD/<?= $image ?>" alt="Profile Picture" class="img-thumbnail">
            </div>
            <div class="col-md-9">
                <h5 class="text-capitalize">Noticed by <?= $full_name?></h5>
                <p>Date notice :<?= $date?></p>
                <p>Email : <?= $email?></p>
                <p>Comment :<?= $text ?></p>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12  mt-4">
                <h4>Details poste</h4>
                <div class="card pflcard">
                    <div class="col-md-6">
                        <div class="card-body">
                            <p class="card-title"><strong>Posted by</strong></p>
                            <p class="card-text text-capitalize"><?= $name_annonceur?></p>
                            <p class="card-title"><strong>Title poste</strong></p>
                            <p class="card-text"><?= $title_annonce?></p>
                            
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <?php 
                            // Given date
                            $base_date = new DateTime($poste_date);
                                        
                            // Current system date
                            $current_date = new DateTime();
                            // print_r($current_date);die();
                            // Calculate the difference
                            $difference = $current_date->diff($base_date);

                            // Print the result
                            // echo "Difference from base date:\n";
                            if ($difference->days > 0) {
                               $date_di = $difference->days . " day(s)\n";
                            }else
                            if ($difference->h > 0) {
                               $date_di = $difference->h . " hour(s)\n";
                            }else
                            if ($difference->i > 0) {
                               $date_di = $difference->i . " minute(s)\n";
                            }else
                            {
                                $date_di = $difference->s+1 . " second(s)\n";
                             }
                            
                            ?>
                            <p class="card-title"><strong>Posted date</strong></p>
                            <p class="card-text"><?= $date_di?> ago</p>
                            <p class="card-title"><strong>satuts</strong></p>
                            <p class="card-text"><?= $etat?></p>
                            
                            <?php if ($btn_req==true){?>
                            <a href="mailto:<?= $email?>" class="btn btn-primary">Reply</a>
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
    <style>
    @media (min-width: 768px) {
        .pflcard{
            flex-direction: row;
        }
    }
</style>    
</body>

</html>