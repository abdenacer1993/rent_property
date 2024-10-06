<?php 
include('./includes/connect_db.php');
session_start(); // Start the session
$id = $_GET['id'];
if(isset($_SESSION['id'])){
$utilisateur_id = $_SESSION['id'];
$av_fullname = $_SESSION[ 'prenom'].' '. $_SESSION['nom'];
$av_email = $_SESSION[ 'email'];
$statut = $_SESSION['statut'];
}

// Check if user is logged in, otherwise    
if ($id="") {
    header( "Location: index.php" );
}else{
    $id = $_GET['id'];
    $post_details = $bdd->query("SELECT * FROM annonce WHERE annonceID = $id ");

if ($post_details === false) {
    $msg = "Error data";
    $msg = base64_encode($msg);
    $error = "true";
    $error = base64_encode($error);
    header("Location: erreur404.php?result=".$msg."&error=".$error);
    exit();
}

$resultat = $post_details->fetch();

if (!$resultat) {
    $msg = "Data not found";
    $msg = base64_encode($msg);
    $error = "false";
    $error = base64_encode($error);
    header("Location: erreur404.php?result=".$msg."&error=".$error);
    exit();
} else {
    // get images 
    $images = $bdd->query("SELECT * FROM images WHERE annonceID = $id");
    $imgs = array(); // Initialize an empty array to store image URLs
    $idimgs = array(); // Initialize an empty array to store image IDs
    while ($resimage = $images->fetch()) {
        $imgs[] = $resimage['urlImages'];
        $idimgs[] = $resimage['imagesID']; // Store the imagesID in an array
    }
    // get avis
    
    $avis = $bdd->query("SELECT * FROM avis WHERE annonceID = $id");
    
    

    $utilisateur_id_from_req =$resultat['utilisateurID'];
    $title = $resultat['title'];
    $categorie = $resultat['categorie'];
    $taille = $resultat['taille'];
    $image = $resultat['image'];
    $price = $resultat['prix'];
    $description = $resultat['description'];
    $bedroom = $resultat['chambre'];
    $bathroom = $resultat['salle_bain'];
    $adresse = $resultat['adresse'];
    $full_name_ag = $resultat["nom_prenom"];
    // print_r($full_name);die();
    $email = $resultat["email"];
    $telephone = $resultat["telephone"];
    $date_poste = $resultat["date_publication"];
}
  
}


?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Property Detail | Location</title>

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
          <span class="breadcrumb"><a href="#">Home</a>  /  Property Detail</span>
          <h3>Property Detail</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="single-property section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="main-image">
          
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators" id="idimgs_indicators">
    <!-- Keep the id attribute as "idimgs_indicators" -->
    <?php
    // Loop through each image ID in $idimgs array
    foreach ($idimgs as $key => $idimg) {
        // Output indicators
        echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $key . '"';
        // Add 'active' class to the first indicator
        echo $key == 0 ? ' class="active"' : '';
        echo '></li>';
    }
    ?>
</ol>




  <div class="carousel-inner" id="imgs">
    <?php
    // Loop through each image URL in $imgs array
    foreach ($imgs as $key => $image) {
      echo '<div class="carousel-item';
      // Add 'active' class to the first item
      echo $key == 0 ? ' active' : '';
      echo '">';
      // Output the image
      echo '<img style="height: 400px;" src="../p_admin/img/imgfromBD/images/' . $id . '/' . $image . '" alt="Image ' . $key . '">';
      echo '</div>';
    }
    ?>
  </div>

  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" onclick="prevSlide(event)" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" onclick="nextSlide(event)" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

