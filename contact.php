<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact</title>

  <link rel="stylesheet" type="text/css" href="sign.css">

  <!-- BOOTSTRAP CSS | STYLE CSS FILE FOR HEADER AND FOOTER -->
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
  <div class="d-flex w-100 min-vh-100 p-3 mx-auto flex-column">

    <?php require_once 'header.php'; ?> <!-- HEADER -->

    <!-- MAIN BODY -->

		<div class="container">
        <div class="py-5 text-center">
            <h2>Contactez-nous</h2>
            <p class="lead">Devrions-nous écrire un mot ici ?</p>
        </div>

        <div class="row p-3 mb-3">
          <div class="col-md-8 p-3 order-md-1 mx-auto">
              <form class="" method="post" action="bdd/mail.php">

                <div class="row">

                  <div class="col-md-6 mb-3">
                    <label for="nom">Nom</label>
                    <input type="text" class="nc_form_control" name="nom" id="nom" placeholder="Nom" value="" required>
                    <span class="nc_error" id="aidenom"></span>
                  </div>

                  <div class="col-md-6 mb-3">
                      <label for="prenom">Prénom</label>
                      <input type="text" class="nc_form_control" name="prenom" id="prenom" placeholder="Prénom" value="" required>
                      <span class="nc_error" id="aideprenom"></span>
                  </div>

                </div>

                <div class="mb-3">
                    <label for="courriel">E-mail</label>
                    <input type="email" class="nc_form_control" name="courriel" id="courriel" placeholder="exemple@domaine.fr" value="" required>
                    <span class="nc_error" id="aidecourriel"></span>
                </div>

                <div class="mb-3">
                    <label for="objet">Objet</label><br>
                    <input type="text" name="objet" class="nc_form_control" id="objet" placeholder="(facultatif)" value="">
                </div>

                <div class="mb-3">
                    <label for="message">Message</label><br>
                    <textarea name="message" class="nc_form_control" id="message" placeholder="Saisissez votre message" required style="min-height:200px"></textarea>
                    <span class="nc_error" id="aidemessage"></span>
                </div>


                <hr class="mb-4">

                <button name="contact" class="btn btn-primary nc_btn_block btn-lg" type="submit">Envoyer</button>
            </form>
        </div>
      </div>
    </div>

    <!-- END MAIN BODY -->

    <?php require_once 'footer.php'; ?> <!-- FOOTER -->

  </div>

  <script src="contact.js" type="text/javascript"></script>
  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/bootstrap.js" type="text/javascript"></script>
  <script src="active.js" type="text/javascript"></script>
  
</body>
</html>
