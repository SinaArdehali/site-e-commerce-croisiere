<?php


$cheminCourantind = getcwd();
$dirCourantind = substr(strrchr($cheminCourantind, "\\"), 1);



//recuperer le nom du dossier au desssus du dossier courant
$cheminJusqueAuDessusind = substr($cheminCourantind, 0, strrpos( $cheminCourantind, '\\') );
$justeNomDossierDessusind = substr(strrchr($cheminJusqueAuDessusind, "\\"), 1);




$currentDir = dirname(__FILE__);

define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/'.$dirCourantind.'/');
/*echo BASEURL;*/
define('CART_COOKIE','SBv17uCKlwe336ty');
define('CART_COOKIE_EXPIRE',time()+(86400 *30));


	include 'includes/footer.php';
?>