</div>



          </div>
          <div class="main-content">
          <?php if (isset($statut) && $statut === 'locataire') { ?>
    <div class="d-flex justify-content-between">
        <span class="category"><?= $categorie ?></span>
        <a href="#" class="btn btn-primary" style="height: 40px;margin-top: 30px;" onclick="openModal()">Request rent</a>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="margin: 0px;padding: 0px;">Date rent</h4>
                    <button type="button" class="btn btn-danger" onclick="closeModal()" data-dismiss="modal">&times;</button>
                </div>
                <form action="./service_user/demande_property_action.php" method="post">    
                    <!-- Modal Body -->
                    <div class="modal-body">
                      <input type="hidden" name="annonceID" value="<?= $id ?>">
                      <input type="hidden" name="properietaireID" value="<?= $utilisateur_id_from_req ?>">
                      <input type="hidden" name="locataireID" value="<?= $utilisateur_id ?>">
                      <div class="mb-3">
                          <label for="datein" class="form-label">Check in</label>
                          <input type="date" class="form-control" name="checkin" required id="datein" aria-describedby="dateHelp" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>">
                      </div>
                      <div class="mb-3">
                          <label for="dateout" class="form-label">Check out</label>
                          <input type="date" class="form-control" name="checkout" required id="dateout" aria-describedby="dateHelp">
                      </div>
                  </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="submitButton">Book</button>
                        <button type="button" class="btn btn-danger" onclick="closeModal()" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } else { ?>
    <span class="category"><?= $categorie ?></span>
<?php } ?>



            <h4><?=$title?></h4>
            <p><?=$description?></p>            
          </div> 
          
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Details property
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    if($bedroom>1){
                        $bed = $bedroom." rooms";
                    }else{
                        $bed = $bedroom." room";
                    }
                    if($bathroom>1){
                        $bath = $bathroom." rooms";
                    }else{
                        $bath = $bathroom." room";
                    }
                    ?>
                  <p><strong>Bedrooms :</strong> <?=$bed?></p>
                  <p><strong>Bathrooms :</strong> <?=$bath?></p>
                  <?php
                                        // Given date
                                        $base_date = new DateTime($date_poste);
                                        
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
                                        <p><strong>Posted on :</strong> <?=$date_di?> ago</p>
                                        <p><strong>Adresse :</strong> <?=$adresse?></p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Details agent
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                 <p><strong>Name: </strong> <?=$full_name_ag?></p>
                 <p><strong>Phone number: </strong> <?=$telephone?></p>
                 <p><strong>Email: </strong> <?=$email?></p>
                </div>
              </div>
            </div>
            
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Notice for property
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    
                <?php 
                    if ($avis->rowCount() == 0) {
                        echo "No avis found.";
                    } else {
                        while ($nba = $avis->fetch()) {
                            
                                        // Given date
                                        $base_date = new DateTime($nba['date']);
                                        
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
                    
                        <p><strong> <?=$nba['nom_prenom']?></strong> <?=$date_di?></p>
                        <p ><?=$nba['text']?></p>  
                        <hr style="margin-left:50px; margin-right:50px;">
                    <?php 
                        }
                    }
                ?>

                </div>
                <?php
                 if(isset($utilisateur_id) ):
                        if($utilisateur_id != $utilisateur_id_from_req){?>
                    <form action="./service_user/add_avis_action.php" method="post">
                        <input type="hidden" name="full_name" value="<?=$av_fullname?>">
                        <input type="hidden" name="email" value="<?=$av_email?>">
                        <input type="hidden" name="utilisateurID" value="<?=$utilisateur_id?>">
                        <input type="hidden" name="annonceID" value="<?=$id?>">
                        
                        <textarea name="text" rows="4" cols="50" style="width:100%"></textarea> <!-- This is the textarea for comments -->

                        <button type="submit" class="btn btn-primary">Comment</button>
                        
                    </form>
                    <?php }?>
                <?php endif;?>


              </div>
            </div>
            
          </div>
        </div>
        <div class="col-lg-4">
          <div class="info-table mb-3">
            <ul>
                <li>
                <img src="assets/images/info-icon-03.png" alt="" style="max-width: 52px;">
                <h4><?=$price." DT"?><br><span>Price</span></h4>
              </li>
              <li>
              <?php
                // Prix initial
                $prixInitial = $price;

                // Calcul de la réduction (10%)
                $reduction = $prixInitial * 0.10;

                // Prix réduit
                $prixReduit = $prixInitial - $reduction; 
                ?>
                <img src="assets/images/info-icon-03.png" alt="" style="max-width: 52px;">
                <h4><?=$prixReduit." DT"?><br><span>price for students</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-01.png" alt="" style="max-width: 52px;">
                <h4><?= $taille?> m2<br><span>Total Flat Space</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-02.png" alt="" style="max-width: 52px;">
                <h4>Contract<br><span>Contract Ready</span></h4>
              </li>
              
              
            </ul>
          </div>
          <div class="info-table">
            <ul>
            <li style="text-align: center;">
            <h4>Whatsapp</h4>
            <a href="https://api.whatsapp.com/send?phone=+216<?=$telephone ?>&text=<?=$title?>" target="_blank">
  <i class="fab fa-whatsapp" style="font-size: 36px; color: green;"></i>
</a>
              </li>
              <li style="text-align: center;">
              <h4>Email</h4>
              <a href="mailto:<?= $email ?>" target="_blank"><i class="fa-solid fa-envelope" style="font-size: 36px; color: #f35525;"></i></a>
              </li>
             
              
              
            </ul>
          </div>
        </div>
        
      </div>
    </div>
  </div>

 

 <?php include('./includes/footer.php')?>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <style>
    .carousel-item img {
    object-fit: cover;
    width: 100%;
    height: 100%;
}
    /* Style des indicateurs du carrousel */
.carousel-indicators {
  position: absolute;
  bottom: 10px; /* Ajustez cette valeur selon votre préférence */
  left: 0;
  right: 0;
  text-align: center;
  z-index: 15;
}

