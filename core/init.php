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



require_once $_SERVER['DOCUMENT_ROOT'].'/'.$dirCourantind.'/config.php';
require_once BASEURL.'helpers/helpers.php';



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