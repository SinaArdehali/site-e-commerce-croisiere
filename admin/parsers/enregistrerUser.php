<?php
/*
	require_once $_SERVER['DOCUMENT_ROOT'].'/BrouillonCroisierePourTous/core/init.php';*/






//ci dessous, on retrovue le contenu de mon init

$db= mysqli_connect('127.0.0.1', 'root', '', 'croisierepourtousnouvelle');

if(mysqli_connect_errno()){
	echo 'Database connection failed with following errors:'. mysqli_connect_errno();
	die();
}

session_start();
/*require_once $_SERVER['DOCUMENT_ROOT'].'/BrouillonCroisierePourTous16/config.php';*/


define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/BrouillonCroisierePourTous16/');
/*echo BASEURL;*/
define('CART_COOKIE','SBv17uCKlwe336ty');
define('CART_COOKIE_EXPIRE',time()+(86400 *30));






require_once BASEURL.'helpers/helpers.php';




	try {
	$db -> query("insert into personne (idPersonne)values (100000)");
	} catch (Exception $e){
		echo 'Exception reçue : ',  $e->getMessage(), "\n";
	}
	$nomParticulier = sanitize($_POST['nomParticulier']);
	$prenomParticulier = sanitize($_POST['prenomParticulier']);
	$emailParticulier = sanitize($_POST['emailParticulier']);
	$dateNaissanceParticulier = sanitize($_POST['dateNaissanceParticulier']);
	$adresse1Particulier = sanitize($_POST['adresse1Particulier']);
	$adresse2Particulier = sanitize($_POST['adresse2Particulier']);
	$adresse3Particulier = sanitize($_POST['adresse3Particulier']);
	$adresse4Particulier = sanitize($_POST['adresse4Particulier']);
	$codePostalParticulier = sanitize($_POST['codePostalParticulier']);
	$villeParticulier = sanitize($_POST['villeParticulier']);
	$paysParticulier = sanitize($_POST['paysParticulier']);
	$phoneParticulier = sanitize($_POST['phoneParticulier']);
	$passeportParticulier = sanitize($_POST['passeportParticulier']);
	$passwordParticulier = sanitize($_POST['passwordParticulier']);
	$confirmPasswordParticulier = sanitize($_POST['confirmPasswordParticulier']);
/*	$repasParticulier = sanitize($_POST['repasParticulier']);*/



	echo "<script> alert('nom:".$nomParticulier.$prenomParticulier.$emailParticulier.$dateNaissanceParticulier.$adresse1Particulier.$adresse2Particulier.$adresse3Particulier.$adresse4Particulier.$codePostalParticulier.$villeParticulier.$paysParticulier.$phoneParticulier.$passeportParticulier.$passwordParticulier.$repasParticulier." je suis la') </script>";



	$db -> query("insert into personne (adminOuPas,nom,prenom,adresseEmail,dateNaissance,adresse1,adresse2,adresse3,adresse4,codePostal,ville,pays,phoneNumber,numeroPasseport,password) values ('editor','$nomParticulier','$prenomParticulier','$emailParticulier','$dateNaissanceParticulier','$adresse1Particulier','$adresse2Particulier','$adresse3Particulier','$adresse4Particulier','$codePostalParticulier','$villeParticulier','$paysParticulier','$phoneParticulier','$passeportParticulier','$passwordParticulier')");

$queryidPersonne = "SELECT *
	FROM personne
	WHERE nom='$nomParticulier'
	AND prenom='$prenomParticulier'
	AND adresseEmail='$emailParticulier'
	";
	$resultidPersonne = $db->query($queryidPersonne);
	$tabidPersonne = mysqli_fetch_assoc($resultidPersonne);
	$idduClientPart = $tabidPersonne['idPersonne'];

		echo "<script> alert('id a mettre dans clientPart:".$idduClientPart."') </script>";

	$db -> query("insert into clientpart (idPersonne) values ('$idduClientPart')");


/*
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
	
	$_SESSION['success_flash'] = $idCat. ' ajoute a votre panier.'; 


	
	
	




$db -> query("insert into panier (nbPlaces,idCategorie, idPersonne) values ('$quantity','$idCat','$idUser')");*/


?>

<?php include 'includes/footer.php';?>