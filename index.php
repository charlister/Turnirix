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
    <?php if (isset($_SESSION['id'])): ?>
        <link rel="stylesheet" type="text/css" href="index_2.css">
    <?php else: ?>
        <link rel="stylesheet" type="text/css" href="index_1.css">
    <?php endif ?>
    

    <!-- BOOTSTRAP CSS | STYLE CSS FILE FOR HEADER AND FOOTER -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>

    <div class="d-flex w-100 min-vh-100 p-3 mx-auto flex-column">

        <?php require_once 'header.php'; ?>

        <?php if (isset($_SESSION['id'])): ?>
            <main class="mt-5" role="main">

              <div id="myCarousel" class="carousel slide" data-ride="carousel">

                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                  <li data-target="#myCarousel" data-slide-to="3"></li>
                  <li data-target="#myCarousel" data-slide-to="4"></li>
                </ol>

                <div class="carousel-inner">

                  <div class="carousel-item active">
                    <svg>
                      <rect width="100%" height="100%" style="fill:grey;stroke-width:3;stroke:rgb(0,0,0,0)"></rect>
                      <img src="images/sport_petanque2.jpg" class="img-fluid">
                    </svg>

                    <div class="container">
                      <div class="carousel-caption text-left">
                        <h1>Petanque</h1>
                        <p class="text-wrap text-justify text-truncate">XXXXXXXXXXX XXXXXXX XXXXXXXX XXXX XXXXX XXXXXXXXXXX XXXXXX XXXXXXXXXX XXXXXXX XXXXXXX XXXXXXXXXXXX</p>
                      </div>
                    </div>
                  </div>

                  <div class="carousel-item">
                    <svg>
                      <rect width="100%" height="100%" style="fill:grey;stroke-width:3;stroke:rgb(0,0,0,0)"></rect>
                      <img src="images/sport_volleyball.jpg" class="img-fluid">
                    </svg>

                    <div class="container">
                      <div class="carousel-caption text-left">
                        <h1>Volley</h1>
                        <p class="text-wrap text-justify text-truncate">XXXXXXXXXXX XXXXXXX XXXXXXXX XXXX XXXXX XXXXXXXXXXX XXXXXX XXXXXXXXXX XXXXXXX XXXXXXX XXXXXXXXXXXX</p>
                      </div>
                    </div>
                  </div>

                  <div class="carousel-item">
                    <svg>
                      <rect width="100%" height="100%" style="fill:grey;stroke-width:3;stroke:rgb(0,0,0,0)"></rect>
                      <img src="images/sport_tennis2.jpg" class="img-fluid">
                    </svg>

                    <div class="container">
                      <div class="carousel-caption text-left">
                        <h1>Tennis</h1>
                        <p class="text-wrap text-justify text-truncate">XXXXXXXXXXX XXXXXXX XXXXXXXX XXXX XXXXX XXXXXXXXXXX XXXXXX XXXXXXXXXX XXXXXXX XXXXXXX XXXXXXXXXXXX</p>
                      </div>
                    </div>
                  </div>

                  <div class="carousel-item">
                    <svg>
                      <rect width="100%" height="100%" style="fill:grey;stroke-width:3;stroke:rgb(0,0,0,0)"></rect>
                      <img src="images/sport_foot2.jpg" class="img-fluid">
                    </svg>

                    <div class="container">
                      <div class="carousel-caption text-left">
                        <h1>Foot</h1>
                        <p class="text-wrap text-justify text-truncate">XXXXXXXXXXX XXXXXXX XXXXXXXX XXXX XXXXX XXXXXXXXXXX XXXXXX XXXXXXXXXX XXXXXXX XXXXXXX XXXXXXXXXXXX</p>
                      </div>
                    </div>
                  </div>

                  <div class="carousel-item">
                    <svg>
                      <img src="../images/OZ75PD0.jpg" class="img-fluid">
                    </svg>

                    <div class="container">
                      <div class="carousel-caption">
                        <h1>Image ?</h1>
                        <p class="text-wrap text-justify text-truncate">XXXXXXXXXXX XXXXXXX XXXXXXXX XXXX XXXXX XXXXXXXXXXX XXXXXX XXXXXXXXXX XXXXXXX XXXXXXX XXXXXXXXXXXX</p>
                      </div>
                    </div>
                  </div>

                </div>

                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>

                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>

              </div>

              <!-- Rajouter un peu plus d'informations sur la page . -->
            </main>
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