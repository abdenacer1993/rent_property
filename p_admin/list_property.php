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



$poste = $bdd->query("SELECT * FROM annonce order by annonceID DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>List property | Location</title>
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

                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Liste propertie</h6>
                        <a href="">Show All</a>
                    </div>
                    <?php if ($poste->rowCount() == 0) {
                        echo "No result found.";
                    }else{?>
                    <div class="table-responsive" style="    min-height: 300px;">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Image</th>
                                    <th scope="col">Titre</th>
                                    <th scope="col">Publier par</th>
                                    <th scope="col">Categorie</th>
                                    <th scope="col">Chambre</th>
                                    <th scope="col">Salle de bain</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($list_post=$poste->fetch())
                                                    {

                                                      ?>
                                <tr>
                                    
                                    <td ><img src="./img/imgfromBD/<?= $list_post['image'] ?>" style="width:150px"></td>
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
                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Detail
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: auto;">
                                            <li>
                                                <a class="dropdown-item" href="./property_edit.php?id=<?= $list_post['annonceID'] ?>">Edit</a>
                                            </li>
                                            
                                            <li>
                                                <a class="dropdown-item" href="./add_images.php?id=<?= $list_post['annonceID'] ?>">Add pictures</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item accept-link" href="./service_admin/accepter_property_action.php?id=<?= $list_post['annonceID'] ?>">Accept property</a>
                                            </li>
                                            
                                            <li>
                                                <a class="dropdown-item refuse-link" href="./service_admin/refuse_property_action.php?id=<?= $list_post['annonceID'] ?>">Refuse property</a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item delete-link" href="./service_admin/delete_property_action.php?id=<?= $list_post['annonceID'] ?>">Delete</a>
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
    <script src="js/sweetAlert.js"></script>
</body>

</html>