<?php header("Content-Type: text/html; charset=UTF-8");


header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-type: text/html; charset=utf-8'); 

?>

<?php

/*$nomApp = 'CroisierePourTous';*/
$db= mysqli_connect('127.0.0.1', 'root', '', 'croisierepourtousnouvelle');

if(mysqli_connect_errno()){
	echo 'Database connection failed with following errors:'. mysqli_connect_errno();
	die();
}



global $nomApp;
	$current_dir = getcwd();
	$current_dir = str_replace("\\", "/", $current_dir); 
	$nomApp = $current_dir;
	

	$var = getcwd();
	$var = explode('\\', $var); // your OS might use '/' instead
	$nomApp = end($var);

	$var = getcwd();
	$var = explode('\\', $var);
	$nomApp = end($var);


	FUNCTION getCurrentDirectory2() {
	$path = DIRNAME($_SERVER['DOCUMENT_ROOT']);
	$position = STRRPOS($path,'/') + 1;
	RETURN SUBSTR($path,$position);
	}



	$nomApp = getCurrentDirectory2();





$cheminCourantind = getcwd();
$dirCourantind = substr(strrchr($cheminCourantind, "\\"), 1);



//recuperer le nom du dossier au desssus du dossier courant
$cheminJusqueAuDessusind = substr($cheminCourantind, 0, strrpos( $cheminCourantind, '\\') );
$justeNomDossierDessusind = substr(strrchr($cheminJusqueAuDessusind, "\\"), 1);




/*$nomApp = $_POST['nomApp'];*/
session_start();



require_once $_SERVER['DOCUMENT_ROOT'].'/'.$justeNomDossierDessusind.'/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/'.$justeNomDossierDessusind.'/helpers/helpers.php';
/*$_SERVER['DOCUMENT_ROOT'].'/'.$dirCourantind.'/'*/



$cart_id ='';
if (isset($_COOKIE[CART_COOKIE])) {
	$cart_id = sanitize($_COOKIE[CART_COOKIE]);
}

if(isset($_SESSION['SBUser'])){
	$user_id = $_SESSION['SBUser'];
	$query = $db->query("select * from personne where idPersonne = '$user_id'");
	$user_data = mysqli_fetch_assoc($query);

}

if(isset($_SESSION['success_flash'])){
	echo '<div class="bg-success"><p class="text-success">'.$_SESSION['success_flash'].'</p></div';
	unset($_SESSION['success_flash']);
}

if(isset($_SESSION['error_flash'])){
	echo '<div class="bg-danger"><p class="text-danger">'.$_SESSION['error_flash'].'</p></div';
	unset($_SESSION['error_flash']);
}




	
	include 'includes/footer.php';
?>


<?php
$idCroisiere = $_POST['idCroisiere'];


$idUser = $_POST['idUser'];


$sql = "select * from croisiere where idCroisiere = '$idCroisiere'";
$result = $db->query($sql);
$croisiere = mysqli_fetch_assoc($result);

$queryImageModal = "SELECT *
	FROM croisiere C, description D, image I
	WHERE C.idCroisiere = D.idCroisiere
	AND I.idDescription = D.idDescription
	AND I.type='imgComplet'
	AND C.idCroisiere='$idCroisiere'
	ORDER BY I.idImage
	";
$resultImageComplet = $db->query($queryImageModal);




$queryImageModal2 = "SELECT *
	FROM croisiere C, description D, image I
	WHERE C.idCroisiere = D.idCroisiere
	AND I.idDescription = D.idDescription
	AND I.type='imgComplet'
	AND C.idCroisiere='$idCroisiere'
	ORDER BY I.idImage
	";
$resultImageComplet2 = $db->query($queryImageModal2);
$imageCompletModal2 = mysqli_fetch_assoc($resultImageComplet2);





$queryImageModal3 = "SELECT *
	FROM croisiere C, categorie CAT, place P
	WHERE C.idCroisiere = CAT.idCroisiere
	AND P.idCategorie = CAT.idCategorie
	AND CAT.idCroisiere='$idCroisiere'
	GROUP BY CAT.nomCategorie
	";
$resultImageComplet3 = $db->query($queryImageModal3);


/*$queryImageModal4 = "SELECT *
	FROM categorie CAT, croisiere C,  place P
	WHERE CAT.idCroisiere='$idCroisiere'
	AND C.idCroisiere = CAT.idCroisiere
	AND P.idCategorie = CAT.idCategorie
	GROUP BY CAT.nomCategorie
	ORDER BY CAT.nomCategorie asc
	";
$resultImageComplet4 = $db->query($queryImageModal4);*/

$queryImageModal4 = "SELECT *
	FROM categorie CAT, croisiere C
	WHERE CAT.idCroisiere='$idCroisiere'
	AND C.idCroisiere = CAT.idCroisiere
	GROUP BY CAT.nomCategorie
	ORDER BY CAT.nomCategorie asc
	";
$resultImageComplet4 = $db->query($queryImageModal4);



