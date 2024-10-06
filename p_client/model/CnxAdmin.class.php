<?php
class CnxAdmin{
private $email;
private $password;

        
function __construct($email,$password){
$this->email = $email;
$this->password = $password;


}

//function connect
public function verifier() {
   include('../includes/connect_db.php');
   $req = $bdd->prepare("SELECT * FROM utilisateur WHERE email = :email AND password = :password and statut != 'administrateur'"); 
   $req->execute(array(':email' => $this->email, ':password' => $this->password ));
   $resultat = $req->fetch();

   if (!$resultat) {
      $msg = 'Email or password  incorrect';
      $msg = base64_encode($msg);
       header('location:./login.php?result='.$msg);
   } else {
       // Generate a token
      // Generate a random token
// Generate a random token
$token = bin2hex(openssl_random_pseudo_bytes(32)); // Generate a random token using OpenSSL

// Start a session
session_start();

// Store user information in the session (not storing the password)
$_SESSION['id'] = $resultat['utilisateurID'];
$_SESSION['nom'] = $resultat['nom'];
$_SESSION['prenom'] = $resultat['prenom'];
$_SESSION['email'] = $resultat['email'];
$_SESSION['telephone'] = $resultat['telephone'];
$_SESSION['cin'] = $resultat['cin'];
$_SESSION['date_naissance'] = $resultat['date_naissance'];
$_SESSION['statut'] = $resultat['statut'];
$_SESSION['token'] = $token; // Store the token in the session

// Send the token to the client
setcookie('token', $token, time() + 3600, '/', '', false, true); // Set the token as a cookie (secure and httponly)

// Redirect to the index page
header('location:../index.php');


   }
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
      // print_r($this->password);die("test");
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