.carousel-indicators li {
  display: inline-block;
  width: 10px; /* Largeur de l'indicateur */
  height: 10px; /* Hauteur de l'indicateur */
  margin: 0 5px; /* Espacement entre les indicateurs */
  cursor: pointer;
  background-color: rgba(255, 255, 255, 0.5); /* Couleur de fond de l'indicateur */
  border-radius: 50%; /* Bord arrondi de l'indicateur */
}

.carousel-indicators li.active {
  background-color: #fff; /* Couleur de fond de l'indicateur actif */
}

  </style>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>
  <script>
 function prevSlide(event) {
    event.preventDefault(); // Empêcher l'action par défaut du lien
    $('#carouselExampleIndicators').carousel('prev'); // Défiler vers l'image précédente
    // Mise à jour des classes actives dans les indicateurs
    var activeIndex = $('.carousel-item.active').index();
    $('#carouselExampleIndicators .carousel-indicators li').removeClass('active');
    $('#carouselExampleIndicators .carousel-indicators li').eq(activeIndex).addClass('active');
}

function nextSlide(event) {
    event.preventDefault(); // Empêcher l'action par défaut du lien
    $('#carouselExampleIndicators').carousel('next'); // Défiler vers l'image précédente
    // Mise à jour des classes actives dans les indicateurs
    var activeIndex = $('.carousel-item.active').index();
    $('#carouselExampleIndicators .carousel-indicators li').removeClass('active');
    $('#carouselExampleIndicators .carousel-indicators li').eq(activeIndex).addClass('active');
}

// PHP variables containing image URLs and IDs
var idimgs = <?php echo json_encode($idimgs); ?>;
var imgs = <?php echo json_encode($imgs); ?>;
var id = <?php echo json_encode($id);?>;

// Generating carousel indicators
$(document).ready(function(){
  idimgs.forEach(function(idimg, index) {
    var indicatorClass = (index === 0) ? "active" : "";
    $('#idimgs').append('<li data-target="#carouselExampleIndicators" data-slide-to="' + index + '" class="' + indicatorClass + '"></li>');
  });

//   Generating carousel images
//   imgs.forEach(function(image, index) {
//     var itemClass = (index === 0) ? "carousel-item active" : "carousel-item";
//     $('#imgs').append('<div class="' + itemClass + '"><img src="../p_admin/img/imgfromBD/images/' + id +"/"+ image + '" class="d-block w-100" alt="Image ' + index + '"></div>');
//   });
});
// Ouvre la modal
function openModal() {
  var modal = document.getElementById("myModal");
  modal.style.display = "block";
}

// Ferme la modal lorsque l'utilisateur clique sur le bouton "Close"
function closeModal() {
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
}

// Ferme la modal lorsque l'utilisateur clique en dehors de celle-ci
window.onclick = function(event) {
  var modal = document.getElementById("myModal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


document.addEventListener("DOMContentLoaded", function() {
        var datein = new Date(document.getElementById('datein').value);
        var dateout = new Date(datein);
        dateout.setDate(datein.getDate() + 1); // Ajoute un jour à la date d'arrivée
        var yyyy = dateout.getFullYear();
        var mm = String(dateout.getMonth() + 1).padStart(2, '0'); // Ajoute un zéro en début si nécessaire
        var dd = String(dateout.getDate()).padStart(2, '0'); // Ajoute un zéro en début si nécessaire
        var formattedDate = yyyy + '-' + mm + '-' + dd;
        document.getElementById('dateout').value = formattedDate;
    });

    document.getElementById('datein').addEventListener('change', function() {
        var datein = new Date(this.value);
        var dateout = new Date(datein);
        dateout.setDate(datein.getDate() + 1); // Ajoute un jour à la date d'arrivée
        var yyyy = dateout.getFullYear();
        var mm = String(dateout.getMonth() + 1).padStart(2, '0'); // Ajoute un zéro en début si nécessaire
        var dd = String(dateout.getDate()).padStart(2, '0'); // Ajoute un zéro en début si nécessaire
        var formattedDate = yyyy + '-' + mm + '-' + dd;
        document.getElementById('dateout').value = formattedDate;
    });
    
    document.addEventListener("DOMContentLoaded", function() {
        var checkinInput = document.getElementById("datein");
        var checkoutInput = document.getElementById("dateout");
        var submitButton = document.getElementById("submitButton");

        function toggleSubmitButton() {
            if (checkinInput.value >= checkoutInput.value) {
                submitButton.disabled = true;
            } else {
                submitButton.disabled = false;
            }
        }

        checkinInput.addEventListener("change", toggleSubmitButton);
        checkoutInput.addEventListener("change", toggleSubmitButton);
    });
</script>



  </body>
</html>