<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/BrouillonCroisierePourTous/core/init.php';

	try {
	$db -> query("insert into personne (idpersonne)values (100000)");
	} catch (Exception $e){
		echo 'Exception reçue : ',  $e->getMessage(), "\n";
	}
	$cat = sanitize($_POST['cat']);
	$product_id = sanitize($_POST['product_id']);
	$quantity = sanitize($_POST['quantity']);
	$available = sanitize($_POST['available']);
	$idUser = sanitize($_POST['idUser']);

	

	echo "<script> alert('".$cat.$product_id.$quantity.$available.$idUser.$test." je suis la') </script>";



	try {

	$query8 = $db ->query("select * from categorie where nomCategorie = '$cat' and idCroisiere='$product_id'");
	$product8 = mysqli_fetch_assoc($query8);
	$idCat = $product8['idCategorie'];



	} catch (Exception $e) {
		echo 'Exception reçue : ',  $e->getMessage(), "\n";
	}
	

	
	
	
	$query6 = $db ->query("select * from croisiere where idCroisiere ='$product_id'");
	$product = mysqli_fetch_assoc($query6);
/* 	$_SESSION['success_flash'] = $product['nomCroisiere']. ' ajoute a votre panier.';
	
	$_SESSION['success_flash'] = $idCat. ' ajoute a votre panier.'; */


	
	
	




$db -> query("insert into panier (nbPlaces,idCategorie, idPersonne) values ('$quantity','$idCat','$idUser')");


?>



<?php include 'includes/footer.php';?>