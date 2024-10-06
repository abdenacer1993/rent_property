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



$poste = $bdd->query("SELECT * FROM annonce where utilisateurID=$id order by annonceID DESC");
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
          <span class="breadcrumb"><a href="index.php">Home</a>  /  My listing</span>
          <h3>My listing</h3>
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

                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">List property</h6>
                        <a href="">Show All</a>
                    </div>
                    <?php if ($poste->rowCount() == 0) {
                        echo "No result found.";
                    }else{?>
                    <div class="table-responsive" style="    min-height: 300px;">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Picture</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Publish by</th>
                                    <th scope="col">Categorie</th>
                                    <th scope="col">Bedrooms</th>
                                    <th scope="col">Bathrooms</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($list_post=$poste->fetch())
                                                    {

                                                      ?>
                                <tr>
                                    
                                    <td ><img src="../p_admin/img/imgfromBD/<?= $list_post['image'] ?>" style="width:150px"></td>
                                    <td ><?= $list_post['title']?></td>
                                    <td ><?= $list_post['nom_prenom'] ?></td>
                                    <td ><?= $list_post['categorie'] ?></td>
                                    <td ><?= $list_post['chambre']?></td>
                                    <td ><?= $list_post['salle_bain'] ?></td>
                                    <td ><?= $list_post['prix'] ?></td>
                                    <td style="color: <?= $list_post['etat'] == 'Accept' ? 'green' : ($list_post['etat'] == 'Refuse' ? 'red' : 'orange') ?>;">
                                    <?= $list_post['etat'] == 'Accept' ? 'Accepter' : ($list_post['etat'] == 'Refuse' ? 'Refuser' : 'En attente') ?>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary habitha " type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Detail
                                            </button>
                                            <ul class="dropdown-menu tahbita" aria-labelledby="dropdownMenuButton" style="min-width: auto;right: 0px;">
                                            <li>
                                                <a class="dropdown-item" href="./property_edit.php?id=<?= $list_post['annonceID'] ?>">Modifier</a>
                                            </li>
                                            
                                            <li>
                                                <a class="dropdown-item" href="./add_images.php?id=<?= $list_post['annonceID'] ?>">Ajouter images</a>
                                            </li>
                                            

                                            <li>
                                                <a class="dropdown-item delete-link" href="./service_user/delete_property_action.php?id=<?= $list_post['annonceID'] ?>">Delete</a>
                                            </li>

                                        </ul>
                                        </div>
                                    </td>


                                </tr>
                                <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <?php }?>
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
    document.addEventListener("DOMContentLoaded", function() {
        // Get all dropdown toggle buttons
        var dropdownToggles = document.querySelectorAll('.habitha');

        // Add click event listener to each toggle button
        dropdownToggles.forEach(function(dropdownToggle) {
            dropdownToggle.addEventListener('click', function() {
                // Get the corresponding dropdown menu
                var dropdownMenu = this.nextElementSibling;

                // Toggle the 'show' class on the dropdown menu
                dropdownMenu.classList.toggle('show');
            });
        });

        // Close the dropdown when clicking outside of it
        window.addEventListener('click', function(event) {
            // Get all dropdown menus
            var dropdownMenus = document.querySelectorAll('.tahbita');

            // Check if the click is outside any dropdown toggle and dropdown menu
            dropdownMenus.forEach(function(dropdownMenu) {
                if (!dropdownMenu.previousElementSibling.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    // Remove the 'show' class from the dropdown menu
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    });
</script>

</script>

  </body>
</html>