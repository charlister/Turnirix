<?php  
	session_start();
    include_once('connbdd.php'); // Fichier PHP contenant la connexion à votre BDD


    if (isset($_POST['create'])){ // On vérifie si un événement est déjà prévu à cette date et en ce lieuEv.
    	$nomEv = htmlspecialchars(trim($_POST['nomEv']));
	    $lieuEv = htmlspecialchars(trim($_POST['lieuEv']));
	    $dateEv = date(htmlspecialchars($_POST['dateEv']));
	    $sport = htmlspecialchars($_POST['sport']);
	    $nbTournois = intval(htmlspecialchars($_POST['nbTournois']));
	    echo "nomEv : $nomEv, lieuEv : $lieuEv, dateEv : $dateEv, sport : $sport , nbTournois : $nbTournois ;<br>";

        $existEv = $bdd->query("
        	SELECT * 
        	FROM evenement 
        	WHERE LOWER(lieuEv) = ? AND dateEv = ?", 
        	array(strtolower($lieuEv), $dateEv));

        if ($tuple = $existEv->fetch()){ // si c'est le cas, on le signal
        	echo "Un événement dénommé ".$tuple['nomEv']." a déjà été programmé pour le $dateEv à $lieuEv. <br>Veuillez en <a href='http://turnirix/tournois.php'>créer un autre</a> !";
        }
        else { // sinon on insère l'évènement dans la bdd
        	if ($bdd->register("
        		INSERT INTO evenement (nomEv, lieuEv, dateEv, sport, nbTournois, idO) 
        		VALUES (?, ?, ?, ?, ?, ?)", 
        		array($nomEv, $lieuEv, $dateEv, $sport, $nbTournois, intval($_SESSION['idO'])))) {
        		// On en profite pour ajouter les tournois créés.
	            echo "nbTournois : $nbTournois<br>";
	            for ($i=1; $i <= $nbTournois; $i++) { 
	            	$nomT = htmlspecialchars(trim($_POST["nomT$i"]));
	            	$typeJeu = intval(htmlspecialchars(trim($_POST["typeJeu$i"])));
	            	$frais = intval(htmlspecialchars(trim($_POST["frais$i"])));

	            	$bdd->register("
	            		INSERT INTO tournois (nomT, typeJeu, frais, lieuT, dateT) 
	            		VALUES (?, ?, ?, ?, ?)", 
	            		array($nomT, $typeJeu, $frais, $lieuEv, $dateEv));
	            }

	            echo "La création de l'événement $nomEv prévu le $dateEv à $lieuEv a bien été prise en compte. <br>Retourner à la page de <a href='http://turnirix/tournois.php'>tournois</a>.";
        	} 
        	else {
        		echo "Une erreur est survenue lors de la création de l'événement $nomEv. <br>Veuillez <a href='http://turnirix/tournois.php'>réessayer</a> !";
        	}
        }
    }
    else if (isset($_POST['register'])){ 
    	$choixTournois = explode(";", htmlspecialchars($_POST['choixTournois']), "3");/*nomT;dateT;lieuT*/
        $nomT = $choixTournois[0];
        $dateT = $choixTournois[1];
        $lieuT = $choixTournois[2];
        $nomEq = htmlspecialchars(trim($_POST['nomEq']));
        $nbJoueurs = htmlspecialchars($_POST['nbJoueurs']);

        $existEq = $bdd->query("
        	SELECT * 
        	FROM equipe
        	WHERE LOWER(nomT) = ? AND dateT = ? AND LOWER(lieuT) = ? AND LOWER(nomEq) = ?", 
        	array(strtolower($nomT), $dateT, strtolower($lieuT), strtolower($nomEq))); /*vérifier si une équipe porte déjà le même nom pour le même tournois du même événement*/

        if ($tuple = $existEq->fetch()){ // si c'est le cas, on le signal à l'utilisateur
        	echo "Une équipe porte déjà le nom de $nomEq pour le même tournoi. <br>Veuillez <a href='http://turnirix/tournois.php'>rééssayer</a> !";
        }
        else { // sinon on insère l'équipe ainsi que ses joueurs dans la bdd.
        	$niveauEq = 0;
        	if ($bdd->register("
        		INSERT INTO equipe (nomEq, niveauEq, nomT, dateT, lieuT) 
        		VALUES (?, ?, ?, ?, ?)", 
        		array($nomEq, $niveauEq, $nomT, $dateT, $lieuT))) { // si l'insertion de l'équipe a fonctionné on insère les joueurs
        		
	            for ($i=1; $i <= $nbJoueurs; $i++) { 
	            	$nomJ = htmlspecialchars(trim($_POST["joueur$i"]));
	            	$niveauJ = intval(htmlspecialchars($_POST["niveau$i"]));
	            	$niveauEq += $niveauJ;
	            	$bdd->register("
	            		INSERT INTO joueur (nomJ, niveauJ, nomEq, nomT, dateT, lieuT) 
	            		VALUES (?, ?, ?, ?, ?, ?)", 
	            		array($nomJ, $niveauJ, $nomEq, $nomT, $dateT, $lieuT));
	            }
	            $niveauEq = intdiv($niveauEq, $nbJoueurs);
	            $bdd->register("
	            	UPDATE equipe
	            	SET niveauEq = $niveauEq
	            	WHERE LOWER(nomEq) = ? AND niveauEq = 0 AND LOWER(nomT) = ? AND dateT = ? AND LOWER(lieuT) = ?",
	            	array(strtolower($nomEq), strtolower($nomT), $dateT, strtolower($lieuT)));
	            echo "L'inscription a bien été prise en compte. Retourner à la page de <a href='http://turnirix/tournois.php'>tournois</a>";
        	} 
        	else {
        		echo "Une erreur est survenue lors de la création de l'équipe. Veuillez <a href='http://turnirix/tournois.php'>réessayer</a> !";
        	}
        }
    }
?>