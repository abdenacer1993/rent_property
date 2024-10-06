<?php

class Utilisateur {
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $telephone;
    private $cin;
    private $date_naissance;
    private $statut;

    function __construct($nom, $prenom, $email, $password, $telephone, $cin, $date_naissance, $statut) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->telephone = $telephone;
        $this->cin = $cin;
        $this->date_naissance = $date_naissance;
        $this->statut = $statut;
    }





    public function ajouter() {
      include('../includes/connect_db.php');
  
      $reqa = $bdd->prepare("SELECT email FROM utilisateur WHERE email = :email");
      $reqa->execute(array(':email' => $this->email));
      
      $count = $reqa->rowCount();
  
      if ($count == 0) {
          $req = $bdd->exec ("INSERT INTO `utilisateur`(`nom`, `prenom`, `email`, `password`, `telephone`, `cin`, `date_naissance`, `statut`) 
              VALUES ('$this->nom','$this->nom','$this->email','$this->password','$this->telephone','$this->cin','$this->date_naissance','$this->statut')");
          
          if ($req !== false) {
              return 1;
          } else {
              return -1;
          }
      } else {
          return 0;
      }
  }
  
  

  public function modifier($id){ 
    include('../includes/connect_db.php');

    try {
      
        $req = $bdd->exec("UPDATE `utilisateur` SET nom='$this->nom',prenom='$this->prenom',email='$this->email',password='$this->password',telephone='$this->telephone',cin='$this->cin',date_naissance='$this->date_naissance',statut='$this->statut' WHERE utilisateurID=$id");
        // print_r($req);die("test");
        if ($req !== 1) {
            return -1; // Return -1 if query execution fails
        } else {
            return 1; // Return 1 if query executes successfully
        }
    } catch (Exception $e) {
        return "An error occurred: " . $e->getMessage(); // Return error message if an exception occurs
    }
}

			
       public function supprimer(){ 
    
        include('../includes/connect_db.php');
      
          $req = $bdd->exec('DELETE FROM utilisateur WHERE utilisateurID=\''.$_GET['id'].'\''); 
       
          //echo'oui';	
       
       
      }
}


//$instance = new User($_POST['nom'],$_POST['prenom'],$_POST['login'],$_POST['email'],$_POST['pass'],$_POST['type']);


?>