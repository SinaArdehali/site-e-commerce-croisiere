<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/CPTBrouillon/core/init.php';
	$product_id = sanitize($_POST['product_id']);
	$cat = sanitize($_POST['cat']);
	$available = sanitize($_POST['available']);
	$quantity = sanitize($_POST['quantity']);
	$idUser = sanitize($_POST['idUser']);



		
	$query8 = $db ->query("select * from categorie where nomCategorie = '$cat' and idCroisiere='$product_id'");
	$product8 = mysqli_fetch_assoc($query8);
	$idCat = $product8['idCategorie'];

	$_SESSION['success_flash'] = $idCat. ' ajoute a votre panier.';




/*	$item =array();
	$item[] =array(
		'id' 		=> $product_id,
		'place' 		=> $place,
		'quantity' 	=> $quantity,

	);*/
//ici on a un arrau multidimenssionel.


/*
	$product_id contient idCroisiere
	$place contient nomCategorie . cad, par exemple, A.
	$available contient stockRestantParCat
	$quantity contient la quantite entré. cad le nombre voulu de cet article. ex :25*/


	$domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
	$query = $db ->query("select * from croisiere where idCroisiere ='$product_id'");
	$product = mysqli_fetch_assoc($query);
/*	$_SESSION['success_flash'] = $product['nomCroisiere']. ' ajoute a votre panier.';*/

	//verifier si the cart cookie existe.
	

	/*<script>alert("<?php echo htmlspecialchars('Voici un message en JS écrit par PHP', ENT_QUOTES); ?>")</script>*/
	/*echo "<script type='text/javascript'>alert('hello');</script>"; */



	/*if ($cart_id != '') {*/
	if( isset($_COOKIE['COOKIE_PANIER'])){
/*	if (!empty($cart_id) && isset($_COOKIE['CART_COOKIE'])) {
    $cart = unserialize($_COOKIE['cart']);
    echo '<pre>';print_r($cart);echo '</pre>';*/
    	

    	
		$Ridcat = $db ->query("select * from panier where idPanier='$cart_id'");
		$tabidcat = mysqli_fetch_assoc($Ridcat);
		$idcat = $tabidcat['idCategorie'];



		//ce que je veux verifier cest que le idCat de ce que l'utilisateur vient de rentrer est le emem qu'un idcat qui existe deja.
		//si cest le meme, alors on va simplement mettre a jour ( a travers un update) la colonne quantite
		//si ce n'est pas le cas, alros on va creer un nouvel enregistremnt avec donc un nouvel idLignePanier.

		$_SESSION['success_flash'] = "'".$cart_id."' on est dans le if. idCategorie = ".$idCat;

		/*$cart_id = $_COOKIE['CART_COOKIE'];*/
		$cartQ6 = $db-> query("select * from panier where idPanier = '$cart_id'");
		$cart6 = mysqli_fetch_assoc($cartQ6);

/*		$_SESSION['success_flash'] = $cart_id.' on est dans le if.';*/
		/*$_SESSION['success_flash'] = $cart6['nbPlaces'].' on est dans le if.';
		$_SESSION['success_flash'] = $cart6['nbPlaces'].' on est dans le if.';*/

		/* ALGO A CODER
		Récupération du nombre de places dans le panier pour la catégorie
		
		$Nb_places_deja_prises = select nbPlaces from panier where idPanier = '$cart_id' and idCategorie = '$idcat'


		$aMettreDansBDD = $NB_places_deja_prises + $quantity;
		*/


		$Rnb_places_deja_prises_pour_ce_idcat = $db ->query("select * from panier where idPanier = '$cart_id' and idCategorie = '$idcat'");
		$tab_nb_places_deja_prises_pour_ce_idcat = mysqli_fetch_assoc($Rnb_places_deja_prises_pour_ce_idcat);
		$nb_places_deja_prises_pour_ce_idcat = $tab_nb_places_deja_prises_pour_ce_idcat['nbPlaces'];


		$aMettreDansBDD = $nb_places_deja_prises_pour_ce_idcat + $quantity;
		

		$cart_expire = date("Y-m-d H:i:s", strtotime("+30 days"));
		$db ->query("UPDATE panier set nbPlaces = '$aMettreDansBDD', expire_date = '$cart_expire' where idPanier ='$cart_id' and idCategorie='$idcat'");
		
		/* ALGO A CODER
		$db ->query("UPDATE panier set nbPlaces = '$aMettreDansBDD', expire_date = '$cart_expire' where idPanier ='$cart_id' and idCategorie = idcat ");
		*/

		setcookie("COOKIE_PANIER",$cart_id,time()+36000);

		$_SESSION['success_flash'] = CART_COOKIE.' on est dans le if. idCategorie = '.$idcat.'   idPanier ='.$cart_id.'    expire vaut:'.$cart_expire; 



	}
	else{


		/*
		mettre $quantity dans nbplaces de lignepanier
		insert into lignepanier (nbPlaces) where lignepanier.idPlace=place.idPlace*/


		$cart_expire = date("Y-m-d H:i:s", strtotime("+30 days"));

		/*select * from */


		$db -> query("insert into panier (expire_date,nbPlaces,idCategorie) values ('$cart_expire','$quantity','$idCat') ");

		/*global $cart_id;*/
		$cart_id = $db->insert_id;

		/*setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);*/
	

		setcookie("COOKIE_PANIER",$cart_id,time()+36000);
		/*$_SESSION['success_flash'] = $cart_id.' on est dans le else. idCategorie = '.$idCat;*/
		/*$_SESSION['success_flash'] = CART_COOKIE.' on est dans le else. idCategorie = '.$cart_id;*/


		$_SESSION['success_flash'] = CART_COOKIE.' on est dans le if. idCategorie = '.$idcat.'   idPanier ='.$cart_id.'    expire vaut:'.$cart_expire; 

	
	}

	?>