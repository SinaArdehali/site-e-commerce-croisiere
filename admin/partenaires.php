<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/CPTBrouillon/core/init.php';
if(!is_logged_in()){
		login_error_redirect();
}

include 'includes/head.php';
include 'includes/navigation.php';

$reqListePart ="SELECT *
FROM partenaire
group by nomPartenaire
";
$resListePart = $db->query($reqListePart);



$reqCroiParPart ="SELECT *
FROM partenaire PA, croisiere C
where PA.idCroisiere = C.idCroisiere
group by PA.idPartenaire, PA.nomPartenaire, C.nom
";

$resCroiParPart = $db->query($reqCroiParPart);

$errors = array();

/*
//delete category
if(isset($_GET['delete']) && !empty($_GET['delete'])){
	$delete_id =(int)$_GET['delete'];
	$delete_id = sanitize[$delete_id];
	$sql ="select * from categories where id = '$delete_id'";
	$result =$db->query($sql);
	$category = mysqli_fetch_assoc($result);
	if($category['parent']==0){
		$sql = "delete from categories where parent='delete_id'";
		$db->query($sql);
	}
	$dsql = "DELETE FROM categories where id='delete_id'";
	$db -> query($dsql);
	header('Location : categories.php');
}
*/





//delete category
if(isset($_GET['delete']) && !empty($_GET['delete'])){
	$delete_id =(int)$_GET['delete'];
	$delete_id = sanitize($delete_id);
	/*
	$sql ="select * from categories where id = '$delete_id'";
	$result =$db->query($sql);
	$category = mysqli_fetch_assoc($result);
	if($category['parent']==0){
		$sql = "delete from categories where parent='delete_id'";
		$db->query($sql);
	}
	*/
	/*
	$dsql = "SELECT * FROM categorie where idCategorie='$delete_id'";
	$fgr = $db -> query($dsql);
	$tfgr = mysqli_fetch_assoc($fgr);
	$vtfgr = $tfgr['idCroisiere'];//4
	*/
	$dsql8 = "DELETE FROM categorie where idCategorie='$delete_id'";
	$db -> query($dsql8);
	/*
	$dsql3 = "DELETE * FROM croisiere where idCroisiere='$vtfgr'";
	$db -> query($dsql3);
	*/


	header('Location:partenaires.php');
}




//delete toute la croisiere
if(isset($_GET['deleteTout']) && !empty($_GET['deleteTout'])){
	$deleteTout_id =(int)$_GET['deleteTout'];
	$deleteTout_id = sanitize($deleteTout_id);
	/*
	$sql ="select * from categories where id = '$delete_id'";
	$result =$db->query($sql);
	$category = mysqli_fetch_assoc($result);
	if($category['parent']==0){
		$sql = "delete from categories where parent='delete_id'";
		$db->query($sql);
	}
	*/
	/*
	$dsql = "SELECT * FROM categorie where idCategorie='$delete_id'";
	$fgr = $db -> query($dsql);
	$tfgr = mysqli_fetch_assoc($fgr);
	$vtfgr = $tfgr['idCroisiere'];//4
	*/

	$dsql = "SELECT * FROM partenaire where idPartenaire='$deleteTout_id'";
	$fgr = $db -> query($dsql);
	$tfgr = mysqli_fetch_assoc($fgr);
	$vtfgr = $tfgr['idCroisiere'];//4

	$dsql13 = "SELECT * FROM description where idCroisiere='$vtfgr'";
	$fgr13 = $db -> query($dsql13);
	$tfgr13 = mysqli_fetch_assoc($fgr13);
	$vtfgr13 = $tfgr13['idDescription'];//4

	$dsql8 = "DELETE FROM categorie where idCroisiere='$vtfgr'";
	$db -> query($dsql8);

	$dsql9 = "DELETE FROM partenaire where idPartenaire='$deleteTout_id' and idCroisiere='$vtfgr'";
	$db -> query($dsql9);
	
	$dsql10 = "DELETE FROM description where idCroisiere='$vtfgr'";
	$db -> query($dsql10);

	$dsql12 = "DELETE FROM image where idDescription='$vtfgr13'";
	$db -> query($dsql12);

	$dsql11 = "DELETE FROM croisiere where idCroisiere='$vtfgr'";
	$db -> query($dsql11);

	/*
	$dsql3 = "DELETE * FROM croisiere where idCroisiere='$vtfgr'";
	$db -> query($dsql3);
	*/


	header('Location:partenaires.php');
}













