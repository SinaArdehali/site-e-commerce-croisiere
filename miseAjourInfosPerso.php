<?php
session_start();
	/*require_once $_SERVER['DOCUMENT_ROOT'].'/BrouillonCroisierePourTous/core/init.php';*/
	echo "<script> alert('nom: je suis la')</script>";


$idUser = $_SESSION['SBUser'];



//ci dessous, on retrovue le contenu de mon init

$db= mysqli_connect('127.0.0.1', 'root', '', 'croisierepourtousnouvelle');

if(mysqli_connect_errno()){
	echo 'Database connection failed with following errors:'. mysqli_connect_errno();
	die();
}

/*session_start();*/
/*require_once $_SERVER['DOCUMENT_ROOT'].'/BrouillonCroisierePourTous16/config.php';*/


define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/BrouillonCroisierePourTous16/');
/*echo BASEURL;*/
define('CART_COOKIE','SBv17uCKlwe336ty');
define('CART_COOKIE_EXPIRE',time()+(86400 *30));






require_once BASEURL.'helpers/helpers.php';















	echo "<script> alert('nom: je suis la')</script>";

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
/*	$confirmPasswordParticulier = sanitize($_POST['confirmPasswordParticulier']);*/
/*	$repasParticulier = sanitize($_POST['repasParticulier']);*/
	$raisonSociale = sanitize($_POST['raisonSociale']);
	$siret = sanitize($_POST['siret']);
	$nomRepresentant = sanitize($_POST['nomRepresentant']);
	$prenomRepresentant = sanitize($_POST['prenomRepresentant']);
	$emailRepresentant = sanitize($_POST['emailRepresentant']);
	$phoneRepresentant = sanitize($_POST['phoneRepresentant']);
	$passwordRepresentant = sanitize($_POST['passwordRepresentant']);
/*	$confirmPasswordRepresentant = sanitize($_POST['confirmPasswordRepresentant']);*/
	$select = sanitize($_POST['select']);


echo "<script> alert('id a mettre dans clientPro dans miseajour:".$idduClientPro.$raisonSociale.$siret.$nomRepresentant.$prenomRepresentant.$emailRepresentant.$phoneRepresentant.$passwordRepresentant.$siret.$idUser."') </script>";


$db -> query("UPDATE personne P, clientpart CPart, clientpro CPro
SET P.nom = '$nomRepresentant', P.prenom = '$prenomRepresentant', P.adresseEmail = '$emailRepresentant', P.phoneNumber = '$phoneRepresentant', CPro.siret ='$siret'
WHERE P.idPersonne='$idUser'
	AND (P.idPersonne = CPart.idPersonne
	OR P.idPersonne = CPro.representPersonne)");

/*$db -> query("UPDATE personne P, clientpart CPart, clientpro CPro
SET P.nom = '$nomParticulier', P.prenom = '$prenomParticulier', P.adresseEmail = '$emailParticulier', P.dateNaissance = '$dateNaissanceParticulier', P.adresse1 = '$adresse1Particulier', P.adresse2 = '$adresse2Particulier', P.adresse3 = '$adresse3Particulier', adresse4 = '$adresse4Particulier', CPro.siret ='$siret'
WHERE P.idPersonne='$idUser'
	AND (P.idPersonne = CPart.idPersonne
	OR P.idPersonne = CPro.representPersonne)");*/


/*
$db -> query("insert into personne (adminOuPas,nom,prenom,adresseEmail,phoneNumber,password) values ('editor','$nomRepresentant','$prenomRepresentant','$emailRepresentant','$phoneRepresentant','$passwordRepresentant')");


$queryidPro = "SELECT *
	FROM personne
	WHERE nom='$nomRepresentant'
	AND prenom='$prenomRepresentant'
	AND adresseEmail='$emailRepresentant'
	";
	$resultidPro = $db->query($queryidPro);
	$tabidPro = mysqli_fetch_assoc($resultidPro);
	$idduClientPro = $tabidPro['idPersonne'];

		echo "<script>alert('id a mettre dans clientPro:".$idduClientPro."')</script>";

$db -> query("insert into clientpro (raisonSociale,siret,representPersonne) values ('$raisonSociale','$siret','$idduClientPro')");*/
/*	$db -> query("insert into clientpart (idPersonne) values ('$idduClientPart')");*/



	/*$db -> query("insert into personne (adminOuPas,nom,prenom,adresseEmail) values ('editor','$nomParticulier','$prenomParticulier','$emailParticulier')");*/

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
/*echo "<script> alert('Vous êtes bien enregistré! vous allez etre redirigé vers la page d'accueil!') </script>";*/

?>
<!-- <h4>Vous êtes bien enregistrer! Pour revenir vers la page de Connexion, <a href="index.php">cliquez ici</a></h4> -->
<?php include 'includes/footer.php';?>