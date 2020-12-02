		<header class="masthead mb-auto">
			<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
				<a class="navbar-brand" href="/">Turnirix</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsExampleDefault">
					<ul class="navbar-nav ml-md-auto">
						<li class="nav-item">
							<!-- L'acceuil sera toujours visible mais son contenue d'épendra du fait que l'utilisateur soit connecté ou pas. -->
							<a class="nav-link" href="/">Accueil</a>
						</li>

						<?php if (isset($_SESSION['id'])): ?>
							<!-- La gestion d'un tournois n'apparaîtra que pour les utilisateur authentifiés. -->
							<li class="nav-item">
								<a class="nav-link" href="/tournois.php">Tournois</a>
							</li>
						<?php endif ?>
						
						<!-- Formulaire de contact accessible par tous -->
						<li class="nav-item">
							<a class="nav-link" href="/contact.php">Contact</a>
						</li>

						<?php if (!isset($_SESSION['id'])): ?>
							<li class="nav-item">
								<a class="nav-link" href="/signup.php">S'inscrire</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/signin.php">Se connecter</a>
							</li>
						<?php else: ?>
							<li class="nav-item">
								<a class="nav-link" href="bdd/disconn.php">Se déconnecter</a>
							</li>
						<?php endif ?>
							
					</ul>
				</div>
			</nav>
		</header>