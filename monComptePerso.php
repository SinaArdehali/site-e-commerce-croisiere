<?php
require_once 'core/init.php';
?>
<!DOCTYPE html>
<html>
<?php
	include 'includes/head.php'; 
	include 'includes/navigation.php';
	include 'includes/headerfull.php';


$idUser = $_SESSION['SBUser'];

$queryPrefilled = "SELECT *
	FROM personne P, clientpart CPart, clientpro CPro
	WHERE P.idPersonne='$idUser'
	AND (P.idPersonne = CPart.idPersonne
	OR P.idPersonne = CPro.representPersonne)
	";
$responsePrefilled = $db->query($queryPrefilled);
/*echo "<script> alert('".." je suis laaaa') </script>";*/
$tabPrefilled = mysqli_fetch_assoc($responsePrefilled);

?>

<body>
	<main>

		<div class="buttons login-button-active" data-action="animated">
			<!-- <button class="login-button">
				<span class="log-link login-button-active" data-action="animated">Pour les particuliers</span>
				<span class="login-underline login-button-active" data-action="animated"></span>
			</button>
			<button class="signup-button">
				<span class="sign-link" data-action="animated">Pour les professionnels</span>
				<span class="signup-underline login-button-active" data-action="animated"></span>
			</button> -->
		</div>
		<h2 style="text-align:center">Veuillez changer la valeur des champs que vous voulez modifier</h2>
		<div class="forms">
			<form class="signup-form" data-action="animated">
				<div class="modal-body row">

<?php
if(isset($tabPrefilled['numeroPasseport']))
{
	

?>

				<div class="col-md-6  ArrangeMargeBcpDeTexte">
				<fieldset>
					<legend>Informations personnelles</legend>

					<label for="nom-particulier">Nom</label>
					<input id="nom-particulier" type="text" name="nom-particulier" value="<?=$tabPrefilled['nom']?>">
					<br><br>
					<label for="prenom-particulier">Prenom</label>
					<input id="prenom-particulier" type="text" name="prenom-particulier" value="<?=$tabPrefilled['prenom']?>"><br><br>
					<label for="email-particulier">Email (Login)</label>
					<input id="email-particulier" type="email" name="email-particulier" value="<?=$tabPrefilled['adresseEmail']?>"><br><br>
					<label for="dateNaissance-particulier">Date de naissance</label>
					<input id="dateNaissance-particulier" type="date" name="dateNaissance-particulier" value="<?=$tabPrefilled['dateNaissance']?>"><br><br>
					<label for="adresse1-particulier">Adresse (Ligne 1)</label>
					<input id="adresse1-particulier" type="text" name="adresse1-particulier" value="<?=$tabPrefilled['adresse1']?>"><br><br>
					<label for="adresse2-particulier">Adresse (Ligne 2)</label>
					<input id="adresse2-particulier" type="text" name="adresse2-particulier" value="<?=$tabPrefilled['adresse2']?>"><br><br>
					<label for="adresse3-particulier">Adresse (Ligne 3)</label>
					<input id="adresse3-particulier" type="text" name="adresse3-particulier" value="<?=$tabPrefilled['adresse3']?>"><br><br>
					<label for="adresse4-particulier">Adresse (Ligne 4)</label>
					<input id="adresse4-particulier" type="text" name="adresse4-particulier" value="<?=$tabPrefilled['adresse4']?>"><br><br>
					<label for="codePostal-particulier">Code Postal</label>
					<input id="codePostal-particulier" type="text" name="codePostal-particulier" value="<?=$tabPrefilled['codePostal']?>"><br><br>
					<label for="ville-particulier">Ville</label>
					<input id="ville-particulier" type="text" name="ville-particulier" value="<?=$tabPrefilled['ville']?>"><br><br>
					<label for="pays-particulier">Pays</label>
					<input id="pays-particulier" type="text" name="pays-particulier" value="<?=$tabPrefilled['pays']?>"><br><br>
					<label for="phone-particulier">Téléphone</label>
					<input id="phone-particulier" type="tel" name="phone-particulier" value="<?=$tabPrefilled['phoneNumber']?>"><br><br>
					<label for="passeport-particulier">Numero de Passeport ou Numero de Carte d'identité</label>
					<input id="passeport-particulier" type="text" name="passeport-particulier" value="<?=$tabPrefilled['numeroPasseport']?>"><br><br>
					<label for="password-particulier">Mot de Passe</label>
					<input id="password-particulier" type="password" name="password-particulier" value="<?=$tabPrefilled['password']?>"><br><br>
					<!-- <label for="confirm-password-particulier">Confirmer Mot de Passe</label>
					<input id="confirm-password-particulier" type="password" name="confirm-password-particulier" value="<?=$tabPrefilled['nom']?>"><br><br> -->
					<!-- <label for="repas-particulier">Préférence repas</label>
					<input id="repas-particulier" type="text" name="repas-particulier" value="<?=$tabPrefilled['nom']?>"><br><br>
					<br> -->
					<!-- <label for="conjoint-nom-particulier">Nom du Conjoint</label>
					<input id="conjoint-nom-particulier" type="text" name="conjoint-nom-particulier" value="<?=$tabPrefilled['nom']?>"><br><br>
					<label for="conjoint-prenom-particulier">Prenom du Conjoint</label>
					<input id="conjoint-prenom-particulier" type="text" name="conjoint-prenom-particulier" value="<?=$tabPrefilled['nom']?>"><br><br>
					<label for="conjoint-dateNaissance-particulier">Date de naissance du Conjoint</label>
					<input id="conjoint-dateNaissance-particulier" type="date" name="conjoint-dateNaissance-particulier" value="<?=$tabPrefilled['nom']?>"><br><br> -->

				 </fieldset>
				 </div>
				<!-- <input type="submit" onclick="enregistrerParticulier()" value="S'inscrire">
				<button class="btn btn-warning" onclick="enregistrer()"><span class="glyphicon glyphicon-shopping-cart"></span>Ajouter au panier</button>
			</form>
			<form class="signup-form" data-action="animated"> -->


<?php
}
 
