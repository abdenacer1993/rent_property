<?php
class Annonce {
    private $utilisateurID;
    private $title;
    private $categorie;
    private $taille;
    private $bed_room;
    private $bath_room;
    private $price;
    private $description;
    private $full_name;
    private $email;
    private $telephone; 
    private $image;
    private $etat;
    private $poste_date;
    private $adresse;
    
    

    public function __construct($utilisateurID, $title, $categorie, $taille, $bed_room, $bath_room, $price , $description , $full_name , $email , $telephone ,$image, $etat, $poste_date, $adresse) {
        $this->utilisateurID = $utilisateurID; //
        $this->title = $title; //
        $this->categorie = $categorie; //
        $this->taille = $taille; //
        $this->bed_room = $bed_room; //
        $this->bath_room = $bath_room; //
        $this->price = $price; //
        $this->description = $description; //
        $this->full_name = $full_name; //
        $this->email = $email; //
        $this->telephone = $telephone; //
        $this->image = $image; //
        $this->etat = $etat; //
        $this->poste_date = $poste_date;
        $this->adresse= $adresse;//
        
        
    }

    public function ajouter() {
        include('../includes/connect_db.php');
    
        try {
            $stmt = $bdd->prepare("INSERT INTO annonce (utilisateurID, title, categorie, taille, chambre, salle_bain, prix, description, nom_prenom, email, telephone, image, etat, date_publication, adresse) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$this->utilisateurID, $this->title, $this->categorie, $this->taille, $this->bed_room, $this->bath_room, $this->price, $this->description, $this->full_name, $this->email, $this->telephone, $this->image, $this->etat, $this->poste_date, $this->adresse]);
            // print_r($stmt);die();
            $lastInsertedId = $bdd->lastInsertId(); // Récupérer l'ID de la dernière insertion
            // print_r($lastInsertedId);die();
            if ($stmt) {   
                return $lastInsertedId; // Retourner l'ID de la dernière insertion
            } else {
                return -1;
            }
        } catch (PDOException $e) {
            // Handle database connection errors or SQL errors here
            // For demonstration purposes, you can echo the error message
            echo "Error: " . $e->getMessage();
            return -1; // Return -1 to indicate failure
        }
    }

    public function edit($id) {
        include('../includes/connect_db.php');
        // print_r($id);die();
        try {
            $stmt = $bdd->prepare("UPDATE annonce SET utilisateurID=?, title=?, categorie=?, taille=?, chambre=?, salle_bain=?, prix=?, description=?, nom_prenom=?, email=?, telephone=?, image=?, etat=?, date_publication=?, adresse=? WHERE annonceID = ?");
        
            $stmt->execute([$this->utilisateurID, $this->title, $this->categorie, $this->taille, $this->bed_room, $this->bath_room, $this->price, $this->description, $this->full_name, $this->email, $this->telephone, $this->image, $this->etat, $this->poste_date, $this->adresse, $id]);
            // print_r($stmt);die();
            if ($stmt) {   
                return 1;
            } else {
                return -1;
            }
        } catch (PDOException $e) {
            // Handle database connection errors or SQL errors here
            // For demonstration purposes, you can echo the error message
            echo "Error: " . $e->getMessage();
            return -1; // Return -1 to indicate failure
        }
    }
    

    public function accepter($id) {
        include('../includes/connect_db.php');
        
        try {
            $stmt = $bdd->prepare("UPDATE annonce SET utilisateurID=?, title=?, categorie=?, taille=?, chambre=?, salle_bain=?, prix=?, description=?, nom_prenom=?, email=?, telephone=?, image=?, etat=?, date_publication=?, adresse=? WHERE annonceID = ?");
        
            $stmt->execute([$this->utilisateurID, $this->title, $this->categorie, $this->taille, $this->bed_room, $this->bath_room, $this->price, $this->description, $this->full_name, $this->email, $this->telephone, $this->image, $this->etat, $this->poste_date, $this->adresse, $id]);
            
            if ($stmt) {   
                return 1;
            } else {
                return -1;
            }
        } catch (PDOException $e) {
            // Handle database connection errors or SQL errors here
            // For demonstration purposes, you can echo the error message
            echo "Error: " . $e->getMessage();
            return -1; // Return -1 to indicate failure
        }
    }


    public function refuser($id) {
        include('../includes/connect_db.php');
        
        try {
            $stmt = $bdd->prepare("UPDATE annonce SET utilisateurID=?, title=?, categorie=?, taille=?, chambre=?, salle_bain=?, prix=?, description=?, nom_prenom=?, email=?, telephone=?, image=?, etat=?, date_publication=?, adresse=? WHERE annonceID = ?");
        
            $stmt->execute([$this->utilisateurID, $this->title, $this->categorie, $this->taille, $this->bed_room, $this->bath_room, $this->price, $this->description, $this->full_name, $this->email, $this->telephone, $this->image, $this->etat, $this->poste_date, $this->adresse, $id]);
            
            if ($stmt) {   
                return 1;
            } else {
                return -1;
            }
        } catch (PDOException $e) {
            // Handle database connection errors or SQL errors here
            // For demonstration purposes, you can echo the error message
            echo "Error: " . $e->getMessage();
            return -1; // Return -1 to indicate failure
        }
    }
    
    

   

    public function supprimer($id) {
        include('../includes/connect_db.php');
    
        try {
            $stmt = $bdd->prepare("DELETE FROM annonce WHERE annonceID = ?");
            $stmt->execute([$id]);
    
            // Check if any rows were affected
            if ($stmt->rowCount() > 0) {
                return 1; // Success
            } else {
                return -1; // No rows affected, likely the ID didn't match any record
            }
        } catch (PDOException $e) {
            // Handle the exception
            echo "Error: " . $e->getMessage(); // You can handle this error as per your requirement
            return -1; // Return -1 to indicate failure
            // Optionally, you can log the error, redirect the user, or perform any other action
        }
    }
    
}


?>
