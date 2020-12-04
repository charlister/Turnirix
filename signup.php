<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>S'inscrire</title>

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
            <h2>Créez votre compte Turnirix</h2>
            <p class="lead">Devrions-nous écrire un mot ici ?</p>
        </div>

        <div class="row p-3 mb-3">
          <div class="col-md-8 p-3 order-md-1 mx-auto">
              <form class="" method="POST" action="bdd/signupcontrol.php">

                <div class="row">

                  <div class="col-md-6 mb-3">
                    <label for="nomO">Nom</label>
                    <input type="text" class="nc_form_control" name="nomO" id="nomO" placeholder="Nom" value="" required>
                    <span class="nc_error" id="aidenom"></span>
                  </div>

                  <div class="col-md-6 mb-3">
                      <label for="prenomO">Prénom</label>
                      <input type="text" class="nc_form_control" name="prenomO" id="prenomO" placeholder="Prénom" value="" required>
                      <span class="nc_error" id="aideprenom"></span>
                  </div>

                </div>

                <div class="mb-3">
                    <label for="courriel">E-mail</label>
                    <input type="email" class="nc_form_control" name="courriel" id="courriel" placeholder="exemple@domaine.fr" required>
                    <span class="nc_error" id="aidecourriel"></span>
                    <span class="nc_error" id="res"></span>
                </div>

                <div class="row">

                  <div class="col-md-6 mb-3">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" class="nc_form_control" name="mdp" id="mdp" placeholder="********" required>
                    <span class="nc_error" id="aidemdp"></span>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="confmdp">Confirmer mot de passe</label>
                    <input type="password" class="nc_form_control" name="confmdp" id="confmdp" placeholder="********" required>
                    <span class="nc_error" id="aideconfmdp"></span>
                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6 mb-3">
                    <label for="anniv">Date de naissance</label>
                    <input type="date" class="nc_form_control" name="anniv" id="anniv" value="" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="sexe">Sexe</label><br>
                    <input type="radio" name="sexe" id="sexeh" value="H" checked>
                    <label class="" for="sexeh">Homme</label>

                    <input type="radio" name="sexe" id="sexef" value="F">
                    <label for="sexef">Femme</label>
                  </div>

                </div>

                <hr class="mb-4">

                <div>
                  <small>En cliquant sur le bouton S'inscrire, vous accepter nos <a href="#">Conditions générales</a></small><br>
                  <small><a href="signin.php">J'ai déjà un compte</a></small>
                </div>

                <hr class="mb-4">

                <button name="submit" class="btn btn-primary nc_btn_block btn-lg" type="SUBMIT">S'inscrire</button>

            </form>
        </div>
      </div>
    </div>

    <!-- END MAIN BODY -->

    <?php require_once 'footer.php'; ?> <!-- FOOTER -->

  </div>

  <script src="signup.js" type="text/javascript"></script>
  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/bootstrap.js" type="text/javascript"></script>
  <script src="active.js" type="text/javascript"></script>
  
</body>
</html>