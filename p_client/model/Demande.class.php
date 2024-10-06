<?php
class Demande{
private $annonceID;
private $locataireID;
private $properietaireID ;
private $full_name;
private $telephone;
private $etat;
private $date_add;
private $checkin;
private $checkout;





function __construct($annonceID,$locataireID,$properietaireID,$full_name ,$telephone,$etat,$date_add,$checkin,$checkout){
$this->annonceID = $annonceID;    
$this->locataireID = $locataireID;
$this->properietaireID  = $properietaireID ;
$this->full_name=$full_name;
$this->telephone= $telephone;
$this->etat = $etat;
$this->date_add = $date_add;
$this->checkin = $checkin;
$this->checkout = $checkout;




}





public function ajouter() {
  include('../includes/connect_db.php');
  
  try {
      $reqa = $bdd->query("SELECT * FROM demande WHERE annonceID = '$this->annonceID' AND locataireID = '$this->locataireID'");
      $count = $reqa->rowCount();
      

      if ($count == 0) {
          $req = $bdd->exec("INSERT INTO demande (
            annonceID, locataireID, properietaireID, nom_prenom, telephone, etat, date_demande, date_entrer, date_sortier) 
            VALUES (
              '$this->annonceID', '$this->locataireID', '$this->properietaireID', '$this->full_name', '$this->telephone', '$this->etat', '$this->date_add', '$this->checkin', '$this->checkout')");
        //   print_r($req);die();
          if ($req != false) {
              
              return 1;
          } else {
              return -1;
          }
      } else {
          
          return 0;
      }
  } catch (Exception $e) {
      return "Error: " . $e->getMessage();
      
  }
}


public function modifier($id) {
  include('../includes/connect_db.php');

  try {
      $req = $bdd->exec("UPDATE demande SET etat = '$this->etat' WHERE demandeID = $id");

      if ($req !== false) {
          return 1;
      } else {
          return -1 ;
      }
  } catch (Exception $e) {
      return "Error: " . $e->getMessage();
      
  }
}



			
       public function supprimer($id) {
        include('../includes/connect_db.php');
        // print_r($id);die();
        try {
            $req = $bdd->exec("DELETE FROM demande WHERE demandeID = $id");
            // print_r($req);die();
            if ($req !== false) {
                return 1;
            } else {
                return -1;
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
            
        }
    }
    


}


//$instance = new User($_POST['nom'],$_POST['prenom'],$_POST['login'],$_POST['email'],$_POST['pass'],$_POST['type']);


?>