<?php
class Verifpass{

private $password;

        
function __construct($password){

$this->password = $password;


}


public function verifier_password() {
   include('../includes/connect_db.php');

   session_start();

   // Vérifier si la variable de session pour le nombre de tentatives existe
   if (!isset($_SESSION['login_attempts'])) {
       $_SESSION['login_attempts'] = 0;
   }

   try {
       $req = $bdd->prepare("SELECT * FROM utilisateur WHERE password = :password");
       $req->execute(array(':password' => $this->password));
       $resultat = $req->fetch();
    //   print_r($this->password);die("test");
       if (!$resultat) {
           $_SESSION['login_attempts']++;

           if ($_SESSION['login_attempts'] >= 3) {
               // Déconnexion de l'utilisateur
               // Supprimez toutes les variables de session pour une déconnexion complète
               session_unset();
               session_destroy();

               // Redirection vers la page de connexion
               header("Location: ../login/login.php");
               exit; // Arrête l'exécution du script après la redirection
           }

           return -1; // Mot de passe incorrect
       } else {
           // Réinitialiser le nombre de tentatives de connexion si le mot de passe est correct
           if (isset($_SESSION['login_attempts'])) {
               unset($_SESSION['login_attempts']);
           }
           return 1; // Mot de passe correct
       }
   } catch (PDOException $e) {
       // Gérer les erreurs de la base de données
       // Par exemple : journalisation, affichage d'un message d'erreur, etc.
       return false; // Échec de la vérification
   }
}




}







?>