<?php
class Contact{
private $full_name;
private $email;
private $sujet;
private $msg;
private $date;
private $lu;
private $lu_par;



function __construct($full_name,$email,$sujet,$msg,$date,$lu,$lu_par){
$this->full_name = $full_name;
$this->email = $email;
$this->sujet = $sujet;
$this->msg = $msg;
$this->date = $date;
$this->lu = $lu;
$this->lu_par = $lu_par;
}



public function ajouter() {
    include('../includes/connect_db.php');

    try {
        $req = $bdd->exec("INSERT INTO `contact`(`nom_prenom`,`email`,`sujet`,`msg`,`date`,`lu`,`lu_par`) VALUES ('$this->full_name','$this->email','$this->sujet','$this->msg','$this->date','$this->lu','$this->lu_par')");
        
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
        $req = $bdd->prepare("UPDATE `contact` SET `nom_prenom` = :full_name, `email` = :email, `sujet` = :sujet, `msg` = :msg, `date` = :date, `lu` = :lu, `lu_par` = :lu_par WHERE contactID=$id");
        $req->bindParam(':full_name', $this->full_name);
        $req->bindParam(':email', $this->email);
        $req->bindParam(':sujet', $this->sujet);
        $req->bindParam(':msg', $this->msg);
        $req->bindParam(':date', $this->date);
        $req->bindParam(':lu', $this->lu);
        $req->bindParam(':lu_par', $this->lu_par);
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
        $req = $bdd->exec("DELETE FROM contact WHERE contactID = $id");

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