<?php header("Content-Type: text/html; charset=UTF-8");
session_start();
?>
<?php
/*require_once 'core/init.php';*/

$db= mysqli_connect('127.0.0.1', 'root', '', 'croisierepourtousnouvelle');

if(mysqli_connect_errno()){
	echo 'Database connection failed with following errors:'. mysqli_connect_errno();
	die();
}



include 'includes/head.php';
include 'includes/navigation.php';/*
include 'includes/headerpartial.php';*/
/*$cart_id ='';*/

$_SESSION['idUser'] = $_SESSION['SBUser'];
$idUser = $_SESSION['idUser'];

$queryImageModal10 = "SELECT *
	FROM panier
	WHERE idPersonne = '$idUser'
	order by idCategorie
	";
$resultImageComplet10 = $db->query($queryImageModal10);
$imageCompletModal10 = mysqli_fetch_assoc($resultImageComplet10);

/*echo "<script> alert('".$idBite." je suis la') </script>";*/

$idPanier = $imageCompletModal10['idPanier'];

/*$idPanier = '33';*/



$rquery21 = $db -> query("select * from categorie Cat, croisiere C, panier P
	where Cat.idCroisiere = C.idCroisiere 
	and P.idCategorie = Cat.idCategorie 
	and P.idPersonne='$idUser'
	order by Cat.idCategorie");




if($idPanier != ''){
	$idPanier;
}
echo '<br>';
echo '<br>';
echo '<br>';
echo $idUser;
?>



<!-- 
<?php header("Content-Type: text/html; charset=UTF-8");?>
 -->


<div class="paddingPanier">
	<div class="col-md-12">
		<div class="row">
			<h2 class="text-center">Mon Panier</h2><hr>
			<?php if($idPanier == ''): ?>
				<div class="bg-danger">
					<p class="text-center text-danger">Votre panier est vide</p>
					
				</div>
			<?php else:?>
				<!-- <table class="table table-bordered table-condensed table-striped"> -->
					<table class="table table-hover">
					<thead>
					<tr>
					<th>Croisière</th><th>Catégorie</th><th>Nombre de Places</th><th>Prix Unitaire</th><th>Sous-Total</th><th>Supprimer</th>
					</tr>
					</thead>
					<tbody>
						<?php while($tabquery21 = mysqli_fetch_assoc($rquery21)) : ?>

	<!-- 						le nom de la cayeogrie pour cet idcategorie -->
							<?php

								$idCroisiere21 = $tabquery21['idCroisiere'];
								echo "<script> alert('".$idCroisiere21." je suis laaaakkkk') </script>";
								$idCategorie3 = $tabquery21['idCategorie'];
								$rquery22 = $db ->query("select * from categorie where idCategorie = '$idCategorie3'");
								$tabquery22 = mysqli_fetch_assoc($rquery22);
							?>

							<?php
								$rquery23 = $db ->query("select * from panier where idPanier = '$idPanier'");
								$tabquery23 = mysqli_fetch_assoc($rquery23);
							?>

							<?php
							$queryImageModal11 = "SELECT *
								FROM panier
								WHERE idPersonne = '$idUser'
								and idCategorie = '$idCategorie3'
								order by idCategorie
								";
							$resultImageComplet11 = $db->query($queryImageModal11);
							?>


							<?php global $sousTotalPanier;?>

							<?php while($imageCompletModal11 = mysqli_fetch_assoc($resultImageComplet11)) : ?>

							<?php
							$queryImageModal13 = "SELECT *
								FROM place P, categorie Cat
								WHERE P.idCategorie = Cat.idCategorie
								";
							$resultImageComplet13 = $db->query($queryImageModal13);
							$tabImgComplet13 = mysqli_fetch_assoc($resultImageComplet13);

							?>

							<?php
							echo "<script> alert('".$tabImgComplet13['prixUnitaire']." je suis laaaajjj') </script>";
							$SousTotalCroisiere = $imageCompletModal11['nbPlaces'] * $tabImgComplet13['prixUnitaire'];
							$sousTotalPanier = $sousTotalPanier+$SousTotalCroisiere;
							echo "<script> alert('".$SousTotalCroisiere." je suis laaaa') </script>";
							?>

							<?php
							$queryImageModal = "SELECT *
							FROM categorie Cat, description D, image I
							WHERE D.idCroisiere = Cat.idCroisiere
							AND D.idCroisiere = '$idCroisiere21'
							AND D.idDescription = I.idDescription
							AND I.type = 'logo'
							";
							$resultImageComplet = $db->query($queryImageModal);
							$tabImageComplet = mysqli_fetch_assoc($resultImageComplet)
							?>


								<tr>

										<td class="col-sm-8 col-md-6">
			                       			<div class="media">
			                            	<a class="thumbnail pull-left" href="#"> <img class="media-object" src="<?= $tabImageComplet['lien'] ; ?>" style="width: 72px; height: 72px;"> </a>
				                            	<div class="media-body">
				                                <h4 class="media-heading"><a href="#"><?=$tabquery21['nomCroisiere'];?></a></h4>
												<!-- <span>Status: </span><span class="text-success"><strong>In Stock</strong></span> -->
				                            	</div>
			                        		</div>
		                        		</td>
		                        		
		                        		<td class="col-sm-1 col-md-1 text-center"><strong><?=$tabquery22['nomCategorie'];?></strong></td>
		                        
		                        		<td class="col-sm-1 col-md-1" style="text-align: center">
			                        		

				                        			<input type="email" class="form-control" id="exampleInputEmail1" value="<?=$imageCompletModal11['nbPlaces'];?>">

				                        		
		                        		</td>
		                        
		                        		<td class="col-sm-1 col-md-1 text-center"><strong><?=$tabImgComplet13['prixUnitaire'];?>€</strong></td>
		                        
		                        		<td class="col-sm-1 col-md-1"><strong><?=$SousTotalCroisiere;?>€</strong></td>
		                        
		                        		<td class="col-sm-1 col-md-1">
					                        <button type="button" class="btn btn-danger">
					                            <span class="glyphicon glyphicon-remove"></span> Supprimer
					                        </button>
					                            <br>
					                            <br>
					                         <button type="button" class="btn btn-labeled btn-info">
             									<span class="btn-label"><i class="glyphicon glyphicon-refresh"></i></span> Actualiser
             								</button>
				                        </td>
								</tr>							
							<?php endwhile; ?>
						<?php endwhile; ?>
					</tbody>

					<tfoot>
	                    <tr>
	                        <td>   </td>
	                        <td>   </td>
	                        <td>   </td>
							<td>   </td>
	                        <td><h5>Sous-Total Panier<br><br><br>Promotion</h5><h3>Total Panier</h3></td>
	                        <td class="text-right"><h5><strong><?=$sousTotalPanier?> €<br><br><br>0 €</strong></h5><h3><?=$sousTotalPanier?> €</h3></td>
	                    </tr>
	                    <tr>
	                        <td>   </td>
	                        <td>   </td>
	                        <td>   </td>
	                        <td>   </td>
	                        <td>
	                        <button type="button" class="btn btn-default">
	                            <span class="glyphicon glyphicon-shopping-cart"></span> Continuer mes achats
	                        </button></td>
	                        <td>
	                        <button type="button" class="btn btn-success" onclick="redirectionPaiement()">
	                            Paiement <span class="glyphicon glyphicon-play"></span>
	                        </button></td>

	                    </tr>
                	</tfoot>


				</table>
			<?php endif; ?>
		</div>
</div>

<?php include 'includes/footer.php';?>
</div>
















