<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/CPTBrouillon/core/init.php';
if (!is_logged_in()) {
	# code...
	login_error_redirect();
}
include 'includes/head.php';

$hashed = $user_data['password'];
$old_password =((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
$old_password = trim($old_password);
$password =((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$confirm =((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$confirm = trim($confirm);
$new_hashed = password_hash($password, PASSWORD_DEFAULT);
$user_id = $user_data['idPersonne'];
$errors =array();

?>


<div id="login-form">
	<div>

	<?php
		if($_POST){
//			form validation
			if(empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])){
				$errors[] ='you must fill out all fields';
			}


			//password is more than 6 characters
			if(strlen($password) < 6){
				$errors[] = 'Password must be at least 6 characters.';
			}

			//if new password matches confirm
			if($password != $confirm){
				$errors[] = 'the new password and confirm new password does not match';
			}

			if(!password_verify($old_password, $hashed)){
				$errors[]= 'votre vieux pasword does not match our records.';
			}

			//check for errors 
			if (!empty($errors)) {
				echo display_errors($errors);

			}else{
				//changer password
				$db -> query("update personne set password = '$new_hashed' where id = '$user_id'");
				$_SESSION['session_flash'] = 'your password has been updated';
				header('Location: index.php');
			}
		}

	?>

	</div>
	<h2 class="text-center">change password</h2><hr>
	<form action="change_password.php" method="POST">
	
	<div class="form-group">
		<label for="old_password">old password:</label>
		<input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>" >
	</div>

	<div class="form-group">
		<label for="password"> new Password:</label>
		<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>" >
	</div>
		<div class="form-group">
		<label for="confirm">confirm new password:</label>
		<input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>" >
	</div>
	<div class="form-group">
		<a href="index.php" class="btn btn-default">cancel</a>
		<input type="submit" value="Login" class="btn btn-primary">
	</div>
	</form>
	<p class="text-right"><a href="/CPTBrouillon/index.php" alt="home">Visit Site</a></p>
</div>

<?php include 'includes/footer.php';
