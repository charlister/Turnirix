		<header class="masthead mb-auto">
			<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
				<a class="navbar-brand" href="/">Turnirix</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsExampleDefault">
					<ul class="navbar-nav ml-md-auto">
						<li class="nav-item active">
							<a class="nav-link" href="/">Accueil<span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Sport</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Tournois</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Contact</a>
						</li>

						<?php if (!isset($_SESSION['id'])): ?>
							<li class="nav-item">
								<a class="nav-link" href="signup.php">S'inscrire</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="signin.php">Se connecter</a>
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