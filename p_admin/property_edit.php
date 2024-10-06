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

$id=intval($_GET["id"]);
// Check if the annonce ID doesn't exist
if (!$id) {
    $msg = "The annonce doesn't exist";
    $msg = base64_encode($msg);

    // Redirect to login page with error message
    header("location:./list_property.php?result=".$msg."&error=".$error);
    exit; // Stop further execution
} 


$poste = $bdd->query("SELECT * FROM annonce where annonceID=$id");
$donnee  = $poste->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit property | Location</title>
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
                            <h6 class="mb-4">Edit property</h6>
                            <form action="./service_admin/edit_property_action.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_post" value="<?=$donnee['annonceID']?>">
                                <input type="hidden" name="image__" value="<?=$donnee['image']?>">
                                <input type="hidden" name="etat" value="<?=$donnee['etat']?>">
                                <div class="mb-3">
                                    <label for="fsname" class="form-label">Title</label>
                                    <input type="text" class="form-control" value="<?= $donnee['title']?>" name="title" required id="fsname"
                                        aria-describedby="nameHelp">
                                    
                                </div>
                                
                                <?php
                                // Assuming you have retrieved categories from the database and stored them in an array called $categories
                                $categories = array("House", "Apartment", "Student housing");

                                // You can replace the above array with actual data fetched from the database

                                // Generate the <option> tags dynamically
                                $options = "";
                                foreach ($categories as $category) {
                                    $selected = ($category == $donnee['categorie']) ? "selected" : "";
                                    $options .= "<option value='$category' $selected>$category</option>";
                                }
                                ?>

                                <div class="mb-3">
                                    <label for="Status" class="form-label">Categorie</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="categorie" required id="Status">
                                        <option value="" disabled>Select categorie</option>
                                        <?php echo $options; ?>
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <label for="exampleInputtaille1" class="form-label">Size</label>
                                    <input type="number" class="form-control" value="<?= $donnee['taille']?>" name="taille" required id="exampleInputtaille1"
                                        aria-describedby="tailleHelp">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="bed_room" class="form-label">Bedroom</label>
                                    <input type="number" class="form-control" value="<?= $donnee['bed_room']?>" name="bed_room" required id="bed_room"
                                        aria-describedby="bed_roomHelp">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="bath_room" class="form-label">Bethroom</label>
                                    <input type="number" class="form-control" value="<?= $donnee['bath_room']?>" name="bath_room" required id="beth_room"
                                        aria-describedby="bed_roomHelp">
                                    
                                </div>

                                

                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" value="<?= $donnee['price']?>" name="price" required id="price"
                                        aria-describedby="numberHelp">
                                    
                                </div>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Main picture</label>
                                    <input class="form-control" type="file"  name="file" id="fileToUpload">
                                    </br>
                                    <span id="upload_image"><img src="./img/imgfromBD/<?= $donnee['image']?>" style="width: 200px;"></span>
                                </div>

                                <div class="form-floating mb-3">
                                    
                                    <textarea class="form-control" name="description" placeholder="Leave a comment here"
                                        id="floatingTextarea" style="height: 150px;"><?= $donnee['description']?></textarea>
                                    <label for="floatingTextarea">Description</label>
                                </div>                               
                                

                                
                                <button type="submit" id="submitButton" class="btn btn-primary">Add property</button>
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
    <script src="js/img.js"></script>
   
  
    
</body>

</html>