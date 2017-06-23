<?php
	require_once '../core/init.php';
	if(!is_logged_in()){
		login_error_redirect();
	}

	include 'includes/head.php';
	include 'includes/navigation.php';

	//recuperer les croisieres de la base de données.
	$sql = "SELECT * 
	FROM croisiere 
	order by nomCroisiere";
	$results = $db->query($sql);
	$errors = array();


	//supprimer une croisiere
	if(isset($_GET['delete']) && !empty($_GET['delete'])){
		$delete_id =(int)$_GET['delete'];
		$delete_id = sanitize($delete_id);
		$sql = "delete from croisiere where idCroisiere = '$delete_id'";
		$db->query($sql);
		header('Location: croisiere.php');
	}


	//editer une croisiere
	if(isset($_GET['edit']) && !empty($_GET['edit'])){
		$edit_id = (int)$_GET['edit'];
		$edit_id = sanitize($edit_id);
		$sql2 = "SELECT * FROM croisiere WHERE idCroisiere = '$edit_id'";
		//j'ai rejoute un signe dollar a la ligne ci dessus
		$edit_result = $db->query($sql2);
		$eCroisiere = mysqli_fetch_assoc($edit_result);
	}


	//si le form ajouter est submitted
	if(isset($_POST['add_submit'])){
		$croisiere = sanitize($_POST['croisiere']);
		//check if brand est vide
		if ($_POST['croisiere'] == ''){
			$errors[] .= 'Vous devez entrer une croisiere!';
		}
		//verifier si la croisiere existe dans la base de donnees
		echo "string1";
		$sql = "SELECT  * from croisiere where nom = '$croisiere'";
		if(isset($_GET['edit'])){
			echo "string2";
			$sql ="SELECT * from croisiere where nom = '$croisiere' and idCroisiere != '$edit_id'";
		}
		$result = $db ->query($sql);
		$count = mysqli_num_rows($result);
		if ($count > 0){
			$errors[].= $croisiere.' existe deja. Veuillez en choisir une autre...';
		}

		//afficher l'erreur.
		if(!empty($errors)){
			echo display_errors($errors);
		}else{
			//ajouter une croisiere a la base de donnees.
			$sql = "INSERT INTO croisiere (nom) VALUES ('$croisiere')";
			if (isset($_GET['edit'])) {
				echo "string3";
				$sql = "UPDATE croisiere SET nom='$croisiere' WHERE idCroisiere ='$edit_id'";
			}
			$db->query($sql);
			header('Location: croisiere.php');
		}
	}


?>
<h2 class="text-center">Croisiere</h2><hr>
<!--Brand Form -->
<div class="text-center">
	<form class="form-inline" action="croisiere.php<?=((isset($_get['edit']))?'?edit='.$edit_id:'');?>" method="post">
		<div class="form-group">
			<?php
			$croisiere_value = ''; 
			if(isset($_GET['edit'])){
				$croisiere_value = $eCroisiere['nom'];
			} else{

				if(isset($_POST['croisiere'])){
					$croisiere_value = sanitize($_POST['croisiere']);
				}
			}


			?>
			<label for="croisiere"><?=((isset($_GET['edit']))?'Editer ou Modifier une':'Ajouter une'); ?> Croisiere:</label>
			<input type="text" name="croisiere" id="croisiere" class="form-control" value="<?=$croisiere_value; ?>">
			<?php if(isset($_GET['edit'])): ?>
				<a href="croisiere.php" class="btn btn-default">Cancel</a>
			<?php endif; ?>
			<input type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Editer ou Modifier':'Ajouter'); ?> une croisiere" class="btn btn-success">
		</div>
	</form>
</div><hr>

<table class="table table-bordered table-striped table-auto table-condensed">
	<thead>
		<th></th><th>Croisiere</th><th></th>

	</thead>
	<tbody>
		<?php while($croisiere = mysqli_fetch_assoc($results)): ?>
			<tr>
				<td><a href="croisiere.php?edit=<?=$croisiere['idCroisiere']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
				<td><?= $croisiere['nomCroisiere'];?></td>
				<td><a href="croisiere.php?delete=<?=$croisiere['idCroisiere']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>
<?php include 'includes/footer.php'; ?>