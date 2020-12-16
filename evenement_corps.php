		<div>
			<div class="jumbotron">

		  		<div class="container">
		    		<?php  
		      			include_once('bdd/connbdd.php');
		      			$evenement = $bdd->query("
				            SELECT *
				            FROM evenement 
				            WHERE DATEDIFF(dateEv, now())=0 AND idO = ".$_SESSION['idO']);

		      			$idP = $bdd->query("
				            SELECT MAX(idP) AS idP
				            FROM poule");

		      			if($idP = $idP->fetch()){
		      				$idP = intval($idP['idP']);
		      			}
		      			else {
		      				$idP = 0;
		      			}

		      			if ($tupleEv = $evenement->fetch()) {
				            echo "<h1 class='display-3 text-truncate text-center'>".$tupleEv['nomEv']."</h1>";

				            $tournois = $bdd->query("
					            SELECT *
					            FROM tournois 
					            WHERE dateT = ? AND lieuT = ?", 
					        	array($tupleEv['dateEv'], $tupleEv['lieuEv']));
				            
				            echo "<p class='text-truncate text-center'>".$tupleEv['nbTournois']." tournois sont prévus au progamme d'aujourd'hui avec comme sport ".$tupleEv['sport']."</p>";
		      			} 
		      			else {
		        			echo "<p>Une erreur est survenue lors du chargement de la page.<br>
		        			Il semblerait qu'aucun programme ne soit prévu pour aujourd'hui.<br>
		        			Veuillez <a href='http://turnirix/tournois.php'>réessayer</a> ou 
		        			<a href='http://turnirix/tournois.php'>contacter le service client</a>.</p>";
		      			}
		    		?>
		    		<script type="text/javascript">
		    			function warning(_this) {
		    				_this.attr("disabled", "true");
		    			}
		    		</script>
		    		<p class="text-center">Attention ! le choix d'une <button id="frime" type="button" class="btn btn-warning" onclick="warning($(this))">formule</button> est irréversible !</p>
		  		</div>
			</div>
		</div>

		<main role='main' class='container'>

			<form method="post" action="bdd/sauvegarderE.php">
				<?php 
					$id = 0;
					$nomTournois = "";
					while ($tupleTournois = $tournois->fetch()) {
						$equipes = $bdd->query("
							SELECT nomEq, niveauEq
							FROM equipe
							WHERE dateT = ? AND lieuT = ? AND nomT = ?", 
							array($tupleEv['dateEv'], $tupleEv['lieuEv'], $tupleTournois['nomT'])); //sélectionner les équipes et leur niveau pour un tournois précis
						$nbEquipe = $bdd->query("
							SELECT COUNT(*) AS nbEquipe
							FROM equipe
							WHERE nomT = ? AND dateT = ? AND lieuT = ?", 
							array($tupleTournois['nomT'], $tupleEv['dateEv'], $tupleEv['lieuEv'])); //compter le nombre d'équipes pour un tournoi précis
						$nbEquipe = $nbEquipe->fetch();
						$nbEquipe = intval($nbEquipe['nbEquipe']);//nombre d'équipes inscrite pour le tournois
						$id++;//pour indexer les tournois à partir de 1
						$nomTournois = $nomTournois.(($nomTournois === "") ? "" : " ; ").$tupleTournois['nomT'];
						
				?>	
					  	<div id="<?php echo $tupleTournois['nomT'] ?>" class='my-3 p-3 bg-white rounded shadow-sm'><!-- id = "nom du tournois" -->
							<h6 class='border-bottom border-gray pb-1 my-2'><?php echo $tupleTournois['nomT'] ?> | <?php echo $tupleTournois['typeJeu'] ?> x <?php echo $tupleTournois['typeJeu'] ?> | <?php echo (!$nbEquipe ? "Aucune équipe inscrite" : ($nbEquipe == 1 ? "Une équipe inscrite" : $nbEquipe." équipes inscrites")) ?></h6>

							<?php if ($nbEquipe !== 0): ?>
								<input type="number" id="<?php echo $tupleTournois['nomT'] ?>NbEqActuel" value="<?php echo $nbEquipe ?>" hidden> <!-- Le nombre d'équipes initial du tournoi n°$id avec id=nbEquipeActuel_ -->

								<input type="number" id="<?php echo $tupleTournois['nomT'] ?>NumTActuel" value="1" hidden> <!-- numéro du premier tour du tournoi n°$id avec id=numTourActuel -->

								<p>
									<?php 
										$listeEqInit = "";
										while ($tupleEq = $equipes->fetch()) {
											$listeEqInit = $listeEqInit.(($listeEqInit === "") ? "" : " ; ").$tupleEq['nomEq'];/*pour récupérer la liste des joueur de base*/
										}
									?>
								</p>

								<input type="text" id="<?php echo $tupleTournois['nomT'] ?>ListeEq" value="<?php echo $listeEqInit ?>" hidden><!-- liste des équipes séparées par " ; " avec comme id=nom du tournoisListeEq -->

								<div id="<?php echo $tupleTournois['nomT'] ?>_1"><!-- id = "nom du tournois_numéro du tour" -->
									<div class='media text-muted pt-3'>
									    <p class='media-body pb-3 mb-0 small lh-125'>
									    	<strong class='d-block text-gray-dark'>Tour 1</strong>
									    </p>
									</div>

									<div class="formule">
										<script type="text/javascript">
											proposition($("#<?php echo $tupleTournois['nomT'] ?>NbEqActuel").attr("value"), "#<?php echo $tupleTournois['nomT'] ?> .formule");
										</script>
									</div><!-- pour proposer les formules -->

									<div class="poule"></div>
								</div>
								<!-- ici, sera rajouté automatiquement le bouton de fermeture du tours après avoir choisi une formule sportive -->
								<!-- Après la fermeture du tour, une nouvelle formule sera proposée en fonction du nombre d'équipes restantes -->
							<?php endif ?>
								
						</div>
				<?php
					}
				?>
				<input type="number" id="nbTournois" value="<?php echo $tupleEv['nbTournois'] ?>" hidden>
				<input type="text" id="nomTournois" value="<?php echo $nomTournois ?>" hidden>
				<input type="text" id="repartir" name="repartir" value="" hidden>
				<input type="text" id="poule" name="poule" value="" hidden>
				<input type="number" name="idP" id="idP" value="<?php echo $idP ?>" hidden>
				<input type="date" name="dateT" id="dateT" value="<?php echo $tupleEv['dateEv'] ?>" hidden>
				<input type="text" name="lieuT" id="lieuT" value="<?php echo $tupleEv['lieuEv'] ?>" hidden>
			</form>

			
		</main>
			
