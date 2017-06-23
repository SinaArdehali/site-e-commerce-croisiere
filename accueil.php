<?php /*header("Content-Type: text/html; charset=UTF-8");*/
/*session_start();*/

//verifier que le client est connecté
require_once 'core/init.php';
if($_SESSION['connect'] == 1)
{
	

?>
<!DOCTYPE html>
<html>


<?php 

/*	global $nomApp;*/
/*	$current_dir = getcwd();
	$current_dir = str_replace("\\", "/", $current_dir); 
	$nomApp = $current_dir;
	*/

	/*$var = getcwd();
	$var = explode('\\', $var); // your OS might use '/' instead
	$nomApp = end($var);
*/
	/*$var = getcwd();
	$var = explode('\\', $var);
	$nomApp = end($var);*/


	/*FUNCTION getCurrentDirectory() {
	$path = DIRNAME($_SERVER['DOCUMENT_ROOT']);
	$position = STRRPOS($path,'/') + 1;
	RETURN SUBSTR($path,$position);
	}

	$nomApp = getCurrentDirectory();*/


	//POUR CHANGER LE NOM DU PROGRAMME, ALLEZ DANS LE INIT ET CHANGER LA VARIABLE APPELé $nomApp.



/*$SBUser =$_SESSION['SBUser'];*/

	$user_id =((isset($_POST['user_id']))?sanitize($_POST['user_id']):'');
	$user_id = trim($user_id);
	$user_id= $_SESSION['SBUser'];


	$email =((isset($_POST['email']))?sanitize($_POST['email']):'');
	$email = trim($email);
	$password =((isset($_POST['password']))?sanitize($_POST['password']):'');
	$password = trim($password);
	$errors =array();
	
	
	$query = "SELECT *
	FROM croisiere C, description D, image I
	WHERE C.idCroisiere = D.idCroisiere
	AND I.idDescription = D.idDescription
	AND I.type='logo'
	";
	$result = $db->query($query);

	

	//la requete ci dessous me permet de recuperer les infos de l'utilisateur  //en fonction
	//de son adresse mail. Je pourrai donc recuperer son prenom et
	//son id dans la table personne de la base de donnée.
/*	$query2 =$db->query("select * from personne where adresseEmail ='$email'");
	$user2 = mysqli_fetch_assoc($query2);
	$idUser = $user2['idPersonne'];
	$prenomUser = $user2['prenom'];*/
	$query3 =$db->query("select * from personne where idPersonne ='$user_id'");
	$user3 = mysqli_fetch_assoc($query3);
	$idUser = $user_id;
	$prenomUser = $user3['prenom'];


	$_SESSION['idUser'] = $idUser;
	$_SESSION['prenomUser'] = $prenomUser;

	include 'includes/head.php'; 
	include 'includes/navigation.php';
	include 'includes/headerfull.php';
	include 'includes/leftbar.php';
?>



	<div class="col-md-9">

		<div class="row">
			<h2 class="text-center"><font color="black" size="9" face="Playfair Display">DERNIERES PLACES EN PROMOTION<?=$user_id;?></font></h2>
			
			<h2 class="text-center"><font color="black" size="15" face="Playfair Display">ATTENTION STOCK LIMITE!!!</font></h2>
			
			
			
			
			
			
		<!-- 		<div class="col-md-4 ArrangeMarge"  >
					<h4>Alaska et la Baie des Glaciers</h4>
					<img src="images/donneesSurLesCroisieres/Croisiere Alaska et la Baie des Glaciers/image-costa-croisiere-costa-diadema-300317.jpg"  alt="Croisiere Alaska" class="img-thumb">
					<p>Croisière sur le Norwegian Sun en Alaska pour voir la nature à son apogée, de petits villages charmants et des glaciers imposants</p>
					<p class="list-price text-danger">List Price<s>$2250</s></p>
					<p class="price">Notre prix: $1999</p>
					<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#details-1">Details et Stocks Disponibles</button>
				</div> -->


			<?php while($croisiere = mysqli_fetch_assoc($result)) : ?>

				<div class="col-md-4 ArrangeMargeBcpDeTexte">
					<form action="detailsModal.php" method="POST">
	
				<div class="form-group">
					
				
			
<!-- 	echo <?=$idUser;?>; -->
			
					<h4><font color="black" size="3" face="Playfair Display"><b><?= $croisiere['nomCroisiere'];?></b></font></h4>
					
					
						<img src="<?= $croisiere['lien']; ?>"  alt="Asie du Sud Est" class="img-thumb">
			
					
					<p><font color="#778899" size="3" face="Playfair Display"><?= $croisiere['resume']; ?></font></p>
					<!-- <p class="list-price text-danger">List Price<s>$2250</s></p> -->
					<!-- <p class="price"><font color="black" size="2" face="Playfair Display">Notre Prix : $1999</font></p> -->

					<button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?=$croisiere['idCroisiere'];?>,<?=$idUser;?>)">Details</button>
					<input type="hidden" name="idUser"  id="idUser" value="<?=$idUser;?>">
				</div>
				</form>
				</div>

				<!-- <div class="col-md-4 ArrangeMargeBcpDeTexte">
					<h4>Asie du Sud Est</h4>
					<img src="images/donneesSurLesCroisieres/Croisiere Asie du Sud Est/vyletna-lod,-more,-bazen,-lehatka,-kominy-176843.jpg"  alt="Asie du Sud Est" class="img-thumb">
					<p>Venez découvrir avec nous les merveilles d'Hong Kong, du Vietnam, de la Thaïlande et de Singapour à bord du Celebrity Millennium.<br>Incluant le forfait boisson classique, les vols aller-retour, 1 nuit à Hong Kong, 2 nuits à Hong Kong, dont 1 au Marina Bay Sand.<br>Cabine avec balcon classe concierge</p>
					<p class="list-price text-danger">List Price<s>$2250</s></p>
					<p class="price">our price : $1999</p>
					<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#details-1">Details</button>
				</div>
			 -->
			<?php endwhile; ?>



	</div>

</div>
<!-- ?> -->


<?php
}
 
else // Le mot de passe n'est pas bon.
{
/*	header('Location: index.php');*/
	
		?>
					<script>
					/*alert(' dans le bout de js');*/
					window.location.href = 'index.php';
					/*alert(' apres le window location');*/
					</script>
		<?php


}
?>




<?php
	
	include 'includes/footer.php';
