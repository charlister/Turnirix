    <main role="main">

      <div class="jumbotron">

        <div class="container">
          <?php  
            include_once('bdd/connbdd.php');
            $evenementPrevuToday = $bdd->query("
              SELECT *
              FROM evenement 
              WHERE DATEDIFF(dateEv, now())=0 AND idO = ".$_SESSION['idO']);

            if ($tupleEvPrevuToday = $evenementPrevuToday->fetch()) {
              echo "<h1 class='display-3 text-truncate'>".$tupleEvPrevuToday['nomEv']."</h1>";
              echo "<p>Vous avez un évènement prévu pour aujourd'hui.</p>";
              echo "<p><a class='btn btn-primary btn-lg' href='evenement.php' role='button'>Lancer l'événement</a></p>";
            } else {
              echo "<p>Aucun évènement n'est prévu pour aujourd'hui.</p>";
            }
            
          ?>

        </div>

      </div>

      <div class="container">
        <div class="row">

          <!-- Création d'un événement -->
          <div class="col-md-4">
            <h2>Créer un événement</h2>
            <p class="text-justify">
              Renseignez les informations nécessaire à la création d'un événement afin de réunir des équipes autours de divers tournois. 
            </p>
            <p>
              <button id="creer" type="button" class="btn btn-secondary">Créer événement</button><!-- Bouton lié au span de création -->
            </p>

          </div>

          <!-- Préinscription d'équipes -->
          <div class="col-md-4">

            <h2>Préinscrire une équipe</h2>
            <p class="text-justify">
              Ici, vous pouvez inscrire des équipes à l'un des tournois que vous proposez aucours d'un événement donnée. 
            </p>
            <p>
              <button id="enregistrer" type="button" class="btn btn-secondary">Préinscrire équipe</button><!-- Bouton lié au span de préinscription -->
            </p>

          </div>

        </div>
        <hr>

        <!-- FORMULAIRE DE CREATION -->
        <span id="creation" class="eventForm">
          <div class="p-3">

              <form method="post" action="bdd/gererEvenement.php">

                <div class="mb-3">
                  <label for="nomEv">Nom</label> <br>
                  <input type="text" class="nc_form_control" name="nomEv" id="nomEv" placeholder="Nom de l'événement" required>
                </div>

                <div class="mb-3">
                  <label for="lieuEv">Lieu</label> <br>
                  <input type="text" class="nc_form_control" name="lieuEv" id="lieuEv" placeholder="Lieu de l'événement" required>
                </div>

                <div class="mb-3">
                  <label for="dateEv">Date</label>
                  <input type="date" class="nc_form_control" name="dateEv" id="dateEv" value="" required>
                </div>

                <div class="mb-3">
                  <label for="sport">Sport</label> <br>
                  <select id="sport" name="sport" class="nc_form_control">
                    <option value="Tennis" selected>Tennis</option>
                    <option value="Football">Football</option>
                    <option value="Pétanque">Pétanque</option>
                    <option value="Volley-ball">Volley-ball</option>
                  </select>
                </div>

                <hr class="mb-4">

                <div class="mb-3">
                  <label for="nomT1">Nom du tournoi</label> <br>
                  <input type="text" class="nc_form_control" name="nomT1" id="nomT1" placeholder="Nom du tournoi" required>
                </div>

                <div class="mb-3">
                  <label for="typeJeu1">Type de jeu</label> <br>
                  <input type="number" class="nc_form_control" name="typeJeu1" id="typeJeu1" min="1" value="1">
                </div>

                <div class="mb-3">
                  <label for="frais1">Frais de participation</label> <br>
                  <input type="number" class="nc_form_control" name="frais1" id="frais1" min="0" value="0">
                </div>

                <input type="number" name="nbTournois" id="nbTournois" value="1" hidden><!-- Pour avoir le nombre de tournois ajoutés -->

                <button type="button" name="ajouterTournoi" id="ajouterTournoi" class="btn btn-primary text-wrap text-truncate">Ajouter tournoi</button>

                <hr class="mb-4">

                <button name="create" type="submit" class="btn btn-primary nc_btn_block btn-lg text-wrap text-truncate">Créer</button>
              </form>

          </div>
        </span>

        <!-- FORMULAIRE D'ENREGISTREMENT -->
        <span id="enregistrement" class="eventForm">
          <div class="p-3">
            <form method="post" action="bdd/gererEvenement.php">
              <!-- LISTE DE CHOIX DU TOURNOIS -->
              <?php  
                include_once('bdd/connbdd.php');

                $id = intval(htmlspecialchars($_SESSION['idO']));
                $nomEv = $bdd->query("
                  SELECT * 
                  FROM evenement 
                  WHERE DATEDIFF(dateEv, now())>=0 AND idO=$id 
                  ORDER BY dateEv"); /*Sélectionner les évènements qui ont une date ultérieure ou actuelle pour les proposer à l'organisateur lors de l'inscription des équipes*/

                echo "<ul class='mb-3'>";
                $b = false;
                while ($tupleEv = $nomEv->fetch()) {
                  $b = true;
                  echo "<li class=''>";
                    echo "Evénement ".$tupleEv['nomEv']." | le ".$tupleEv['dateEv']." | à ".$tupleEv['lieuEv'];
                    echo "<ul >";

                      $tournois = $bdd->query("
                        SELECT * 
                        FROM tournois 
                        WHERE dateT=? AND lieuT=? 
                        ORDER BY dateT", 
                        array($tupleEv['dateEv'], $tupleEv['lieuEv']));/*selectionner les tournois correspondant à l'événement actuel (identifié par le nom et le lieu*/
                      while ($tupleT = $tournois->fetch()) {
                        echo "<li>";
                          echo "<input type='radio' name='choixTournois' value='".$tupleT['nomT'].";".$tupleT['dateT'].";".$tupleT['lieuT']."'>";/*value="nomT;dateT;lieuT"*/
                          echo "Nom du tournoi : ".$tupleT['nomT']." ; Type de jeu : ".$tupleT['typeJeu']." ; Frais de participation : ".$tupleT['frais'];
                        echo "</li>";
                      }
                    echo "</ul>";
                  echo "</li>";
                }
                echo "</ul>";
              ?>

              <!-- NOM DE L'EQUIPE -->
              <?php if (!$b): ?>
                <p>Aucun évènement n'est à venir.</p>
              <?php else: ?>
                <div class="pb-3">
                  <label for="nomEq">Nom de l'équipe</label>
                  <input type="text" id="nomEq" name="nomEq" class="nc_form_control" placeholder="Nom de l'équipe" required>
                </div>
                
                <!-- JOUEURS DE L'EQUIPE -->
                <div class=""> <!-- Modifier le fichier js en cas changement des l'une des ligne suivante pour une conformité relative -->
                  <div class="mb-3">
                    <label>Nom et niveau de joueurs</label>
                    <input type="text" id="joueur1" name="joueur1" class="nc_form_control" placeholder="Nom du joueur">
                  </div>
                  <div class="mb-3">
                    <select id="niveau1" name="niveau1" class="nc_form_control">
                      <option value="1" selected>Pro</option>
                      <option value="2">Elite</option>
                      <option value="3">Régional</option>
                      <option value="4">Départemental</option>
                      <option value="5">Loisir</option>
                    </select>
                  </div>
                </div>

                <input type="number" name="nbJoueurs" id="nbJoueurs" value="1" hidden><!-- Champ caché pour compter le nombre de joueurs ajoutés -->
                <button type="button" name="ajouterJoueur" id="ajouterJoueur" class="btn btn-primary">Ajouter joueur</button><!-- Pour ajouter un joueur de l'équipe -->
                
                <hr class="my-4">
                <button type="submit" class="btn btn-primary nc_btn_block btn-lg text-wrap text-truncate" id="register" name="register">Enregistrer</button>
              <?php endif ?>
                
            </form>
          </div>
        </span>

      </div> <!-- /container -->

    </main>