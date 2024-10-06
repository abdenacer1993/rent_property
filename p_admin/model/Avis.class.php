<?php
class Avis{
private $annonceID;
private $date;
private $text;
private $utilisateurID;
private $full_name;
private $email;
private $lu;



function __construct($annonceID,$date,$text,$utilisateurID,$full_name,$email,$lu){
$this->annonceID = $annonceID;
$this->date = $date;
$this->text = $text;
$this->utilisateurID = $utilisateurID;
$this->full_name = $full_name;
$this->email = $email;
$this->lu= $lu;
}



public function ajouter() {
    include('../includes/connect_db.php');

    try {
        $req = $bdd->exec("INSERT INTO `avis`(`annonceID`,`date`,`text`,`utilisateurID`,`nom_prenom`,`email`,`lu`) VALUES ('$this->annonceID','$this->date','$this->text','$this->utilisateurID','$this->full_name','$this->email','$this->lu')");
        
        if ($req === false) { // Correction: Utiliser strictement l'égalité avec false
            return -1; // Retourner -1 si l'exécution de la requête échoue
        } else {
            return 1; // Retourner 1 si la requête s'exécute avec succès
        }
    } catch (Exception $e) {
        return "Une erreur s'est produite: " . $e->getMessage(); // Retourner le message d'erreur si une exception se produit
    }
}

public function edit($id) {
    include('../includes/connect_db.php');

    try {
        $req = $bdd->prepare("UPDATE `avis` SET `annonceID` = :annonceID, `date` = :date, `text` = :text, `utilisateurID` = :utilisateurID, `nom_prenom` = :full_name, `email` = :email, `lu` = :lu WHERE avisID=$id");
        $req->bindParam(':annonceID', $this->annonceID);
        $req->bindParam(':date', $this->date);
        $req->bindParam(':text', $this->text);
        $req->bindParam(':utilisateurID', $this->utilisateurID);
        $req->bindParam(':full_name', $this->full_name);
        $req->bindParam(':email', $this->email);
        $req->bindParam(':lu', $this->lu);
        // Make sure to replace <your_condition> with your actual condition for updating

        $req->execute();
        
        if ($req->rowCount() > 0) { // Check if any rows were affected
            return 1; // Return 1 if query executed successfully
        } else {
            return -1; // Return -1 if query failed to execute
        }
    } catch (PDOException $e) {
        return "Une erreur s'est produite: " . $e->getMessage(); // Return error message if exception occurs
    }
}




    
			
public function supprimer($id) {
    include('../includes/connect_db.php');

    try {
        $req = $bdd->exec("DELETE FROM avis WHERE avisID = $id");

        if ($req === false || $req === 0) { // Correction: Utiliser strictement l'égalité avec false ou 0
            return -1; // Retourner -1 si l'exécution de la requête échoue ou aucune ligne n'est affectée
        } else {
            return 1; // Retourner 1 si la requête s'exécute avec succès
        }
    } catch (Exception $e) {
        return "Une erreur s'est produite: " . $e->getMessage(); // Retourner le message d'erreur si une exception se produit
    }
}




}





?>