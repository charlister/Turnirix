<?php
    session_start();
    include_once('connbdd.php'); // Fichier PHP contenant la connexion à votre BDD

    // S'il y a une session alors on ne retourne plus sur cette page  
    if (isset($_SESSION['id'])){
        header("Location: http://turnirix/");
        exit;
    }

    // Si la variable "$_Post" contient des informations alors on les traitres
    if(!empty($_POST)){
        extract($_POST);
        $b = true;

        if (isset($_POST['signin'])){
            $courriel = htmlspecialchars(strtolower(trim($courriel)));
            $mdp = htmlspecialchars(trim($mdp));

            // On fait une requête pour savoir si le couple courriel / mot de passe existe bien car le courriel est unique !
            $reqconn = $bdd->query("SELECT * FROM organisateur WHERE courriel = ? AND mdp = ?", array($courriel, crypt($mdp, '$6$rounds=5000$niIHubOIQqMLPSbjSQds$')));
            $reqconn = $reqconn->fetch();
            
            if (!$reqconn){ // Si on a pas de résultat alors c'est qu'il n'y a pas d'organisateur correspondant au couple courriel / mot de passe
                $b = false;
            }

            // S'il y a un résultat alors on va charger la SESSION de l'organisateur en initialisant les variables $_SESSION
            if ($b){
                $_SESSION['id'] = $reqconn['id']; // id de l'organisateur unique pour les requêtes futures
                $_SESSION['nom'] = $reqconn['nom'];
                $_SESSION['prenom'] = $reqconn['prenom'];
                $_SESSION['courriel'] = $reqconn['courriel'];
                $_SESSION['anniv'] = $reqconn['anniv'];

                header("Location: http://turnirix/");
                exit;
            }
            else {
                echo "Votre tentative de connexion a échoué. Veuillez <a href='http://turnirix/signin.php'>réessayer</a> !";
            }
        }
    }
?>