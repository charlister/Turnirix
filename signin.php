<?php 
    session_start();
?>  

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Se connecter</title>

  <link rel="stylesheet" type="text/css" href="sign.css">

  <!-- BOOTSTRAP CSS | STYLE CSS FILE FOR HEADER AND FOOTER -->
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
  <div class="d-flex w-100 min-vh-100 p-3 mx-auto flex-column bodysignin">

    <?php require_once 'header.php'; ?> <!-- HEADER -->

    <!-- MAIN BODY -->

    <div class="container">

      <div class="py-5 text-center">
        <h2>Connectez-vous à votre compte Turnirix</h2>
        <p class="lead">en seulement quelques clics</p>
      </div>

      <div class="row p-3">
        <div class="col-md-5 p-3 order-md-1 mx-auto boxsignin">

          <form method="post" action="bdd/signincontrol.php">
            <div class="mb-3">
              <label for="courriel">E-mail</label> <br>
              <input type="email" class="nc_form_control" name="courriel" id="courrielid" placeholder="exemple@domaine.fr" required>
              <span class="nc_error" id="aidecourriel"></span>
            </div>
            <div class="mb-3">
              <label for="mdp">Mot de passe</label> <br>
              <input type="password" class="nc_form_control" name="mdp" id="mdpid" placeholder="********" required>
            </div>

            <hr class="mb-4">

              <div class="bottom-text">
                <input type="checkbox" id='remember' name="remember" checked="checked">
                <label for="remember">Rester connecté(e)</label> 
              </div>

            <hr class="mb-4">

            <button name="signin" type="submit" class="btn btn-primary nc_btn_block btn-lg">Se connecter</button>
          </form>
          
        </div>
      </div>

    </div>

    <!-- END MAIN BODY -->

    <?php require_once 'footer.php'; ?> <!-- FOOTER -->

  </div>

  <script src="signin.js" type="text/javascript"></script>
  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/bootstrap.js" type="text/javascript"></script>
  <script src="active.js" type="text/javascript"></script>
  
</body>
</html>



    