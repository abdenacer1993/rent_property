<?php
// $token = $_COOKIE['token'];
// print_r($token);die();
if (isset($_COOKIE['token'])){
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Create account | Location </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="./lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="./lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
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


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                
                <?php
                // Check if 'result' parameter is set in the URL
                if (isset($_GET['result'])) {
                    $result = $_GET['result'];
                    $decoded_result = base64_decode($result);
                    if (isset($_GET['error']) && base64_decode($_GET['error']) == "true") {
                        // Display error alert
                        ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i><?= htmlspecialchars($decoded_result) ?>!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    } else {
                        // Display success alert
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i><?= htmlspecialchars($decoded_result) ?>!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                }
                ?>
               
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                    <form action="../service_user/add_user_action.php" method="post">
                                
                                <div class="mb-3">
                                    <label for="fsname" class="form-label">First name</label>
                                    <input type="text" class="form-control" name="nom" required id="fsname"
                                        aria-describedby="nameHelp">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="lsname" class="form-label">Last name</label>
                                    <input type="text" class="form-control" name="prenom" required id="lsname"
                                        aria-describedby="nameHelp">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" required id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone number</label>
                                    <input type="number" class="form-control" name="telephone" required id="phone"
                                        aria-describedby="phoneHelp">
                                    
                                </div>

                                <div class="mb-3">
                                    <label for="Status" class="form-label">Status</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="statut" required id="Status">
                                    <option selected>Select status</option>
                                    <option value="proprietaire">Propietaire</option>
                                    <option value="locataire">Locataire</option>
                                    
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="date" class="form-label">Date of birth</label>
                                    <input type="date" class="form-control" name="date_naissance" required id="date"
                                        aria-describedby="dateHelp">
                                    
                                </div>

                                <div class="mb-3">
                                    <label for="cin" class="form-label">Identity card</label>
                                    <input type="number" class="form-control" name="cin" required id="cin"
                                        aria-describedby="numberHelp">
                                    
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" required id="exampleInputPassword1">
                                    <span id="min_number_error"class="mt-2"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword2" class="form-label">Confirm password</label>
                                    <input type="password" class="form-control" name="password" required id="exampleInputPassword2">
                                    <span id="match_error"class="mt-2"></span>
                                </div>
                                

                                
                                <button type="submit" id="submitButton" class="btn btn-primary">Save</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./lib/chart/chart.min.js"></script>
    <script src="./lib/easing/easing.min.js"></script>
    <script src="./lib/waypoints/waypoints.min.js"></script>
    <script src="./lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="./lib/tempusdominus/js/moment.min.js"></script>
    <script src="./lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="./lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="./js/main.js"></script>
    <script src="./js/pwdTest.js"></script>
</body>

</html>