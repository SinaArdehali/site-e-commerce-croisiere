</div>
<?php

$cheminCourantind = getcwd();
$dirCourantind = substr(strrchr($cheminCourantind, "\\"), 1);



//recuperer le nom du dossier au desssus du dossier courant
$cheminJusqueAuDessusind = substr($cheminCourantind, 0, strrpos( $cheminCourantind, '\\') );
$justeNomDossierDessusind = substr(strrchr($cheminJusqueAuDessusind, "\\"), 1);


$machaine2 = '/'.$dirCourantind.'/includes/detailsModal.php';
/*echo $machaine2;*/

$machaine5 = '/'.$dirCourantind.'/admin/parsers/add_cart_snq.php';
/*echo $machaine5;*/


$machaine7 = '/'.$dirCourantind.'/resultRechercheSelectButton.php';

$machaine8 = '/'.$dirCourantind.'/resultRechercheTermesButton.php';
/*echo $machaine7;*/
?>
<!-- <footer class="text-center" id="footer">&copy; Copyright 2013-2017 Croisiere Pour Tous Sogeti</footer> -->
<script>
	jQuery(window).scroll(function(){
		var vscroll = jQuery(this).scrollTop();
		jQuery('#logotext').css({
			"transform" : "translate(0px, "+vscroll/2+"px)"
		});

		var vscroll = jQuery(this).scrollTop();
		jQuery('#back-flower').css({
			"transform" : "translate("+vscroll/5+"px, -"+vscroll/12+"px)"
		});

		var vscroll = jQuery(this).scrollTop();
		jQuery('#fore-flower').css({
			"transform" : "translate(0px, -"+vscroll/2+"px)"
		});
	});



function enregistrerProfessionnel(){
		// var cat =jQuery('#cat').val();
		// var quantity =jQuery('#quantity').val();
		// var data = {test: "test", cat : "cat", product_id: "product_id", quantity: "quantity", available: "available", idUser: "idUser"};
		alert("on est pas encore rentrer sans le if!");
		var raisonSociale = document.getElementById("raisonSociale").value;
		var siret = document.getElementById("siret").value;
		var nomRepresentant = document.getElementById("nom-representant").value;
		var prenomRepresentant = document.getElementById("prenom-representant").value;
		var emailRepresentant = document.getElementById("email-representant").value;
		var dateNaissanceRepresentant = document.getElementById("dateNaissance-representant").value;
		var phoneRepresentant = document.getElementById("phone-representant").value;
		var passwordRepresentant = document.getElementById("password-representant").value;
		var confirmPasswordRepresentant = document.getElementById("confirm-password-representant").value;
		var select = document.getElementById("select").value;
		var data = {"raisonSociale" :  raisonSociale, "siret": siret, "nomRepresentant": nomRepresentant, "prenomRepresentant": prenomRepresentant, "emailRepresentant": emailRepresentant, "dateNaissanceRepresentant": dateNaissanceRepresentant, "phoneRepresentant": phoneRepresentant, "passwordRepresentant": passwordRepresentant, "confirmPasswordRepresentant": confirmPasswordRepresentant, "select": select};
		var error = '';
		alert("on est apres les variables"+raisonSociale+siret+nomRepresentant+prenomRepresentant+emailRepresentant+dateNaissanceRepresentant+phoneRepresentant+passwordRepresentant+confirmPasswordRepresentant+select);
/*		if(cat == '' || quantity == '' || quantity == 0){
			error += '<p class="text-danger text-center">you must choose a place and quantity.</p>';
			jQuery('#modal_errors').html(error); 
			alert("something went wrong");
			return;
		}
		
		else if(quantity > available){
			error += '<p class="text-danger text-center">there are only '+available+' available.</p>';
			jQuery('#modal_errors').html(error);
			return;
		}
		else{*/
		
		jQuery.ajax({

			url: '/BrouillonCroisierePourTous16/admin/parsers/enregistrerProf.php',
			method: "POST",
			data : data,
			success: function(data){
				alert("on est dans le else!");
				location.reload();
				jQuery('body').append(data);
				jQuery('#details-modal').modal('toggle');
			},
			error: function(){alert("something went wrong");}
		});
	}



