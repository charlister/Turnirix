<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournois</title>

    <!-- tournois css CODE -->
    <link rel="stylesheet" type="text/css" href="sign.css"> <!-- important pour les formulaire de la page -->
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>

	<div class="d-flex w-100 h-100 p-3 mx-auto flex-column">

		<?php require_once 'header.php'; ?>

		<!-- DEBUT DU CODE -->

		<?php include_once 'tournois_corps.php'; ?>

		<!-- FIN DU CODE -->

		<?php require_once 'footer.php'; ?>

	</div>

    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="tournois.js" type="text/javascript"></script>
    <script src="active.js" type="text/javascript"></script>
</body>
</html>