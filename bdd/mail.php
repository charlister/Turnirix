<?php
	session_start();

	if(!empty($_POST)){
    	extract($_POST);

        if (isset($_POST['contact'])){
        	$nom = htmlspecialchars(strtolower(trim($nom)));
        	$prenom = htmlspecialchars(strtolower(trim($prenom)));
        	$courriel = htmlspecialchars(strtolower(trim($courriel)));
        	$objet = htmlspecialchars(strtolower(trim($objet)));
        	$message = htmlspecialchars(strtolower(trim($message)));

      //   	ini_set( 'display_errors', 1 );
		    // error_reporting( E_ALL );

		    $to      = 'app.turnirix@gmail.com';
			$subject = $objet;
			$text    = $message.PHP_EOL."<br>nom : $nom ; prénom : $prenom";
			$headers = array(
			    'From' => $courriel,
			    'Reply-To' => $courriel,
			    'X-Mailer' => 'PHP/' . phpversion()
			);

			$return = mail($to, $subject, $text, $headers);
		    if ($return) {
		    	echo "Votre message a bien été envoyé. Retourner à la page d'<a href='http://turnirix/'>acceuil</a>";
		    }
        }
    }
?>