function enregistrerParticulier(){
		// var cat =jQuery('#cat').val();
		// var quantity =jQuery('#quantity').val();
		// var data = {test: "test", cat : "cat", product_id: "product_id", quantity: "quantity", available: "available", idUser: "idUser"};
		var nomParticulier = document.getElementById("nom-particulier").value;
		var prenomParticulier = document.getElementById("prenom-particulier").value;
		var emailParticulier = document.getElementById("email-particulier").value;
		var dateNaissanceParticulier = document.getElementById("dateNaissance-particulier").value;
		var adresse1Particulier = document.getElementById("adresse1-particulier").value;
		var adresse2Particulier = document.getElementById("adresse2-particulier").value;
		var adresse3Particulier = document.getElementById("adresse3-particulier").value;
		var adresse4Particulier = document.getElementById("adresse4-particulier").value;
		var codePostalParticulier = document.getElementById("codePostal-particulier").value;
		var villeParticulier = document.getElementById("ville-particulier").value;
		var paysParticulier = document.getElementById("pays-particulier").value;
		var phoneParticulier = document.getElementById("phone-particulier").value;
		var passeportParticulier = document.getElementById("passeport-particulier").value;
		var passwordParticulier = document.getElementById("password-particulier").value;
		var confirmPasswordParticulier = document.getElementById("confirm-password-particulier").value;
		var repasParticulier = document.getElementById("repas-particulier").value;
		var data = {"nomParticulier" : nomParticulier, "prenomParticulier": prenomParticulier, "emailParticulier": emailParticulier, "dateNaissanceParticulier": dateNaissanceParticulier, "adresse1Particulier": adresse1Particulier, "adresse2Particulier": adresse2Particulier, "adresse3Particulier": adresse3Particulier, "adresse4Particulier": adresse4Particulier, "codePostalParticulier": codePostalParticulier, "villeParticulier": villeParticulier, "paysParticulier": paysParticulier, "phoneParticulier": phoneParticulier, "passeportParticulier": passeportParticulier, "passwordParticulier": passwordParticulier, "confirmPasswordParticulier": confirmPasswordParticulier, "repasParticulier": repasParticulier};
		var error = '';
		alert("on est pas encore rentrer sans le if!");
		
/*		if(cat == '' || quantity == '' || quantity == 0){
			error += '<p class="text-danger text-center">you must choose a place and quantity.</p>';
			jQuery('#modal_errors').html(error); 
			alert("something went wrong");
			return;
		}
		
		else if(quantity > available){
			error += '<p class="text-danger text-center">there are only '+available+' available.</p>';
			jQuery('#modal_errors').html(error);
			return;
		}
		else{*/
		
		jQuery.ajax({

			url: '/BrouillonCroisierePourTous16/admin/parsers/enregistrerUser.php',
			method: "POST",
			data : data,
			success: function(data){
				alert("on est dans le else!");
				location.reload();
				jQuery('body').append(data);
				jQuery('#details-modal').modal('toggle');
			},
			error: function(){alert("something went wrong");}
		});
	}





function add_to_cart(product_id,available,idUser){
		// var cat =jQuery('#cat').val();
		// var quantity =jQuery('#quantity').val();
		// var data = {test: "test", cat : "cat", product_id: "product_id", quantity: "quantity", available: "available", idUser: "idUser"};
		alert("on est au debut de la fonction js!");
		var cat = document.getElementById("cat").value;
		var quantity = document.getElementById("quantity").value;
		var data = {"cat" : cat, "product_id": product_id, "quantity": quantity, "available": available, "idUser": idUser};
		var error = '';
		alert("on est pas encore rentrer sans le if!");
		alert(product_id+' '+available+' '+idUser+' '+cat+' '+quantity+' ' +'je suis dans add_to cart');
		
		if(cat == '' || quantity == '' || quantity == 0){
			error += '<p class="text-danger text-center">you must choose a place and quantity.</p>';
			jQuery('#modal_errors').html(error); 
			alert("something went wrong");
			return;
		}
		
		else if(quantity > available){
			error += '<p class="text-danger text-center">there are only '+available+' available.</p>';
			jQuery('#modal_errors').html(error);
			return;
		}
		else{
			jQuery.ajax({

				url: '/BrouillonCroisierePourTous16/admin/parsers/add_cart_snq.php',
				method: "POST",
				data : data,
				success: function(data){
					alert("on est dans le else!");
					location.reload();
					jQuery('body').append(data);
					jQuery('#details-modal').modal('toggle');
				},
				error: function(){alert("something went wrong");}
			});
		}
	}
 








