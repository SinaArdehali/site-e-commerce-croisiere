q<?php
	require_once '../core/init.php';
	if(!is_logged_in()){
		login_error_redirect();
	}
	if(!has_permission('admin')){
		permission_error_redirect('index.php');
	}
	include 'includes/head.php';
	include 'includes/navigation.php';

	if(isset($_GET['delete'])){
		$delete_id = sanitize($_GET['delete']);
		$db -> query("delete from personne where id='$delete_id'");
		$_session['success_flash'] = 'user has been deleted';
		header('Location: users.php');
	}

	if(isset($_GET['add'])){
		$name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
		$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
		$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
		$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
		$permissions = ((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
		$errors = array();
		if ($_POST) {
			$emailQuery = $db->query("select * from personne where adresseEmail = '$email'");
			$emailCount =mysqli_num_rows($emailQuery);

			if($emailCount != 0){
				$errors[] = 'that email already exist in our database';
			}

			$required = array('name', 'email', 'password', 'confirm', 'permissions');
			foreach ($required as $f) {
				if(empty($_POST[$f])){
					$errors[] ='you must fill out all fields';
					break;
				}
			}

			if (strlen($password) <6) {
				$errors[] = 'your password must be at least 6 characters';
			}

			if ($password != $confirm) {
				$errors[] = 'your password do not match';
			}


			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors[] = 'you must enter a valid email';
			}


			if (!empty($errors)) {
				echo display_errors($errors);
			}
			else{
				//add user to database
				$hashed = password_hash($password,PASSWORD_DEFAULT);
				$db->query("insert into personne (prenom,adresseEmail,password,adminOuPas) values ('$name','$email','$hashed','$permissions')");
				$_SESSION['success_flash'] ='user has been added';
				header('Location: users.php');
			}
		}
		?>

		<h2 class="text-center">add a new user</h2><hr>
		<form action="users.php?add=1" method="post">
			<div class="form-group col-md-6">
				<label for="name">full name:</label>
				<input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
			</div>
			<div class="form-group col-md-6">
				<label for="email">email:</label>
				<input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
			</div>
			<div class="form-group col-md-6">
				<label for="password">full password:</label>
				<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
			</div>
			<div class="form-group col-md-6">
				<label for="confirm">confirm password:</label>
				<input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
			</div>
			<div class="form-group col-md-6">
				<label for="name">full permission:</label>
				<select class="form-control" name="permissions">
					<option value=""<?=(($permissions == '')?' selected':'');?>></option>
					<option value="editor"<?=(($permissions == 'editor')?' selected':'');?>>editor</option>
					<option value="admin,editor"<?=(($permissions == 'admin,editor')?' selected':'');?>>admin</option>
				</select>
			</div>
			<div class="form-group col-md-6 text-right" style="margin-top: 25px;">
				<a href="users.php" class="btn btn-default">Cancel</a>
				<input type="submit" value="add user" class="btn btn-primary">
			</div>
		</form>


		<?php


	}else{

	$userQuery = $db->query("select * from personne order by prenom");
?>
<h2>Users</h2>
<a href="users.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add new user</a>
<hr>
<table class="table table-bordered table-striped table-condensed">
	<thead><th></th><th>Name</th><th>Email</th><th>Join Date</th><th>Last Login</th><th>Permissions</th></thead>
	<tbody>
		<?php while ($user = mysqli_fetch_assoc($userQuery)): ?>
			<tr>
				<td>
					<?php if($user['idPersonne'] != $user_data['idPersonne']): ?>
						<a href="users.php?delete=<?=$user['idPersonne'];?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove-sign"></span></a>
					<?php endif; ?>
				</td>
				<td><?=$user['prenom'];?></td>
				<td><?=$user['adresseEmail'];?></td>
				<td><?=pretty_date($user['join_date']);?></td>
				<td><?=(($user['last_login'] == '0000-00-00 00:00:00')?'Never':pretty_date($user['last_login']));?></td>
				<td><?=$user['adminOuPas'];?></td>
			</tr>
		<?php endwhile; ?>
	</tbody>
<?php } include 'includes/footer.php'; ?>