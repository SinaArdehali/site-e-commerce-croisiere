 <?php


 $cheminCourantind = getcwd();
$dirCourantind = substr(strrchr($cheminCourantind, "\\"), 1);



//recuperer le nom du dossier au desssus du dossier courant
$cheminJusqueAuDessusind = substr($cheminCourantind, 0, strrpos( $cheminCourantind, '\\') );
$justeNomDossierDessusind = substr(strrchr($cheminJusqueAuDessusind, "\\"), 1);


require_once $_SERVER['DOCUMENT_ROOT'].'/'.$dirCourantind.'/core/init.php';
include 'includes/head.php';

$email =((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password =((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$errors =array();
?>



<!-- 


<?php header("Content-Type: text/html; charset=UTF-8");?> -->

<style>
/* Reset */
* {
	margin: 0;
	padding: 0;
	vertical-align: baseline;
	box-sizing: border-box;
	border: 0;
	outline: 0;
}


/* General */
body {
	width: 100%;
	font-family: Roboto, sans-serif;
	background: #3b4465;

}

button {
	position: relative;
	width: 160px;
	text-transform: uppercase;
	font-size: 14px;
	background-color: transparent;
}

form {
  position: relative;
/*	width: 260px;*/
	width: auto;
/*	height: 280px;*/
	height: auto;
	padding: 20px;
	background: #d7e7f1;
	border-radius: 5px;
}

form label, form input {
	display: block;
	opacity: 0;
}

legend {
  position: absolute;
  top: 0;
  left: -10000px;
}

label {
	padding-top: 15px;
	font-size: 14px;
	color: #a1b4b4;
	letter-spacing: 0.5px;
}

input:not([type="submit"]) {
	width: 520px;
	margin: 5px auto 0;
	padding: 0 15px;
	line-height: 40px;
	font-size: 14px;
	color: #3b4465;
	background: #eef9fe;
	border: 1px solid #cddbef;
	border-radius: 2px;
}

input[type="submit"] {
	float: right;
	width: 120px;
	margin-top: 30px;
	line-height: 40px;
	font-size: 18px;
	border-radius: 20px;
}


/* Buttons and Inputs */
.buttons,
.forms {
	display: flex;
	flex-flow: row nowrap;
	justify-content: center;
	width: 550px;
	margin: 0 auto;
}

.buttons {
	height: 100px;
	padding-top: 70px;
	text-align: center;
}

.forms {
  padding-top: 50px;
}

.log-link,
.sign-link {
  cursor: pointer;
  color: #bbb;
}

.log-link.login-button-active,
.sign-link.signup-button-active {
  cursor: default;
  color: #fff;
}

.login-underline,
.signup-underline {
	position: absolute;
	top: 35px;
	left: 30px;
	height: 2px;
	width: 100px;
	opacity: 0;
	background: #c8dfed;
}

.login-underline.login-button-active {
	animation: loginUnderlineActive .2s linear .1s forwards;
	transform-origin: right;
}

.login-underline.signup-button-active {
	animation: loginUnderlineInactive .3s linear forwards;
	transform-origin: right;
}

.signup-underline.signup-button-active {
	animation: signupUnderlineActive .2s linear .1s forwards;
	transform-origin: left;
}

.signup-underline.login-button-active {
	animation: signupUnderlineInactive .3s linear forwards;
	transform-origin: left;
}

.login-button-active {
  animation: buttonsMoveToRight .3s linear forwards;
}

.signup-button-active {
  animation: buttonsMoveToLeft .3s linear forwards;
}

.login-form.login-button-active label,
.login-form.login-button-active input {
  animation: fielsetSlideToRight .5s linear 0.25s forwards;
}

.signup-form.signup-button-active label,
.signup-form.signup-button-active input {
  animation: fieldsetSlideToLeft .5s linear 0.25s forwards;
}

.login-form input[type="submit"] {
	color: #fbfdff;
	background: #a7e245;
}

.signup-form input[type="submit"] {
	color: #a7e245;
	background: #fbfdff;
	box-shadow: inset 0 0 0 2px #a7e245;
}

.login-form {
  animation: loginToBottom .4s linear forwards;
}

.signup-form {
  animation: signUpToBottom .4s linear forwards;
}

.login-form.login-button-active {
  animation: loginToTop .4s linear forwards;
}

.signup-form.signup-button-active {
  animation: signUpToTop .4s linear forwards;
}


/* Animations */
@keyframes loginUnderlineActive {
	0% {
		transform: scale(0);
		opacity: 1;
	}
	100% {
		transform: scale(1);
		opacity: 1;
	}
}

@keyframes signupUnderlineActive {
	0% {
		transform: scale(0);
		opacity: 1;
	}
	100% {
		transform: scale(1);
		opacity: 1;
	}
}

@keyframes loginUnderlineInactive {
	0% {
		transform: scale(1);
		opacity: 1;
	}
	100% {
		transform: scale(0);
		opacity: 1;
	}
}

@keyframes signupUnderlineInactive {
	0% {
		transform: scale(1);
		opacity: 1;
	}
	100% {
		transform: scale(0);
		opacity: 1;
	}
}

@keyframes buttonsMoveToRight {
	0% {
		transform: translate(0);
	}
	100% {
		transform: translate(50px);
	}
}

@keyframes buttonsMoveToLeft {
	0% {
		transform: translate(0);
	}
	100% {
		transform: translate(-50px);
	}
}

@keyframes fielsetSlideToRight {
	0% {
		transform: translate(-15px);
		opacity: 0;
	}
	100% {
		transform: translate(0);
		opacity: 1;
	}
}

@keyframes fieldsetSlideToLeft {
	0% {
		transform: translate(15px);
		opacity: 0;
	}
	100% {
		transform: translate(0);
		opacity: 1;
	}
}

@keyframes loginToBottom {
	0% {
		transform: translate(100px);
		z-index: 10;
		background-color: #fff;
	}
	49% {
		transform: translate(0);
		z-index: 10;
	}
	50% {
		transform: translate(0);
		z-index: 1;
	}
	100% {
		transform: translate(100px, 20px);
		z-index: 1;
		background-color: #d7e7f1;
	}
}

@keyframes signUpToBottom {
	0% {
		transform: translate(-100px);
		z-index: 10;
		height: 360px;
		background-color: #fff;
	}
	49% {
		transform: translate(0);
		z-index: 10;
	}
	50% {
		transform: translate(0);
		z-index: 1;
	}
	100% {
		transform: translate(-100px, 20px);
		z-index: 1;
		height: 280px;
/*		height: auto;*/
		background-color: #d7e7f1;
	}
}

@keyframes loginToTop {
	0% {
		transform: translate(100px, 20px);
		z-index: 1;
		background-color: #d7e7f1;
	}
	49% {
		transform: translate(0);
		z-index: 1;
	}
	50% {
		transform: translate(0);
		z-index: 10;
	}
	100% {
		transform: translate(100px);
		z-index: 10;
		background-color: #fff;
	}
}

@keyframes signUpToTop {
	0% {
		transform: translate(-100px, 20px);
		z-index: 1;
		background-color: #d7e7f1;
	}
	25% {height: 280px;}
	49% {
		transform: translate(0);
		z-index: 1;
	}
	50% {
		transform: translate(0);
		z-index: 10;
	}
	100% {
		transform: translate(-100px);
		z-index: 10;
		height: 360px;
		background-color: #fff;
	}
}

</style>














 <body>
	<main>
		<div class="buttons login-button-active" data-action="animated">
			<button class="login-button">
				<span class="log-link login-button-active" data-action="animated">Pour les particuliers</span>
				<span class="login-underline login-button-active" data-action="animated"></span>
			</button>
			<button class="signup-button">
				<span class="sign-link" data-action="animated">Pour les professionnels</span>
				<span class="signup-underline login-button-active" data-action="animated"></span>
			</button>
		</div>
		<div class="forms">
			<form class="login-form login-button-active" data-action="animated">
				<fieldset>
					<legend>Please, enter your email and password for login.</legend>

					<label for="nom-particulier">Nom</label>
					<input id="nom-particulier" type="text" name="nom-particulier" required>
					<label for="prenom-particulier">Prenom</label>
					<input id="prenom-particulier" type="text" name="prenom-particulier" required>
					<label for="email-particulier">Email (Login)</label>
					<input id="email-particulier" type="email" name="email-particulier">
					<label for="dateNaissance-particulier">Date de naissance</label>
					<input id="dateNaissance-particulier" type="date" name="dateNaissance-particulier">
					<label for="adresse1-particulier">Adresse (Ligne 1)</label>
					<input id="adresse1-particulier" type="text" name="adresse1-particulier">
					<label for="adresse2-particulier">Adresse (Ligne 2)</label>
					<input id="adresse2-particulier" type="text" name="adresse2-particulier">
					<label for="adresse3-particulier">Adresse (Ligne 3)</label>
					<input id="adresse3-particulier" type="text" name="adresse3-particulier">
					<label for="adresse4-particulier">Adresse (Ligne 4)</label>
					<input id="adresse4-particulier" type="text" name="adresse4-particulier">
					<label for="codePostal-particulier">Code Postal</label>
					<input id="codePostal-particulier" type="text" name="codePostal-particulier">
					<label for="ville-particulier">Ville</label>
					<input id="ville-particulier" type="text" name="ville-particulier">
					<label for="pays-particulier">Pays</label>
					<input id="pays-particulier" type="text" name="pays-particulier">
					<label for="phone-particulier">Téléphone</label>
					<input id="phone-particulier" type="tel" name="phone-particulier">
					<label for="passeport-particulier">Numero de Passeport ou Numero de Carte d'identité</label>
					<input id="passeport-particulier" type="text" name="passeport-particulier">
					<label for="password-particulier">Mot de Passe</label>
					<input id="password-particulier" type="password" name="password-particulier">
					<label for="confirm-password-particulier">Confirmer Mot de Passe</label>
					<input id="confirm-password-particulier" type="password" name="confirm-password-particulier">
					<label for="repas-particulier">Préférence repas</label>
					<input id="repas-particulier" type="text" name="repas-particulier">
					<br>
					<label for="conjoint-nom-particulier">Nom du Conjoint</label>
					<input id="conjoint-nom-particulier" type="text" name="conjoint-nom-particulier">
					<label for="conjoint-prenom-particulier">Prenom du Conjoint</label>
					<input id="conjoint-prenom-particulier" type="text" name="conjoint-prenom-particulier">
					<label for="conjoint-dateNaissance-particulier">Date de naissance du Conjoint</label>
					<input id="conjoint-dateNaissance-particulier" type="date" name="conjoint-dateNaissance-particulier">

				</fieldset>
				<input type="submit" onclick="enregistrerParticulier()" value="S'inscrire">
				<!-- <button class="btn btn-warning" onclick="enregistrer()"><span class="glyphicon glyphicon-shopping-cart"></span>Ajouter au panier</button> -->
			</form>
			<form class="signup-form" data-action="animated">
				<fieldset>
					<legend>Please, enter your email, password and password confirmation for sign up.</legend>
					<label for="raisonSociale">Raison Sociale</label>
					<input id="raisonSociale" type="text" name="raisonSociale" required>
					<label for="siret">SIRET</label>
					<input id="siret" type="text" name="siret">
					<label for="nom-representant">Nom du Représentant</label>
					<input id="nom-representant" type="text" name="nom-representant">
					<label for="prenom-representant">Prenom du Représentant</label>
					<input id="prenom-representant" type="text" name="prenom-representant">
					<label for="email-representant">Email du Représentant (Login)</label>
					<input id="email-representant" type="email" name="email-representant">
					<label for="dateNaissance-representant">Date de naissance</label>
					<input id="dateNaissance-representant" type="date" name="dateNaissance-representant">
					<label for="phone-representant">Telephone du représentant</label>
					<input id="phone-representant" type="tel" name="phone-representant">
					<label for="password-representant">Mot de Passe</label>
					<input id="password-representant" type="password" name="password-representant">
					<label for="confirm-password-representant">Confirmer Mot de Passe</label>
					<input id="confirm-password-representant" type="password" name="confirm-password-representant">
					<br>
					<select id="select">
						<option value="" selected>Nombre de salarié</option>
					  	<option value="valeur1">Valeur 1</option> 
					  	<option value="valeur2">Valeur 2</option>
					  	<option value="valeur3">Valeur 3</option>
					</select>
				</fieldset>
					<input type="submit" onclick="enregistrerProfessionnel()" value="S'inscrire">
					
				<!-- <input href="index_flo.php" type="submit" value="S'inscrire"> -->
			</form>
		</div>
	</main>
</body>


<script type="text/javascript">
	
var buttons = document.querySelector('.buttons');
var loginButton = document.querySelector('.log-link');
var signupButton = document.querySelector('.sign-link');
var activeElements = document.querySelectorAll('[data-action="animated"]');

buttons.addEventListener('click', switcher);

function switcher(e) {
  if(e.target == loginButton) {
    for (var i = 0; i < activeElements.length; i++) {
      activeElements[i].classList.remove('signup-button-active');
      activeElements[i].classList.add('login-button-active');
    }
  } else if(e.target == signupButton) {
    for (var i = 0; i < activeElements.length; i++) {
      activeElements[i].classList.remove('login-button-active');
      activeElements[i].classList.add('signup-button-active');
    }
  }
}

// OR

/*var loginButton = document.querySelector('.log-link');
var signupButton = document.querySelector('.sign-link');
var activeElements = document.getElementsByName('animated');

loginButton.onclick = function() {
  for (var i = 0; i < activeElements.length; i++) {
    activeElements[i].classList.remove('signup-button-active');
    activeElements[i].classList.add('login-button-active');
  }
}

signupButton.onclick = function() {
  for (var i = 0; i < activeElements.length; i++) {
    activeElements[i].classList.remove('login-button-active');
    activeElements[i].classList.add('signup-button-active');
  }
}*/




</script>

<?php include 'includes/footer.php';?>