function add_to_cart2(place, product_id,quantity, available,idUser){
		
		var data = {"place" : place, "product_id": product_id, "quantity": quantity, "available": available, "idUser": idUser};
/*		ici nous avons un objet data qui a pour attribut id*/
		jQuery.ajax({
			url : '/BrouillonCroisierePourTous16/admin/parsers/add_cart_snq.php',
			method : "post",
			data: data,
			success: function(data){
			
				jQuery('body').append(data);
				jQuery('#details-modal').modal('toggle');
			},
			error: function(){
				alert("something went wrong!");
			}
		});
	}


function detailsmodal(id,idUser){
		alert("something went wrong.");
		var foo = "<?=$machaine2?>";
		alert(foo);
		var data = {"idCroisiere" : id, "idUser": idUser};
	/*	ici nous avons un objet data qui a pour attribut id*/
		jQuery.ajax({
			url : "<?=$machaine2?>",
			method : "post",
			data: data,
			success: function(data){
				jQuery('body').append(data);
				jQuery('#details-modal').modal('toggle');
			},
			error: function(){
				alert("something went wrong!");
			}
		});
	}

function rechercheOption(){
		alert("something went wrong.");
		var foo = "<?=$machaine7?>";
		alert(foo);
		/*alert(nomCroisiere);*/
		var nomCrois = document.getElementById('nomCrois').value;
    	alert(nomCrois);
		var data = {"nomCroisiere" : nomCrois};
	/*	ici nous avons un objet data qui a pour attribut id*/
		jQuery.ajax({
			url : "<?=$machaine7?>",
			method : "post",
			data: data,
			success: function(data){
				/*document.getElementById("blocCentral").innerHTML = "";*/
				document.body.innerHTML = "";
				jQuery('body').append(data);
				jQuery('#details-modal').modal('toggle');
			},
			error: function(){
				alert("something went wrong!");
			}
		});
	}



function rechercheTermes(){
		alert("something went wrong dans rechercheTermes.");
		var foo = "<?=$machaine8?>";
		alert(foo);
		/*alert(nomCroisiere);*/
		var rech = document.getElementById('rech').value;
    	alert(rech);
		var data = {"rech" : rech};
	/*	ici nous avons un objet data qui a pour attribut id*/
		jQuery.ajax({
			url : "<?=$machaine8?>",
			method : "post",
			data: data,
			success: function(data){
				/*document.getElementById("blocCentral").innerHTML = "";*/
				document.body.innerHTML = "";
				jQuery('body').append(data);
				jQuery('#details-modal').modal('toggle');
			},
			error: function(){
				alert("something went wrong!");
			}
		});
	}
/*function rechercheOption(nomCroisiere){
		alert("something went wrong.");
		var foo = "<?=$machaine7?>";
		alert(foo);
		alert(nomCroisiere);
		var data = {"nomCroisiere" : nomCroisiere};
	/*	ici nous avons un objet data qui a pour attribut id*/
		/*jQuery.ajax({
			url : "<?=$machaine7?>",
			method : "post",
			data: data,
			success: function(data){
				jQuery('body').append(data);
				jQuery('#details-modal').modal('toggle');
			},
			error: function(){
				alert("something went wrong!");
			}
		});
	}
*/


function redirectionPaiement(){
		var nomCroisiere =6;
		// var quantity =jQuery('#quantity').val();
		var data = {"nomCroisiere" : nomCroisiere};
		var error = '';
		alert("Vous allez être redirigé vers une page pour le paiement!");
		
/*		if(cat == '' || quantity == '' || quantity == 0){
			error += '<p class="text-danger text-center">you must choose a place and quantity.</p>';
			jQuery('#modal_errors').html(error); 
			alert("something went wrong");
			return;
		}
		
		else if(quantity > available){
			error += '<p class="text-danger text-center">there are only '+available+' available.</p>';
			jQuery('#modal_errors').html(error);
			return;
		}
		else{*/
		
		jQuery.ajax({

			url: '/BrouillonCroisierePourTous16/paiement.php',
			method: "POST",
			data : data,
			success: function(data){
				alert("on est dans le else!");
				/*location.reload();*/
				document.body.innerHTML = "";
				jQuery('body').append(data);
				jQuery('#details-modal').modal('toggle');
			},
			error: function(){alert("something went wrong");}
		});
	}


