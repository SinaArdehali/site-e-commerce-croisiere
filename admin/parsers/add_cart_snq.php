<?php
	echo "<script> alert('je suis dans add_cart_snq') </script>";
/*	require_once $_SERVER['DOCUMENT_ROOT'].'/BrouillonCroisierePourTous16/core/init.php';*/


/*$nomApp = 'CroisierePourTous';*/
$db= mysqli_connect('127.0.0.1', 'root', '', 'croisierepourtousnouvelle');

if(mysqli_connect_errno()){
	echo 'Database connection failed with following errors:'. mysqli_connect_errno();
	die();
}





	try {
	$db -> query("insert into personne (idPersonne)values (100000)");
	} catch (Exception $e){
		echo 'Exception reçue : ',  $e->getMessage(), "\n";
	}
	$cat = $_POST['cat'];
	$product_id = $_POST['product_id'];
	$quantity = $_POST['quantity'];
	$available = $_POST['available'];
	$idUser = $_POST['idUser'];


/*	echo "<script> alert('".$cat.$product_id.$quantity.$available.$idUser.$test." je suis la') </script>";*/
	echo "<script> alert('".$product_id.$available.$idUser." je suis lazz') </script>";
//



	try {

	$query8 = $db ->query("select * from categorie where nomCategorie = '$cat' and idCroisiere='$product_id'");
	$product8 = mysqli_fetch_assoc($query8);
	$idCat = $product8['idCategorie'];
echo "<script> alert('".$idCat." foooo') </script>";



	} catch (Exception $e) {
		echo 'Exception reçue : ',  $e->getMessage(), "\n";
	}
	

	
	
	
	$query6 = $db ->query("select * from croisiere where idCroisiere ='$product_id'");
	$product = mysqli_fetch_assoc($query6);
/* 	$_SESSION['success_flash'] = $product['nomCroisiere']. ' ajoute a votre panier.';
	
	$_SESSION['success_flash'] = $idCat. ' ajoute a votre panier.'; */


	

$query4 = $db ->query("select * from panier where idPersonne='$idUser'");
$product4 = mysqli_fetch_assoc($query4);
$existeDifferentCat = $product4['idPanier'];
$_SESSION['existeDifferentCat'] = $existeDifferentCat;
	
	
$query3 = $db ->query("select * from panier where idPersonne='$idUser' and idCategorie='$idCat'");
$product3 = mysqli_fetch_assoc($query3);
$existeDejaMemeCat = $product3['idPanier'];
$nb_places_deja_prises_pour_ce_idcat = $product3['nbPlaces'];

$_SESSION['existeDejaMemeCat'] = $existeDejaMemeCat;

/*if(isset($existeDeja)){*/
if (isset($_SESSION['existeDejaMemeCat'])){
echo "<script> alert('".$cat.$product_id.$quantity.$available.$idUser.$test." je suis la') </script>";

/*	$Rnb_places_deja_prises_pour_ce_idcat = $db ->query("select * from panier where idPersonne = '$cart_id' and idCategorie = '$idcat'");
	$tab_nb_places_deja_prises_pour_ce_idcat = mysqli_fetch_assoc($Rnb_places_deja_prises_pour_ce_idcat);
	$nb_places_deja_prises_pour_ce_idcat = $tab_nb_places_deja_prises_pour_ce_idcat['nbPlaces'];*/


	$aMettreDansBDD = $nb_places_deja_prises_pour_ce_idcat + $quantity;
	$db ->query("update panier set nbPlaces = '$aMettreDansBDD' where idPanier ='$existeDejaMemeCat' and idCategorie='$idCat'");
}
/*si le idcat existe deja pour cet idUser, alrso on fait un update
sinon on fait un insert*/
else{
	if (isset($_SESSION['$existeDifferentCat'])) {
			$db -> query("insert into panier (idPanier,nbPlaces,idCategorie, idPersonne) values ('$existeDifferentCat','$quantity','$idCat','$idUser')");
		}
	else{
		$db -> query("insert into panier (nbPlaces,idCategorie, idPersonne) values ('$quantity','$idCat','$idUser')");		
	}
}


?>