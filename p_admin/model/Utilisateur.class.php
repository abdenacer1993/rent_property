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
  
  

  public function modifier($id) {
    include('../includes/connect_db.php');

    // Prepare the SQL statement
    $sql = "UPDATE `utilisateur` SET nom=?, prenom=?, email=?, password=?, telephone=?, cin=?, date_naissance=?, statut=? WHERE utilisateurID=?";

    try {
        // Prepare the SQL statement
        $stmt = $bdd->prepare($sql);

        // Bind parameters
        $stmt->bindParam(1, $this->nom);
        $stmt->bindParam(2, $this->prenom);
        $stmt->bindParam(3, $this->email);
        // Hash the password before saving
        // $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(4, $this->password);
        $stmt->bindParam(5, $this->telephone);
        $stmt->bindParam(6, $this->cin);
        $stmt->bindParam(7, $this->date_naissance);
        $stmt->bindParam(8, $this->statut);
        $stmt->bindParam(9, $id);

        // Execute the statement
        $stmt->execute();

        // Check if any rows were affected
        $rowCount = $stmt->rowCount();

        if ($rowCount !== 1) {
            return -1; // Return -1 if query execution fails
        } else {
            // Update session variables with new attribute values
            $_SESSION['nom'] = $this->nom;
            $_SESSION['prenom'] = $this->prenom;
            $_SESSION['email'] = $this->email;
            $_SESSION['telephone'] = $this->telephone;
            $_SESSION['cin'] = $this->cin;
            $_SESSION['date_naissance'] = $this->date_naissance;
            $_SESSION['statut'] = $this->statut;
            // Update other session variables as needed
            // ...

            return 1; // Return 1 if query executes successfully
        }
    } catch (PDOException $e) {
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