<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/BrouillonCroisierePourTous/core/init.php';
include 'includes/head.php';

$email =((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password =((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$errors =array();





?>

<style>
	body{
		background-image:url("/BrouillonCroisierePourTous/images/imageDeFond.jpg");
		background-size: 100vw 100vh;
		background-attachment: fixed;
	}
</style>
<div id="login-form">
	<div>

	<?php
		if($_POST){
//			form validation
			if(empty($_POST['email']) || empty($_POST['password'])){
				$errors[] ='you must provide email and password';
			}

			//validate email
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$errors[] ='you must enter a valid email';
			}

			//password is more than 6 characters
			if(strlen($password) < 6){
				$errors[] = 'Password must be at least 6 characters.';
			}

			//check  if emial exist in the database
			$query =$db ->query("select * from personne where adresseEmail ='$email'");
			$user = mysqli_fetch_assoc($query);
			$userCount = mysqli_num_rows($query);
			if($userCount < 1){
				$errors[] = 'Cet email nexiste pas dans la base de donnees.';
			}

			if(!password_verify($password, $user['password'])){
				$errors[]= 'le password ne matche pas avec lutilisateur. essaie a nouveau';
			}

			//check for errors 
			if (!empty($errors)) {
				echo display_errors($errors);

			}else{
				$user_id = $user['idPersonne'];
				login($user_id);
			}
		}

	?>

 	</div>
		<h2 class="text-center"><font color="black" size="15" face="Playfair Display">Login</font></h2><hr>
		<form action="accueil.php" method="POST">
		
			<div class="form-group">
				<label for="email"><font color="black" size="3" face="Playfair Display">Email:</font></label>
				<input type="text" name="email" id="email" class="form-control" value="<?=$email;?>" >
			</div>

			<div class="form-group">
				<label for="password"><font color="black" size="3" face="Playfair Display">Password:</font></label>
				<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>" >
			</div>
			<div class="form-group">
				<input type="submit" value="Login" class="btn btn-primary">
			<input type="hidden" name="idUser"  id="idUser" value="<?=$idUser;?>">
			</div>
			<div class="form-group">
				<a href="registration2.php">S'enregistrer</a>
			<input type="hidden" name="idUser"  id="idUser" value="<?=$idUser;?>">
			</div>
		</form>

	</div>










<?php include 'includes/footer.php';