/* 	$query9= $db ->query("select * from categorie where idCategorie='$idCat'");
	$tquery9 = mysqli_fetch_assoc($query9);
	$available = $tquer9['stockRestantParCat']; */

?>

<!-- details Modal -->

<!-- require_once '../core/init.php'; -->
<?php ob_start(); ?>
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
				<span aria-hidden="true">&times;</span>
			</button>
			<h4 class="modal-title text-center"><?= $croisiere['nomCroisiere']; ?></h4>
			
			</div>
			<div class="modal-body" >
				<div class="container-fluid">
					<div class="row" >
						<span id="modal_errors" class="bg-danger"></span>
						<div class="col-sm-8">
							<div class="center-block">




							<div id="carousel-example-generic" class="carousel slide cycle-slideshow" data-ride="carousel">

  


							  <!-- Wrapper for slides -->
							  <div class="carousel-inner">


							  		<?php $imageCompletModal = mysqli_fetch_assoc($resultImageComplet); ?>

							  		<div class="item active">
										<img src="<?= $imageCompletModal['lien'] ; ?>" alt="<?= $croisiere['nomCroisiere']; ?>" class="img-responsive imgTouteLaLargeur">
										<div class="carousel-caption">
									       <!--  One Image -->
									     </div>
									</div>


							  		<?php while($imageCompletModal = mysqli_fetch_assoc($resultImageComplet)) : ?>
									
									
									<div class="item">
										<img src="<?= $imageCompletModal['lien'] ; ?>" alt="<?= $croisiere['nomCroisiere']; ?>" class="img-responsive imgTouteLaLargeur">
										<div class="carousel-caption">
									       <!--  One Image -->
									     </div>
									</div>	
									<?php endwhile; ?>



							  </div>


 
							  <!-- Controls -->
							  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							    <span class="glyphicon glyphicon-chevron-left"></span>
							  </a>
							  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
							    <span class="glyphicon glyphicon-chevron-right"></span>
							  </a>
							</div>








								
							</div>
						</div>
						<div class="col-sm-4">
							<h4>Details</h4>
							
							<p><?= $imageCompletModal2['resume']; ?></p>
							
							<hr>
							<p class="priceDansModal">PRIX: </p>

							<?php while($imageCompletModal3 = mysqli_fetch_assoc($resultImageComplet3)) : ?>
								<p class="price">Prix d'une seule place en Classe <?= $imageCompletModal3['nomCategorie'] ; ?> : <?= $imageCompletModal3['prixUnitaire'] ; ?>Euros</p>
							<?php endwhile; ?>

							<form action="add_cart_snq.php" method="POST">
							
								<input type="hidden" name="product_id" id="product_id" value="<?=$idCroisiere;?>">
								<!-- product_id contient l'id de la croisiere -->
								
								<!-- available ne contient rien -->
								<input type="hidden" name="idUser" id="idUser" value="<?=$idUser;?>">
								<div class="form-group">
									<div class="col-xs-5">
										<label for="quantity">Nombre:</label>
										<input type="text" class="form-control" id="quantity" name="quantity">
										<!-- quantity contient le nombre que l'utilisateur aura rentré dans la fenetre modale -->
									</div>
									<br>
									<div class="col-xs-7"></div>
									<!-- <p>Available: 3</p> -->
								</div><br><br>
								<div class="form-group col-xs-5">
									<label for="cat">Classe:</label>
									<select name="cat" id="cat" class="form-control div-inline" style="width: 200px;">
									<!-- place correspond a la colonne nomCategorie de categorie de la croisiere . ex: A -->
										<option value=""></option>
									


										<?php while($imageCompletModal4 = mysqli_fetch_assoc($resultImageComplet4)) :?>
										<?php
										$cat = $imageCompletModal4['nomCategorie'] ;?>
										<?php
										$available = $imageCompletModal4['stockRestantParCat'] ;
										?>
								
										
										<option value="<?=$cat;?>" data-available="<?=$available;?>"><?=$cat;?> (<?=$available;?> places disponibles)</option>;
										<?php endwhile; ?>

									</select>
									<input type="hidden" name="available" id="available" value="<?=$available;?>">
								</div>
						
								 
							
								<div class="col-xs-7"></div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal" onclick="closeModal()">Fermer</button>
				<button class="btn btn-warning" onclick="add_to_cart(<?=$idCroisiere;?>,<?=$available;?>,<?=$idUser;?>)"><span class="glyphicon glyphicon-shopping-cart"></span>Ajouter au panier</button>
					
			</div>
	</div>

</div>
<script>
	jQuery('#place').change(function(){
		var available = jQuery('#place option:selected').data("available");
		jQuery('#available').val(available);
	});



	function closeModal(){
		jQuery('#details-modal').modal('hide');
		setTimeout(function(){
			jQuery('#details-modal').remove();
			jQuery('.modal-backdrop').remove();
		},500);
	}
</script>


<?php echo ob_get_clean(); ?>
