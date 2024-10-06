<?php 
// session_start();
// Define the current page basename
$current_page = basename($_SERVER['PHP_SELF']);

// Determine the active page based on the current page basename
switch($current_page) {
    case 'index.php':
        $active_page = 'home';
        break;
    case 'properties.php':
        $active_page = 'properties';
        break;
    case 'add_property.php':
        $active_page = 'add_property';
        break;
    case 'contact.php':
        $active_page = 'contact';
        break;
    
    default:
        $active_page = ''; // Set default active page
}

if(isset($_SESSION['token'])) {  
$token = $_SESSION['token'] ;
$full_name = $_SESSION['nom'] . " " .$_SESSION[ 'prenom'];
$status = $_SESSION['statut'];

switch($current_page) {
  case 'index.php':
      $active_page = 'home';
      break;
  case 'properties.php':
      $active_page = 'properties';
      break;
  case 'add_property.php':
      $active_page = 'add_property';
      break;
  case 'contact.php':
      $active_page = 'contact';
      break;
  case 'profile.php':
      $active_page = 'profile';
      break;
  case 'list_property.php':
      $active_page = 'list_property';
      break;
  case 'list_request.php':
      $active_page = 'list_request';
      break;
  case 'list_demande_prop.php':
      $active_page = 'list_demande_prop';
      break;
  default:
      $active_page = ''; // Set default active page 
}

// print_r($status);die();
}

?>
<div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <ul class="info">
            <li><i class="fa fa-envelope"></i> info@company.com</li>
            <li><i class="fa fa-map"></i> Sunny Isles Beach, FL 33160</li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4">
          <ul class="social-links">
            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a href="" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php" class="logo">
                        <h1>Location</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="index.php" <?php if($active_page == 'home') echo 'class="active"' ?>>Home</a></li>
                        <li><a href="properties.php" <?php if($active_page == 'properties') echo 'class="active"' ?>>Properties</a></li>
                        <?php if (isset($status) && $status == 'proprietaire') {?>
                            <li><a href="add_property.php" <?php if($active_page == 'add_property') echo 'class="active"' ?>>Add property</a></li>
                        <?php } ?>

                        <li><a href="contact.php" <?php if($active_page == 'contact') echo 'class="active"' ?>>Contact Us</a></li>
                        <?php if(isset($token)) { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" id="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $full_name?> <b class="caret"></b></a>
                                <ul class="dropdown-menu" id="dropdown-menu">
                                    <li class="linew"><a href="./profile.php" <?php if($active_page == 'profile') echo 'class="active"' ?>>My profile</a></li>
                                    <?php if ($status == 'proprietaire') {?>
                                        <li class="linew"><a href="./list_property.php" <?php if($active_page == 'list_property') echo 'class="active"' ?>>My listing</a></li>
                                        <li class="linew"><a href="./list_demande_prop.php" <?php if($active_page == 'list_demande_prop') echo 'class="active"' ?>>List rents</a></li>
                                    <?php } else {?>
                                        <li class="linew"><a href="./list_demande.php" <?php if($active_page == 'list_request') echo 'class="active"' ?>>My requests</a></li>
                                    <?php }?>
                                    
                                    <li class="linew"><a href="./login/logout.php">Logout</a></li>
                                    <!-- Add more options as needed -->
                                </ul>

                            </li>
                        <?php } else { ?>
                            <li class="dropdown">
                                <a href="./login/login.php" class="dropdown-toggle" id="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar"></i> Sign in /Sign up <b class="caret"></b></a>
                            </li>
                        <?php }?>
                    </ul>
  
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
  <style>
    .linew{
        height: auto!important;
    }
    .linew a {
        background-color: white!important;
        color: #3d3d3d!important;
        font-size: 15px!important;
        font-weight: 600!important;
    }
    .linew a:hover {
        
        color: #f35525!important;
        
    }
  </style>
  <script>
// JavaScript to trigger click event on the dropdown toggle element
document.addEventListener('DOMContentLoaded', function() {
    var dropdownToggle = document.getElementById('dropdown-toggle');
    var dropdownMenu = document.getElementById('dropdown-menu');

    dropdownToggle.addEventListener('click', function() {
        if (dropdownMenu.classList.contains('show')) {
            dropdownMenu.classList.remove('show');
        } else {
            dropdownMenu.classList.add('show');
        }
    });
});
</script>
  
  