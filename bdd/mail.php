<?php
	session_start();

	if(!empty($_POST)){
    	extract($_POST);

        if (isset($_POST['contact'])){
        	$nom = htmlspecialchars(trim($nom));
        	$prenom = htmlspecialchars(trim($prenom));
        	$courriel = htmlspecialchars(trim($courriel));
        	$objet = htmlspecialchars(trim($objet));
        	$message = htmlspecialchars(trim($message));

		    $to      = 'app.turnirix@gmail.com';
			$subject = $objet;
			$text    = $message.PHP_EOL."<br>nom : $nom ; prénom : $prenom";
			$headers = array(
			    'From' => $courriel,
			    'Reply-To' => $courriel,
			    'X-Mailer' => 'PHP/' . phpversion()
			);

			$return = mail($to, $subject, $text, $headers); // resultat de l'envoi du mail
		    if ($return) {
		    	echo "Votre message a bien été envoyé. Retournez à la page d'<a href='http://turnirix/'>acceuil</a>";
		    }
		    else {
		    	echo "Votre message n'a pas été envoyé. Retournez à la page de <a href='http://turnirix/contact.php'>contact</a>";
		    }
        }
    }
?>