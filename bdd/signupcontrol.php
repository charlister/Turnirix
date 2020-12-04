<?php
    session_start();
    include_once('connbdd.php'); // Fichier PHP contenant la connexion à votre BDD

    if (isset($_SESSION['id'])){ // S'il y a une session active alors on ne retourne plus sur cette page
        header("Location: http://turnirix/");
        exit;
    }

    if(!empty($_POST)){ // Si la variable "$_Post" contient des informations alors on les traitres
        extract($_POST);
        $b = true;
    }
    
    if (isset($_POST['submit'])){ // On se place sur le bon formulaire grâce à l'attribut "name" des balises "input"
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

            $vkey = md5(time().$courriel);

            // On insert nos données dans la table organisateur
            $bdd->register("INSERT INTO organisateur (nom, prenom, courriel, mdp, anniv, sexe, vkey) VALUES (?, ?, ?, ?, ?, ?, ?)", array($nom, $prenom, $courriel, $mdp, $anniv, $sexe, $vkey));

            $to = $courriel;
            $subject = "Email Verification";
            $message = "<a href='http://turnirix/verification.php?vkey=$vkey'>Confirmez votre compte</a>";
            $headers = "From: app.turnirix@gmail.com \r\n";
            
            // For usage of html in email
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            mail($to,$subject,$message,$headers);
            header('location:pre_verification.php');
            exit;
        }
        else {
            echo "Un compte existe déjà avec $courriel. Veuillez vous <a href='http://turnirix/signin.php'>connecter</a>";
        }    
    }
?>