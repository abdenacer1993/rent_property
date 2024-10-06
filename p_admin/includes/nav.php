<?php
// session_start();
$id = $_SESSION['id'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom']; 
$statut = $_SESSION['statut']; 
// print_r($prenom);die();
?>
<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary text-capitalize">location</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="text-capitalize mb-0"><?= $nom." " . $prenom?></h6>
                        <span class="text-capitalize"><?= $statut ?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="./index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Tableau de bord</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user-secret me-2"></i>Administrateurs</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./list_administrator.php" class="dropdown-item">Liste administrateurs</a>
                            <a href="./add_administrator.php" class="dropdown-item">Ajouter administrateurs</a>
                            
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user me-2"></i>Utilisateurs</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./list_users.php" class="dropdown-item">Liste utilisateurs</a>
                            <a href="./add_users.php" class="dropdown-item">Ajouter utilisateurs</a>
                            
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-home me-2"></i>Annonce immobilière</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./list_property.php" class="dropdown-item">Liste de propriétés</a>
                            <a href="./add_property.php" class="dropdown-item">Ajouter propriétés</a>
                            
                        </div>
                    </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-envelope me-2"></i>Messages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./list_msg.php" class="dropdown-item">Liste message</a>
                            <a href="./add_msg.php" class="dropdown-item">Ajouter message</a>
                            
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-envelope me-2"></i>Avis</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./list_avis.php" class="dropdown-item">Liste avis</a>
                            <a href="./add_avis.php" class="dropdown-item">Ajouter avis</a>
                            
                        </div>
                    </div>
                    
                </div>
            </nav>
</div>
