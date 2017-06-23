<?php
$prenomUser = $_SESSION['prenomUser'];
?>


<?php

$cheminCourantind = getcwd();
$dirCourantind = substr(strrchr($cheminCourantind, "\\"), 1);



//recuperer le nom du dossier au desssus du dossier courant
$cheminJusqueAuDessusind = substr($cheminCourantind, 0, strrpos( $cheminCourantind, '\\') );
$justeNomDossierDessusind = substr(strrchr($cheminJusqueAuDessusind, "\\"), 1);


$machaine3 = '/'.$dirCourantind.'/accueil.php';

?>



<nav class="navbar navbar-default navbar-fixed-top" style="background-color:white">
		<div class="container">
		    </section>
			</div>
			
<!-- 			
 coleur google cest avec le code suivant: style="color: #0266C8"
 -->		

 				
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapsed" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>		
					</button>	
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1 " style="color: #0266C8">
					<ul class="nav navbar-nav">
					
			<!-- <a href="/accueil.php" onclick="return false;" >ACCUEIL</a> -->
						<li><a href="<?=$machaine3?>" ><font size="3" face="Playfair Display"><em>Accueil</em></font></a></li>
						<li><a href="" onclick="return false;"><span class="glyphicon glyphicon-user"><font size="3" face="Playfair Display"><em> Bienvenue <?=$prenomUser?></em></font></span></a></li>
						<li><a href="panier.php"><span class="glyphicon glyphicon-shopping-cart"><font size="3" face="Playfair Display"><em>Panier</em></font></span></a></li>
						<li><a href="monComptePerso.php"><span class="glyphicon glyphicon-cog"><font size="3" face="Playfair Display"><em>Votre espace perso</em></font></span></a></li>	
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"><font size="3" face="Playfair Display"><em>Se déconnecter</em></font></span></a></li>				
					</ul>

				</div>
			
			
			
			
			
			
			

				<!-- 
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Men<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
						<li><a href="#">Croisiere</a></li>
						<li><a href="#">Parametres compte</a></li>
						<li><a href="#">Panier</a></li>
						<li><a href="#">Paiement des croisieres</a></li>
						</ul>
					</li>
				</ul>
 				-->		
 		</div>
	</nav>