else // Le mot de passe n'est pas bon.
{
/*	header('Location: index.php');*/
?>
				
			<div class="col-md-6 ArrangeMargeBcpDeTexte">
				<fieldset>
					<legend>Informations personnelles</legend>
					<label for="raisonSociale">Raison Sociale</label>
					<input id="raisonSociale" type="text" name="raisonSociale" value="<?=$tabPrefilled['raisonSociale']?>" required><br><br>
					<label for="siret">SIRET</label>
					<input id="siret" type="text" name="siret" value="<?=$tabPrefilled['siret']?>"><br><br>
					<label for="nom-representant">Nom du Représentant</label>
					<input id="nom-representant" type="text" name="nom-representant" value="<?=$tabPrefilled['nom']?>"><br><br>
					<label for="prenom-representant">Prenom du Représentant</label>
					<input id="prenom-representant" type="text" name="prenom-representant" value="<?=$tabPrefilled['prenom']?>"><br><br>
					<label for="email-representant">Email du Représentant (Login)</label>
					<input id="email-representant" type="email" name="email-representant" value="<?=$tabPrefilled['adresseEmail']?>"><br><br>
					<label for="dateNaissance-representant">Date de naissance</label>
					<input id="dateNaissance-representant" type="date" name="dateNaissance-representant" value="<?=$tabPrefilled['dateNaissance']?>"><br><br>
					<label for="phone-representant">Telephone du représentant</label>
					<input id="phone-representant" type="tel" name="phone-representant" value="<?=$tabPrefilled['phoneNumber']?>"><br><br>
					<label for="password-representant">Mot de Passe</label>
					<input id="password-representant" type="password" name="password-representant" value="<?=$tabPrefilled['password']?>"><br><br>
					<!-- <label for="confirm-password-representant">Confirmer Mot de Passe</label>
					<input id="confirm-password-representant" type="password" name="confirm-password-representant" value="<?=$tabPrefilled['nom']?>"><br><br> -->
					<br>
					<select id="select">
						<option value="" selected>Nombre de salarié</option>
					  	<option value="valeur1">Valeur 1</option> 
					  	<option value="valeur2">Valeur 2</option>
					  	<option value="valeur3">Valeur 3</option>
					</select>

					<label for="nom-particulier">Nom</label>
					<input type="hidden" id="nom-particulier" type="text" name="nom-particulier" value="<?=$tabPrefilled['nom']?>">
					<br><br>
					<label for="prenom-particulier">Prenom</label>
					<input type="hidden" id="prenom-particulier" type="text" name="prenom-particulier" value="<?=$tabPrefilled['prenom']?>"><br><br>
					<label for="email-particulier">Email (Login)</label>
					<input type="hidden" id="email-particulier" type="email" name="email-particulier" value="<?=$tabPrefilled['adresseEmail']?>"><br><br>
					<label for="dateNaissance-particulier">Date de naissance</label>
					<input type="hidden" id="dateNaissance-particulier" type="date" name="dateNaissance-particulier" value="<?=$tabPrefilled['dateNaissance']?>"><br><br>
					<label for="adresse1-particulier">Adresse (Ligne 1)</label>
					<input type="hidden" id="adresse1-particulier" type="text" name="adresse1-particulier" value="<?=$tabPrefilled['adresse1']?>"><br><br>
					<label for="adresse2-particulier">Adresse (Ligne 2)</label>
					<input type="hidden" id="adresse2-particulier" type="text" name="adresse2-particulier" value="<?=$tabPrefilled['adresse2']?>"><br><br>
					<label for="adresse3-particulier">Adresse (Ligne 3)</label>
					<input type="hidden" id="adresse3-particulier" type="text" name="adresse3-particulier" value="<?=$tabPrefilled['adresse3']?>"><br><br>
					<label for="adresse4-particulier">Adresse (Ligne 4)</label>
					<input type="hidden" id="adresse4-particulier" type="text" name="adresse4-particulier" value="<?=$tabPrefilled['adresse4']?>"><br><br>
					<label for="codePostal-particulier">Code Postal</label>
					<input type="hidden" id="codePostal-particulier" type="text" name="codePostal-particulier" value="<?=$tabPrefilled['codePostal']?>"><br><br>
					<label for="ville-particulier">Ville</label>
					<input type="hidden" id="ville-particulier" type="text" name="ville-particulier" value="<?=$tabPrefilled['ville']?>"><br><br>
					<label for="pays-particulier">Pays</label>
					<input type="hidden" id="pays-particulier" type="text" name="pays-particulier" value="<?=$tabPrefilled['pays']?>"><br><br>
					<label for="phone-particulier">Téléphone</label>
					<input type="hidden" id="phone-particulier" type="tel" name="phone-particulier" value="<?=$tabPrefilled['phoneNumber']?>"><br><br>
					<label for="passeport-particulier">Numero de Passeport ou Numero de Carte d'identité</label>
					<input type="hidden" id="passeport-particulier" type="text" name="passeport-particulier" value="<?=$tabPrefilled['numeroPasseport']?>"><br><br>
					<label for="password-particulier">Mot de Passe</label>
					<input type="hidden" id="password-particulier" type="password" name="password-particulier" value="<?=$tabPrefilled['password']?>"><br><br>




				</fieldset>
		<?php

}
?>		

					<input type="submit" onclick="mettreAjour()" value="Mettre à jour">
				</div>
				</div>
					
				<!-- <input href="index_flo.php" type="submit" value="S'inscrire"> -->
			</form>
		</div>
	</main>
</body>


<?php 
echo "<script> alert('".$_SESSION['SBUser']." je suis laaaa') </script>";	
include 'includes/footer.php';?>