<?php
	if(isset($_GET['vkey'])){
		// Process verification
		$vkey = $_GET['vkey'];

		$mysqli = NEW MySQLi('localhost','root','','turnirix');
		$resultSet = $mysqli->query("SELECT statut,vkey
			                         FROM   organisateur
			                         WHERE  statut=0 AND vkey='$vkey' 
			                         LIMIT  1");
		if($resultSet->num_rows == 1){
			// Email validation
			$update = $mysqli->query("UPDATE organisateur
				                      SET    statut=1
				                      WHERE  vkey='$vkey'
				                      LIMIT  1");
			if($update){
				echo "Your account has been verified. You may now log in.";
			}else{
				echo $mysqli->error;
			}
		}else{
			echo "This account is invalid or already verified";
		}
	}else{
		die("Error message");
	}
?>