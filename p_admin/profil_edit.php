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
    <title>Edit user | Location</title>
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
                            <h6 class="mb-4">Edit user</h6>
                            <form action="./service_admin/edit_action.php" method="post">
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
                                <!-- <div class="mb-3">
                                    <label for="Status" class="form-label">Status</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="statut" required id="Status">
                                    <option selected>Select status</option>
                                    <option value="locataire">Locataire</option>
                                    <option value="propriétaire">Propriétaire</option>
                                    </select>
                                </div> -->

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
                                

                                
                                <button type="submit" id="submitButton" class="btn btn-primary">Save</button>
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
   // Function to check password match
   function checkPasswordMatch() {
    var password1 = document.getElementById("exampleInputPassword1").value;
    var password2 = document.getElementById("exampleInputPassword2").value;
    var minNbrError = document.getElementById("min_number_error");
    var matchError = document.getElementById("match_error");
    var submitButton = document.getElementById("submitButton");


    // Check if passwords have at least 8 characters
    if (password1.length < 8) {
        minNbrError.textContent = "The password must contain at least 8 characters!";
        minNbrError.style.color = "red";
        submitButton.disabled = true;
    } else {
        minNbrError.textContent = "Password is valid."; // Clear the error message if the condition is met
        minNbrError.style.color = "green";
        submitButton.disabled = false;
    }

    // Check if passwords match
    if (password1 !== password2) {
        matchError.textContent = "Passwords do not match!";
        matchError.style.color = "red";
        submitButton.disabled = true;
    }else if (password2 == ""){
        matchError.textContent = "";
    } 
    else {
        
            matchError.textContent = "Passwords matched. You can register now.";
            matchError.style.color = "green";
            submitButton.disabled = false;
    }
    }




    // Event listeners to check password match on input change
    document.getElementById("exampleInputPassword1").addEventListener("input", checkPasswordMatch);
    document.getElementById("exampleInputPassword2").addEventListener("input", checkPasswordMatch);

    // Prevent form submission on Enter key press
    document.getElementById("passwordForm").addEventListener("keypress", function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
        }
    });
</script>
    
</body>

</html>