function mettreAjour(){
		// var cat =jQuery('#cat').val();
		// var quantity =jQuery('#quantity').val();
		// var data = {test: "test", cat : "cat", product_id: "product_id", quantity: "quantity", available: "available", idUser: "idUser"};
		var nomParticulier = document.getElementById("nom-particulier").value;
		var prenomParticulier = document.getElementById("prenom-particulier").value;
		var emailParticulier = document.getElementById("email-particulier").value;
		var dateNaissanceParticulier = document.getElementById("dateNaissance-particulier").value;
		var adresse1Particulier = document.getElementById("adresse1-particulier").value;
		var adresse2Particulier = document.getElementById("adresse2-particulier").value;
		var adresse3Particulier = document.getElementById("adresse3-particulier").value;
		var adresse4Particulier = document.getElementById("adresse4-particulier").value;
		var codePostalParticulier = document.getElementById("codePostal-particulier").value;
		var villeParticulier = document.getElementById("ville-particulier").value;
		var paysParticulier = document.getElementById("pays-particulier").value;
		var phoneParticulier = document.getElementById("phone-particulier").value;
		var passeportParticulier = document.getElementById("passeport-particulier").value;
		var passwordParticulier = document.getElementById("password-particulier").value;
		alert("on est pas encore rentrer sans le if!");
/*		var confirmPasswordParticulier = document.getElementById("confirm-password-particulier").value;*/
/*		var repasParticulier = document.getElementById("repas-particulier").value;*/
		var raisonSociale = document.getElementById("raisonSociale").value;
		var siret = document.getElementById("siret").value;
		var nomRepresentant = document.getElementById("nom-representant").value;
		var prenomRepresentant = document.getElementById("prenom-representant").value;
		var emailRepresentant = document.getElementById("email-representant").value;
		var dateNaissanceRepresentant = document.getElementById("dateNaissance-representant").value;
		var phoneRepresentant = document.getElementById("phone-representant").value;
		var passwordRepresentant = document.getElementById("password-representant").value;
/*		var confirmPasswordRepresentant = document.getElementById("confirm-password-representant").value;*/
		var select = document.getElementById("select").value;
		var data = {"nomParticulier" : nomParticulier, "prenomParticulier": prenomParticulier, "emailParticulier": emailParticulier, "dateNaissanceParticulier": dateNaissanceParticulier, "adresse1Particulier": adresse1Particulier, "adresse2Particulier": adresse2Particulier, "adresse3Particulier": adresse3Particulier, "adresse4Particulier": adresse4Particulier, "codePostalParticulier": codePostalParticulier, "villeParticulier": villeParticulier, "paysParticulier": paysParticulier, "phoneParticulier": phoneParticulier, "passeportParticulier": passeportParticulier, "passwordParticulier": passwordParticulier, "raisonSociale" :  raisonSociale, "siret": siret, "nomRepresentant": nomRepresentant, "prenomRepresentant": prenomRepresentant, "emailRepresentant": emailRepresentant, "dateNaissanceRepresentant": dateNaissanceRepresentant, "phoneRepresentant": phoneRepresentant, "passwordRepresentant": passwordRepresentant, "select": select};
		var error = '';
		alert("on est apres les variables"+raisonSociale+siret+nomRepresentant+prenomRepresentant+emailRepresentant+dateNaissanceRepresentant+phoneRepresentant+passwordRepresentant+select);
/*		if(cat == '' || quantity == '' || quantity == 0){
			error += '<p class="text-danger text-center">you must choose a place and quantity.</p>';
			jQuery('#modal_errors').html(error); 
			alert("something went wrong");
			return;
		}
		
		else if(quantity > available){
			error += '<p class="text-danger text-center">there are only '+available+' available.</p>';
			jQuery('#modal_errors').html(error);
			return;
		}
		else{*/
		
		jQuery.ajax({

			url: '/BrouillonCroisierePourTous16/miseAjourInfosPerso.php',
			method: "POST",
			data : data,
			success: function(data){
				alert("on est dans le else!");
				location.reload();
				jQuery('body').append(data);
				jQuery('#details-modal').modal('toggle');
			},
			error: function(){alert("something went wrong");}
		});
}





</script>
</body>
</html>