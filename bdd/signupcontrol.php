<?php
    session_start();
    include_once('connbdd.php'); // Fichier PHP contenant la connexion à votre BDD



    if(isset($_POST['submit'])){
    
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $courriel = $_POST['courriel'];
        $mdp = $_POST['mdp'];
        $confmdp = $_POST['confmdp'];
        $anniv = $_POST['anniv'];
        $sexe = $_POST['sexe'];

        // Se connecter à la base de données
        $mysqli = NEW MySQLi('localhost','root','','turnirix');

        // Encryption
        $vkey = md5(time().$courriel);
        $mdp = md5($mdp);

        // Insertion des données
        $insert = $mysqli->query("
          INSERT INTO organisateur(nom,prenom,courriel,mdp,anniv,sexe,vkey) VALUES('$nom','$prenom','$courriel','$mdp','$anniv','$sexe','$vkey')");

        if($insert){
            // Envoyer la vérification par e-mail
            $to = $courriel;
            $subject = "Email Verification";
            $message = "<a href='http://localhost/bdd/verification.php?vkey=$vkey'>Verify your account</a>";
            $headers = "From: app.turnirix@gmail.com \r\n";
            
            // Pour utilisation du HTML dans un e-mail
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            mail($to,$subject,$message,$headers);
            header('location:pre_verification.php');

        }
        else{
            echo "Fail";
        }
    }




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