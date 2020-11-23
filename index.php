<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <!-- ONLY FOR THIS FILE (INDEX.PHP) -->
    <link rel="stylesheet" type="text/css" href="index_1.css">

    <!-- BOOTSTRAP CSS | STYLE CSS FILE FOR HEADER AND FOOTER -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>

    <div class="d-flex w-100 min-vh-100 p-3 mx-auto flex-column">

        <?php require_once 'header.php'; ?>

        <?php if (isset($_SESSION['id'])): ?>
            Une session est active. On met quoi du coup :) ?
        <?php else: ?>
            <main role="main" class="nc_welcome">
                <h1 class="cover-heading">Bienvenue sur Turnirix</h1>
                <p class="lead">Créez un compte et devenez maître du jeu. <br>Inscrivez vous dès à présent et organisez gratuitement des tournois sportifs.</p>
                <p class="lead">
                    <a href="signup.php" class="btn btn-lg btn-secondary">Créer un compte</a>
                </p>
            </main>
        <?php endif ?>

        <?php require_once 'footer.php'; ?>

    </div>

    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="active.js" type="text/javascript"></script>
</body>
</html>