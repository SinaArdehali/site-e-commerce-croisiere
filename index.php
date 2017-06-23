<?php
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


	FUNCTION getCurrentDirectory() {
	$path = DIRNAME($_SERVER['DOCUMENT_ROOT']);
	$position = STRRPOS($path,'/') + 1;
	RETURN SUBSTR($path,$position);
	}

	$nomApp = getCurrentDirectory();


	//POUR CHANGER LE NOM DU PROGRAMME, ALLEZ DANS LE INIT ET CHANGER LA VARIABLE APPELé $nomApp.










//recuperer le nom du dossier courant
$cheminCourantind = getcwd();
$dirCourantind = substr(strrchr($cheminCourantind, "\\"), 1);



//recuperer le nom du dossier au desssus du dossier courant
$cheminJusqueAuDessusind = substr($cheminCourantind, 0, strrpos( $cheminCourantind, '\\') );
$justeNomDossierDessusind = substr(strrchr($cheminJusqueAuDessusind, "\\"), 1);

/*$GLOBALS['dir'];*/
/*define("DOSSCOURANT", $dir);*/

/* ici je teste lecode ecrit ci dessus concernant les dossiers et les chemins*/
/*echo 'dans index : ';
echo '<br/>';
echo $cheminCourantind.'<br/>';
echo $dirCourantind;
echo '<br/>';
echo $cheminJusqueAuDessusind;
echo '<br/>';
echo $justeNomDossierDessusind;
*/



/*
$current_dir = getcwd();
	$current_dir = str_replace("\\", "/", $current_dir); 
	$nomApp = $current_dir;
	*/

	/*$var = getcwd();
	$var = explode('\\', $var); // your OS might use '/' instead
	$nomApp = end($var);
*/
	/*$var = getcwd();
	$var = explode('\\', $var);
	$nomApp = end($var);*/


	/*FUNCTION getCurrentDirectory() {
	$path = DIRNAME($_SERVER['DOCUMENT_ROOT']);
	$position = STRRPOS($path,'/') + 1;
	RETURN SUBSTR($path,$position);
	}

	$nomApp = getCurrentDirectory();*/


	//POUR CHANGER LE NOM DU PROGRAMME, ALLEZ DANS LE INIT ET CHANGER LA VARIABLE APPELé $nomApp.







$maChaine = "/".$dirCourantind."/images/imageDeFond.jpg";


require_once 'core/init.php';

$_SESSION['connect']=0;
	
require_once $_SERVER['DOCUMENT_ROOT'].'/'.$dirCourantind.'/core/init.php';
include 'includes/head.php';

/*$_SESSION['connected'] = false;
*/
$email =((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password =((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$errors =array();
?>
<style>
	body{
		background-image:url(<?php echo $maChaine?>);
		/*background-image:url('/'.<?php echo $dirCourantind?>.'/images/imageDeFond.jpg');*/
		
		background-size: 100vw 100vh;
		background-attachment: fixed;
	}
</style>
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

			/*if(!password_verify($password, $user['password'])){*/
			if ($password != $user['password']){
				
				$errors[]= 'le password ne matche pas avec lutilisateur. essaie a nouveau';
			}

			//check for errors 
			if (!empty($errors)) {
				
				echo display_errors($errors);

			}else{
				$_SESSION['connect']=1;
				$user_id = $user['idPersonne'];
				/*echo "<script>alert("salut")</script>";*/
				/*echo "<script>alert($user_id)</script>";*/
				/*echo $user_id;*/
				login($user_id);
			}
		}

	?>
<center>
<form action="index.php" method="POST">
<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-3" >
            <div class="form-login">
            <h4>CONNEXION</h4>
            <input type="text" name="email" placeholder="Email" id="email" class="form-control" value="<?=$email;?>" >
            </br>
            <input type="password" name="password" placeholder="Password" id="password" class="form-control" value="<?=$password;?>" >
            </br>
            <div class="wrapper">
            <span class="group-btn">    
               <input type="submit" value="Login" class="btn btn-primary">
			<input type="hidden" name="idUser"  id="idUser" value="<?=$idUser;?>">
			<a href="registration2.php" class="btn btn-info" role="button">S'enregistrer</a>
			<br>
			<br>
			<a href="motDePasseOublie.php">Mot de Passe oublié?</a>
            </span>
            </div>
            
            </div>
        </div>
    </div>
</div>
</form>
</center>
<?php include 'includes/footer.php';?>