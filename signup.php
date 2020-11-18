<html>
<head>
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>S'inscrire</title>

    <!-- ONLY FOR THIS FILE (SIGNUP.PHP) -->
    <link rel="stylesheet" type="text/css" href="signup.css">

    <!-- BOOTSTRAP CSS | STYLE CSS FILE FOR HEADER AND FOOTER -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>
  <div class="d-flex w-100 h-100 p-3 mx-auto flex-column">
      <?php require_once 'header.php'; ?>

   <div class="wrapper">
      <h1>Inscription</h1>
      <form>
           <input type="text" placeholder="nom d'utilisateur">
           <input type="text" placeholder="e-mail">
           <input type="password" placeholder="mot de passe">
           <p class="lead">
               <a href="signup2.php" class="btn btn-lg btn-secondary"><b>S'inscrire</b></a>
           </p>
      </form>

      <div class="bottom-text">
           <input type="checkbox" name="remember" checked="checked"> Rester connecté(e)
           <a href="signin.php">J'ai déjà un compte</a>
      </div>

   </div>
      <?php require_once 'footer.php'; ?>
 </div>


  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/bootstrap.js" type="text/javascript"></script>

</body>
</html>
