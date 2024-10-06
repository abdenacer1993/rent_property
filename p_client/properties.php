<?php
include('./includes/connect_db.php');
session_start(); // Start the session

// Pagination variables
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Get the current page number from the URL, default to 1 if not set
$perPage = 6; // Number of items per page

// Calculate the offset for the SQL query
$offset = ($page - 1) * $perPage;

// Fetch data from the database with pagination
$query = "SELECT * FROM annonce WHERE etat='Accept' LIMIT $offset, $perPage";
$poste = $bdd->query($query);

// Count total number of items
$totalItems = $bdd->query("SELECT COUNT(*) AS total FROM annonce WHERE etat='Accept'")->fetch()['total'];

// Calculate total number of pages
$totalPages = ceil($totalItems / $perPage);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>Property | Location</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

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
                    <span class="breadcrumb"><a href="#">Home</a> / Properties</span>
                    <h3>Properties</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="section properties">
        <div class="container">
            <strong style="text-align: center;">Filter by category</strong>
            <ul class="properties-filter">
                <li>
                    <a class="is_active" href="#!" data-filter="*">Show All</a>
                </li>
                <li>
                    <a href="#!" data-filter=".adv">Appartment</a>
                </li>
                <li>
                    <a href="#!" data-filter=".str">Maison</a>
                </li>
                <li>
                    <a href="#!" data-filter=".rac">Logement étudiant</a>
                </li>
            </ul>
            <div class="d-flex justify-content-center mb-3">
                <input type="text" class="form-control" placeholder="Search by address" name="adresse" id="filterAddress"
                    aria-describedby="nameHelp">
            </div>
            <div class="row properties-box">
                <?php while ($row = $poste->fetch(PDO::FETCH_ASSOC)) {
                    if ($row['categorie'] == 'House') {
                        $flt = 'str';
                    } elseif ($row['categorie'] == "Apartment") {
                        $flt = 'adv';
                    } else {
                        $flt = 'rac';
                    }
                ?>
                    <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 <?= $flt ?>">
                        <div class="item">
                            <a href="property-details.php?id=<?= $row['annonceID'] ?>"><img src="../p_admin/img/imgfromBD/<?= $row['image'] ?>" alt=""></a>
                            <span class="category"><?php echo $row['categorie']; ?></span>
                            <h6><?php echo $row['prix']; ?>DT</h6>
                            <h4><a href="property-details.php?id=<?= $row['annonceID'] ?>"><?php echo $row['title']; ?></a></h4>
                            <?php
                            // Given date
                            $base_date = new DateTime($row['date_publication']);

                            // Current system date
                            $current_date = new DateTime();
                            // Calculate the difference
                            $difference = $current_date->diff($base_date);

                            // Print the result
                            if ($difference->days > 0) {
                                $date_di = $difference->days . " day(s)";
                            } else if ($difference->h > 0) {
                                $date_di = $difference->h . " hour(s)";
                            } else if ($difference->i > 0) {
                                $date_di = $difference->i . " minute(s)";
                            } else {
                                $date_di = $difference->s + 1 . " second(s)";
                            }
                            ?>

                            <p>Publié il y a <?= $date_di ?> </p>
                            <ul>
                                <li>Chambres: <span><?php echo $row['chambre']; ?></span></li>
                                <li>Salle de bain: <span><?php echo $row['salle_bain']; ?></span></li>
                                <li>Taille: <span><?php echo $row['taille']; ?>m2</span></li>
                                <li>Address: <span><?php echo $row['adresse']; ?></span></li>

                            </ul>

                            <div class="row">
                                <div class=" d-flex justify-content-between">
                                    <!-- First btn -->
                                    <a href="property_details.php?id=<?= $row['annonceID'] ?>" class="btn btn-info">Voir plus</a>

                                    <!-- Second btn -->
                                    <a href="https://api.whatsapp.com/send?phone=+216<?php echo $row['telephone']; ?>&text=<?= $row['title'] ?>" target="_blank">
                                        <i class="fab fa-whatsapp" style="font-size: 36px; color: green;"></i>
                                    </a>


                                    <!-- Second btn -->
                                    <a href="mailto:<?php echo $row['email']; ?>" class="btn btn-dark" target="_blank"><i class="fa-solid fa-envelope mr-2"></i>Email</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="pagination">
                        <?php if ($page > 1) : ?>
                            <li><a href="?page=<?= ($page - 1) ?>">Previous</a></li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li><a <?= ($i === $page) ? 'class="is_active"' : ''; ?> href="?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>
                        <?php if ($page < $totalPages) : ?>
                            <li><a href="?page=<?= ($page + 1) ?>">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php include('./includes/footer.php') ?>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/counter.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const filterInput = document.getElementById('filterAddress');
    const propertyItems = document.querySelectorAll('.properties-items');

    filterInput.addEventListener('input', function () {
        const filterValue = filterInput.value.toLowerCase().trim();

        propertyItems.forEach(function (item) {
            const addressElement = item.querySelector('ul li:nth-child(4) span'); // Adjusted selector for the address
            const addressText = addressElement.textContent.toLowerCase();

            if (addressText.includes(filterValue)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>


</body>

</html>
