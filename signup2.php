<html>
<head>
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>S'inscrire</title>

    <!-- ONLY FOR THIS FILE (SIGNUP.PHP) -->
    <link rel="stylesheet" type="text/css" href="signup22.css">

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
           <input type="text" placeholder="nom d'équipe">
           <label for="sport">sport&nbsp</label>
               <select name="sport" id="sport">
               <option value="petanque">pétanque</option>
               <option value="volley">volley</option>
               <option value="tennis">tennis</option>
               <option value="foot">foot</option>
               </select>
           <label for="nbPlayers">&nbsp&nbsp&nbsp&nbsp&nbsp nombre de joueurs&nbsp</label>
           <input type="number" id="nbPlayers" name="nbPlayers" min="1" max="8" step="1" value="1"> <br> <br>

           <p class="lead">
               <a href="signup21.php" class="btn btn-lg btn-secondary"><b>Effectuer un paiement</b></a>
               <a href="signup21.php" class="btn btn-lg btn-secondary"><b>Simulation de paiement</b></a>
           </p>
      </form>


   </div>
      <?php require_once 'footer.php'; ?>
 </div>


  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/bootstrap.js" type="text/javascript"></script>

</body>
</html>
