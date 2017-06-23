<?php
ob_start();
?>
<?php
function display_errors($errors){
	$display = '<ul class="bg-danger">';
	foreach($errors as $error){
		$display .= '<li class="text-danger">'.$error.'</li>';
	}
	$display .= '</ul>';
	return $display;
}
function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}
function login($user_id){
	$_SESSION['SBUser'] = $user_id;
	global $db;
	$date = date("Y-a-d H:i:s");
	$db->query("UPDATE personne SET last_login = '$date' where id = '$user_id'");
	/*$_SESSION['success_flash'] ='you are now logged in!';*/
	/*header('Location: accueil.php');*/
/*	location.href('accueil.php');*/
/*	window.location='accueil.php';*/
	echo "<script>location.assign('accueil.php')</script>";
	/*
	echo "<script>alert(' dans la fonction loggin')</script>";	
	
?>
	<form action="accueil.php" method="POST">         
			<input type="hidden" name="user_id"  id="user_id" value="<?=$user_id;?>">
	</form>
<?php
	echo $user_id;
	echo "<script>alert(' apres le form')</script>";
	?>
					<!-- <script>
					alert(' dans le bout de js');
					window.location.href = 'accueil.php';
					alert(' apres le window location');
					</script> -->

				<?php	*/		
}




function is_logged_in(){
	if (isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0) {
		return true;
	}
	return false;
}

function login_error_redirect($url = 'login.php'){
	$_SESSION['error_flash'] = 'vous navez pas la permission pour acceder a cette page';
	header('Location: '.$url);
}

function permission_error_redirect($url = 'login.php'){
	$_SESSION['error_flash'] = 'vous navez pas la permission pour acceder a cette page';
	header('Location: '.$url);
}

function has_permission($permission = 'admin'){
	global $user_data;
	$permissions = explode(',', $user_data['adminOuPas']);
	if(in_array($permission, $permissions, true)){
		return true;
	}
	return false;
}

function pretty_date($date){
	return date("M d, Y h:i A", strtotime($date));
}
?>
<?php
ob_flush();
?>