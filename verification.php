<?php
	include_once('bdd/connbdd.php');
	if(isset($_GET['cleVerif'])){
		// Process verification
		$cleVerif = $_GET['cleVerif'];

		$resultSet = $bdd->query("SELECT statut,cleVerif
			                      FROM   organisateur
			                      WHERE  statut=0 AND cleVerif='$cleVerif' 
			                      LIMIT  1");
		if($resultSet){
			// Email validation
			$update = $bdd->query("UPDATE organisateur
				                   SET    statut=1
				                   WHERE  cleVerif='$cleVerif'
				                   LIMIT  1");
			if($update){
				echo "Votre compte a bien été vérifié. Veuillez vous <a href='http://turnirix/signin.php'>connecter</a>.";
			}
			else{
				echo $bdd->error;
			}
		}
		else{
			echo "Ce compte est invalide ou a déjà été vérifié. Veuillez retourner à la page d<a href='http://turnirix/'>acceuil</a>";
		}
	}
	else{
		die("Error message");
	}
?>