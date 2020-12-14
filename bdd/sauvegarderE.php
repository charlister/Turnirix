<?php
    session_start();
    include_once('connbdd.php'); // Fichier PHP contenant la connexion à votre BDD

    if (isset($_POST['sauvegarderE']) && isset($_POST['repartir']) && isset($_POST['poule'])) {
        $repartir = $_POST['repartir'];
        $repartir = explode(";", $repartir);
        for ($i=0; $i < count($repartir); $i++) {
            $bdd->register("
                INSERT INTO repartir (nomEq, nomT, dateT, lieuT, idP, rang) 
                VALUES (?, ?, ?, ?, ?, ?)", 
                explode(",", $repartir[$i]));
        }

        $poule = $_POST['poule'];
        $poule = explode(";", $poule);
        for ($i=0; $i < count($poule); $i++) {
            $bdd->register("
                INSERT INTO poule (idP, tour, nombreEq) 
                VALUES (?, ?, ?)", 
                explode(",", $poule[$i]));
        }

        echo "Les informations de l'événement ont bien étés sauvegardées ! Retourner à la page d'<a href='http://turnirix/'>accueil</a>";
    }
    else {
        echo "Une erreur est survenue lors de la sauvegarde des données de l'événement. Actualisez la page ou retournez vers la page d'<a href='http://turnirix/'>principale</a>";
    }
?>