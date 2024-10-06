<?php

// include('includes/connect_db.php');

$id = $_SESSION['id'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom']; 
$msg_not_read = $bdd->query("SELECT * FROM contact WHERE lu=0 order by contactID DESC");
$not_lu=$msg_not_read->rowCount();
$avis_not_read = $bdd->query("SELECT * FROM avis WHERE lu=0 order by avisID DESC");
$avis_not_lu=$avis_not_read->rowCount();
// print_r($user);die();
?>
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2 mr-2"><span style="color: red;
                                position: absolute;
                                top: 38px;
                                margin-left: 30px;
                                width: 15px;
                                background-color: rgba(0, 156, 255, 0.25);
                                text-align: center;
                                border-radius: 50%;">
                                <?=$not_lu?>
                                </span>
                            </i>
                            <span class="d-none d-lg-inline-flex ">Messages</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <?php 
                        if ($not_lu == 0) {
                            echo "Il n'y a aucun message non lu"  ;  
                        }else{ 
                        while ($message_header = $msg_not_read->fetch(PDO::FETCH_ASSOC)) {
                            // Given date
                            $header_date = new DateTime($message_header['date']);
                                        
                            // Current system date
                            $header_current_date = new DateTime();
                            // print_r($header_current_date);die();
                            // Calculate the difference
                            $difference_header = $header_current_date->diff($header_date);

                            // Print the result
                            // echo "Difference from base date:\n";
                            if ($difference_header->days > 0) {
                               $date_di_header = $difference_header->days . " day(s)\n";
                            }else
                            if ($difference_header->h > 0) {
                               $date_di_header = $difference_header->h . " hour(s)\n";
                            }else
                            if ($difference_header->i > 0) {
                               $date_di_header = $difference_header->i . " minute(s)\n";
                            }else
                            {
                                $date_di_header = $difference_header->s+1 . " second(s)\n";
                             }
                        ?>
                            <a href="./service_admin/read_msg_action.php?id=<?=$message_header['contactID']?>" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0"><strong><?php echo $message_header['nom_prenom']; ?></strong> Vous a envoyé un message</h6>
                                        <small><?= $date_di_header ?></small>
                                    </div>
                                </div>
                            </a>
                        <?php
                        }}
                        ?>
                            
                            
                            <hr class="dropdown-divider">
                            <a href="list_msg.php" class="dropdown-item text-center">Voir tous les messages</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2">
                            <span style="color: red;
                                position: absolute;
                                top: 38px;
                                margin-left: 30px;
                                width: 15px;
                                background-color: rgba(0, 156, 255, 0.25);
                                text-align: center;
                                border-radius: 50%;">
                                <?=$avis_not_lu?>
                            </span>
                            </i>
                            <span class="d-none d-lg-inline-flex">Notifications</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <?php 
                        if ($avis_not_lu == 0) {
                            echo "Il n'y a aucun notification non lu" ;  
                        }else{ 
                        while ($avis_header = $avis_not_read->fetch(PDO::FETCH_ASSOC)) {
                            // Given date
                            $header_date = new DateTime($avis_header['date']);
                                        
                            // Current system date
                            $header_current_date = new DateTime();
                            // print_r($header_current_date);die();
                            // Calculate the difference
                            $difference_header = $header_current_date->diff($header_date);

                            // Print the result
                            // echo "Difference from base date:\n";
                            if ($difference_header->days > 0) {
                               $date_di_header = $difference_header->days . " day(s)\n";
                            }else
                            if ($difference_header->h > 0) {
                               $date_di_header = $difference_header->h . " hour(s)\n";
                            }else
                            if ($difference_header->i > 0) {
                               $date_di_header = $difference_header->i . " minute(s)\n";
                            }else
                            {
                                $date_di_header = $difference_header->s+1 . " second(s)\n";
                             }
                        ?>
                            <a href="./service_admin/read_avis_action.php?id=<?=$avis_header['avisID']?>" class="dropdown-item">
                                <h6 class="fw-normal mb-0"><?=$avis_header['nom_prenom']?></h6>
                                <small><?=$date_di_header?> ago</small>
                            </a>
                            <?php
                        }}
                        ?>
                            <hr class="dropdown-divider">
                            
                            
                            <a href="./list_avis.php" class="dropdown-item text-center">Voir toutes les notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex text-capitalize"><?= $prenom ." ".$nom?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="profil.php" class="dropdown-item">Mon profil</a>
                            <a href="profil_verif_edit.php" class="dropdown-item">Paramètres</a>
                            <a href="login/logout.php" class="dropdown-item">Se déconnecter</a>
                        </div>
                    </div>
                </div>
            </nav>
