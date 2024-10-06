<?php
class Demande{
private $email_u;
private $nom_u;
private $titre_e;
private $id_e;
private $id_u;
private $date_fin;





function __construct($email_u,$nom_u,$titre_e,$id_e,$id_u,$date_fin){
$this->email_u = $email_u;    
$this->nom_u = $nom_u;
$this->titre_e = $titre_e;
$this->id_e = $id_e;
$this->id_u = $id_u;
$this->date_fin = $date_fin;



}





public function ajouter(){ 

include('../include/connect_db.php');
    
	
    $reqa = $bdd->query(" SELECT * FROM demande WHERE id_u = '$this->id_u' and  id_e = '$this->id_e' ");
    
     $count = $reqa->rowCount();
    
    if ($count == 0) {
		//$type= intval($this->type);
      $req = $bdd->exec ("INSERT INTO `demande`(`email_u`,`nom_u`, `titre_e`, `id_e`,`id_u`,`date_fin`) VALUES ('$this->email_u','$this->nom_u','$this->titre_e','$this->id_e','$this->id_u','$this->date_fin')") OR die ("error");
      header("location:../indeex.php?result=success");       
      //return TRUE;
    } else{
      header('location:../indeex.php?result=error');
                //return FALSE;
	}
}

    public function modifier(){ 

    include('../include/connect_db.php');

    $id=$_GET['id'];
        
        $req=$bdd->exec("UPDATE `demande` SET email_u='$this->email_u',nom_u='$this->nom_u',titre_e='$this->titre_e' WHERE id=$id");
				
        
        //echo'oui';
        //return TRUE;"
 			}	
			
public function supprimer(){ 
    
	include('../include/connect_db.php');

    $req = $bdd->exec('DELETE FROM demande WHERE id=\''.$_GET['id'].'\''); 
 
		//echo'oui';	
 
 
}


}


//$instance = new User($_POST['nom'],$_POST['prenom'],$_POST['login'],$_POST['email'],$_POST['pass'],$_POST['type']);


?>