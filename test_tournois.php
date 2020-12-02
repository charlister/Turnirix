    <main role="main">

      <div class="jumbotron">

        <div class="container">
          <h1 class="display-3 text-truncate">Evénement</h1>
          <p>
            Résumé des informations sur le prochain événement (activer le bouton de lancement la date venue ...).
          </p>
          <p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Lancer l'événement</a>
          </p>
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
              <button id="creer" type="button" class="btn btn-secondary">Créer événement</button>
            </p>

            <span id="creation" class="eventForm">
              <div class="p-3">

                  <form method="post" action="">

                    <div class="mb-3">
                      <label for="eventName">Nom</label> <br>
                      <input type="text" class="nc_form_control" name="eventName" id="eventName" placeholder="Nom de l'événement" required>
                    </div>

                    <div class="mb-3">
                      <label for="eventZone">Lieu</label> <br>
                      <input type="text" class="nc_form_control" name="eventZone" id="eventZone" placeholder="Lieu de l'événement" required>
                    </div>

                    <div class="mb-3">
                      <label for="eventDate">Date</label>
                      <input type="date" class="nc_form_control" name="eventDate" id="eventDate" value="" required>
                    </div>

                    <hr class="mb-4">

                    <button name="create" type="submit" class="btn btn-primary nc_btn_block btn-lg text-wrap text-truncate">Créer</button>
                  </form>

              </div>
            </span>

          </div>

          <!-- Edition d'un événement -->
          <div class="col-md-4">
            <h2>Modifier un événement</h2>
            <p class="text-justify">
              Dans cette section, vous pourrez ajouter des tournois à l'un des événements que vous avez créé. 
            </p>
            <p>
              <button id="editer" type="button" class="btn btn-secondary">Editer événement</button>
            </p>

            <span id="edition" class="eventForm">
              <div class="p-3">

                  <form method="post" action="">

                    <div class="mb-3">
                      <label for="event">Evénement</label> <br>
                      <select id="event" name="event" class="nc_form_control">
                        <option>E1</option>
                        <option>E2</option>
                        <option>En</option>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="tournementName">Nom du tournoi</label> <br>
                      <input type="text" class="nc_form_control" name="tournementName" id="tournementName" placeholder="Nom du tournoi" required>
                    </div>

                    <div class="mb-3">
                      <label for="tournementType">Type de jeu</label> <br>
                      <input type="number" class="nc_form_control" name="tournementType" id="tournementType" min="1" value="1">
                    </div>

                    <hr class="mb-4">

                    <button id="edit" name="editer" type="submit" class="btn btn-primary nc_btn_block btn-lg text-wrap text-truncate">Ajouter</button>

                  </form>

              </div>
            </span>

          </div>

          <!-- Préinscription d'équipes -->
          <div class="col-md-4">

            <h2>Préinscrire une équipe</h2>
            <p class="text-justify">
              Ici, vous pouvez inscrire des équipes à l'un des tournois que vous proposez aucours d'un événement donnée. 
            </p>
            <p>
              <button id="enregistrer" type="button" class="btn btn-secondary">Préinscrire équipe</button>
            </p>

            <span id="enregistrement" class="eventForm">
              <div class="p-3">
                <form method="post" action="">

                  <div class="mb-3">
                    <label for="event">Evénement</label> <br>
                    <select name="event" class="nc_form_control">
                      <option>E1</option>
                      <option>E2</option>
                      <option>En</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="tournement">Tournois</label> <br>
                    <select name="tournement" class="nc_form_control">
                      <option>T1</option>
                      <option>Tn</option>
                    </select>
                  </div>

                  <div class="pb-3">
                    <label for="teamName">Nom de l'équipe</label>
                    <input type="text" id="teamName" name="teamName" class="nc_form_control" placeholder="Nom de l'équipe" required>
                  </div>
                      

                  <input type="number" name="nbPlayer" id="nbPlayer" value="1" hidden>

                  <div class=""> <!-- Modifier le fichier js en cas changement des l'une des ligne suivante pour une conformité relative -->
                    <div class="mb-3">
                      <label>Nom et niveau de joueurs</label>
                      <input type="text" id="joueur1" name="joueur1" class="nc_form_control" placeholder="Nom du joueur">
                    </div>
                    <div class="mb-3">
                      <select id="niveau1" name="niveau1" class="nc_form_control">
                        <option selected>Pro</option>
                        <option>Elite</option>
                        <option>Régional</option>
                        <option>Départemental</option>
                        <option>Loisir</option>
                      </select>
                    </div>
                  </div>

                  <button type="button" name="ajouter" id="ajouter" class="btn btn-primary">+</button>
                  
                  <hr class="my-4">
                  <button class="btn btn-primary nc_btn_block btn-lg text-wrap text-truncate" type="submit" id="register">Enregistrer</button>

                </form>
              </div>
            </span>
              

          </div>

        </div>
        <hr>
      </div> <!-- /container -->

    </main>