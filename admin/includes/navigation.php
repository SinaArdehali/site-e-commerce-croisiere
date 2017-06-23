<nav class="navbar navbar-default navbar-fixed-top" style="background-color:#0266C8">
		<div class="container">
			<a href="/CroisierePourTous/admin/index.php" class="navbar-brand" style="color: white">ADMINISTRATION DU SITE</a>
			

		    </section>
			<!-- </div> -->

				
				<ul class="nav navbar-nav">
					<li><a href="croisiere.php" style="color:white; font-weight:bold; text-decoration:underline overline ;">Croisieres</a></li>
					<li><a href="partenaires.php" style="color:white; font-weight:bold; text-decoration:underline overline ;">Partenaires</a></li>
					<?php if(has_permission('admin')): ?>
					<li><a href="users.php" style="color:white; font-weight:bold; text-decoration:underline overline ;">users</a></li>
					<?php endif; ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?=$user_data['prenom']; ?>!
						<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="change_password.php">change password</a></li>
							<li><a href="logout.php">Log out</a></li>
						</ul>
					</li>

				<!-- 
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Men<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
						<li><a href="#">Croisiere</a></li>
						<li><a href="#">Parametres compte</a></li>
						<li><a href="#">Panier</a></li>
						<li><a href="#">Paiement des croisieres</a></li>
						</ul>
					</li>
					-->	
				</ul>
 					
 		</div>
	</nav>
