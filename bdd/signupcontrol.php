<?php
    session_start();
    include_once('connbdd.php'); // Fichier PHP contenant la connexion à votre BDD

    if (isset($_SESSION['id'])){ // S'il y a une session active alors on ne retourne plus sur cette page
        header("Location: /");
        echo "session active !";
        exit;
    }

    if(!empty($_POST)){ // Si la variable "$_Post" contient des informations alors on les traitres
        echo "Données à traiter ...";
        extract($_POST);
        $b = true;
    }
    
    if (isset($_POST['signup'])){ // On se place sur le bon formulaire grâce à l'attribut "name" des balises "input"
        $nom  = htmlspecialchars(trim($nom));
        $prenom = htmlspecialchars(trim($prenom));
        $courriel = htmlspecialchars(strtolower(trim($courriel)));
        $mdp = htmlspecialchars(trim($mdp));
        $sexe = htmlspecialchars($sexe);
        $anniv = htmlspecialchars($anniv);

        // On vérifit que le courriel n'existe pas dans la bdd
        $querymail = $bdd->query("SELECT courriel FROM organisateur WHERE courriel = ?", array($courriel));
        $querymail = $querymail->fetch();
        if ($querymail['courriel'] <> ""){
            $b = false;
        }

        if($b){ // S'il s'agit d'une nouvelle adresse email, on effectue le traitement
            $mdp = crypt($mdp, '$6$rounds=5000$niIHubOIQqMLPSbjSQds$');

            // On insert nos données dans la table organisateur
            $bdd->register("INSERT INTO organisateur (nom, prenom, courriel, mdp, anniv, sexe) VALUES (?, ?, ?, ?, ?, ?)", array($nom, $prenom, $courriel, $mdp, $anniv, $sexe));
            echo "Un nouvel organisateur a été inscrit dans la bdd";
            header('Location: /');
            exit;
        }
        else {
            header('Location: ../signup.php'); // on y inclura un fichier js pour dire que l'adresse est déjà utilisée.
            exit;
        }    
    }
?>