//process form
if(isset($_POST) && !empty($_POST)){
	$partenaire = sanitize($_POST['partenaire']);
	$croisiere = sanitize($_POST['croisiere']);
	$sqlform ="SELECT * FROM partenaire PA, croisiere C where PA.idCroisiere=C.idCroisiere and C.nom= '$croisiere' and PA.idPartenaire='$partenaire'";
	$fresult = $db->query($sqlform);
	$count = mysqli_num_rows($fresult);
	// if croisiere is blank
	if($croisiere == ''){
		$errors[] .= 'La croisiere ne peut pas etre vide. Veuillez entrer une croisiere.';
	}


	//si ca existe dans la base de donnees.

	if($count>0){
		$errors[].= $croisiere.' existe deja. Veuillez en choisir une autre.';
	}

	//affiche les erreurs ou Update la base de donnees.
	if(!empty($errors)){
		//affiche les erreurs
		$display = display_errors($errors);
		?>
		<script>
			jQuery('document').ready(function(){
				jQuery('#errors').html('<?=$display; ?>');
			});
		</script>

<?php	}else{
	//update base de donnees.
	$updatesql = "INSERT into croisiere(nom) values ('$croisiere')";
	$db->query($updatesql);

	
	$sql4 = "select idCroisiere from croisiere where nom='$croisiere'";
	$rsql4 = $db->query($sql4);
	$tsql4 = mysqli_fetch_assoc($rsql4);
	$ssql4 = $tsql4['idCroisiere'];


	$sql5 = "select idPartenaire from partenaire where nomPartenaire='$partenaire'";
	$rsql5 = $db->query($sql5);
	$tsql5 = mysqli_fetch_assoc($rsql5);
	$ssql5 = $tsql5['idPartenaire'];

	$sql6 = "select nomPartenaire from partenaire where idPartenaire='$partenaire'";
	$rsql6 = $db->query($sql6);
	$tsql6 = mysqli_fetch_assoc($rsql6);
	$ssql6= $tsql6['nomPartenaire'];


	$sql3 ="INSERT INTO partenaire(idPartenaire, idCroisiere, nomPartenaire) values ('$partenaire','$ssql4', '$ssql6')";
	$rsql3 = $db->query($sql3);
	}

}


?>



<h2 class=text-center>Partenaires</h2></br>
<div class="row">

	<!-- Form -->
	<div class="col-md-4">
		<form class="form" action="partenaires.php" method="post">
		<!-- il me faudra changer le action -->
		<legend>
			Ajouter une croisiere:
		</legend>
		<div id="errors"></div>
		<div class="form-group">
			<label for="parent">Quel partenaire vous fournit cette croisiere:</label>
			<select class="form-control" name="partenaire" id="partenaire">
				<option value="0">Partenaire</option>
				<?php while ($tabListePart =mysqli_fetch_assoc($resListePart)) : ?>
					<option value="<?=$tabListePart['idPartenaire'];?>"><?=$tabListePart['nomPartenaire'];?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="croisiere">Entrer le nom de la Croisiere:</label>
			<br>
			<input type="text" class="form-control" id="croisiere" name="croisiere">
		</div>
		<div class="form-group">
			<input type="submit" value="Ajouter cette croisiere" class="btn btn-success">
		</div>
		</form>
	</div>

	<div class="col-md-8">
		<table class="table table-bordered">
			<thead>
				<th>Partenaire</th><th>Croisiere</th><th>Categorie</th><th></th>
			</thead>
			<tbody>
				<?php 
				$reqCroiParPart ="SELECT *
				FROM partenaire PA, croisiere C
				where PA.idCroisiere = C.idCroisiere
				group by PA.idPartenaire, PA.nomPartenaire, C.nomCroisiere
				";
				$resCroiParPart = $db->query($reqCroiParPart);


				while($tabCroiParPart=mysqli_fetch_assoc($resCroiParPart)):
						$croisiere_id = (int)$tabCroiParPart['idCroisiere'];
						$reqCatParCroi ="SELECT * FROM CATEGORIE CAT, CROISIERE C WHERE CAT.idCroisiere= C.idCroisiere AND C.idCroisiere= '$croisiere_id'";
						$resCatParCroi = $db->query($reqCatParCroi);
					?>
					<tr class="bg-primary">
	 					<td><?=$tabCroiParPart['nomPartenaire'];?></td>
						<td><?=$tabCroiParPart['nomCroisiere'];?></td>
						<td></td>
						<td>
								<a href="partenaire.php?edit=<?=$child['idCroisiere'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="partenaires.php?deleteTout=<?=$tabCroiParPart['idPartenaire'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span> supprimer TOUTE la croisiere ainsi que ses categories</a>						
		
						</td>
					</tr>
					<?php while ($tabCatParCroi = mysqli_fetch_assoc($resCatParCroi)): ?>
						<tr class="bg-info">
		 					<td><?=$tabCroiParPart['nomPartenaire'];?></td>
							<td><?=$tabCroiParPart['nomCroisiere'];?></td>
							<td>Classe <?=$tabCatParCroi['nomCategorie'];?></td>
							<td>
								<a href="partenaire.php?edit=<?=$child['idCroisiere'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="partenaires.php?delete=<?=$tabCatParCroi['idCategorie'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span> supprimer juste ette categorie de cette croisiere</a>
							</td>
						</tr>
					<?php endwhile; ?>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
</div>


<?php  include 'includes/footer.php';