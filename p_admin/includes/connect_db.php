
<?php
// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=rent_property','root','');

	} catch(Exception $e) {
		die('Erreur: '.$e->getMessage());
		
	}$bdd->query("SET NAMES UTF8")	
	?>