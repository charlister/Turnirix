<?php
	include_once('bdd/connbdd.php');
	if(isset($_GET['vkey'])){
		// Process verification
		$vkey = $_GET['vkey'];

		$resultSet = $bdd->query("SELECT statut,vkey
			                         FROM   organisateur
			                         WHERE  statut=0 AND vkey='$vkey' 
			                         LIMIT  1");
		if($resultSet){
			// Email validation
			$update = $bdd->query("UPDATE organisateur
				                      SET    statut=1
				                      WHERE  vkey='$vkey'
				                      LIMIT  1");
			if($update){
				echo "Votre compte a bien été vérifié. Veuillez vous <a href='http://turnirix/signin.php'>connecter</a>.";
			}
			else{
				echo $bdd->error;
			}
		}
		else{
			echo "Ce compte est invalide ou a déjà été vérifié. Retourner à la page d'd'<a href='http://turnirix/'>acceuil</a>";
		}
	}
	else{
		die("Error message");
	}
?>