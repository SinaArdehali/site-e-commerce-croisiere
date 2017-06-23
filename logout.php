<?php   
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
echo "<script>alert('Vous êtes déconnecté. Vous allez être redirigé vers la page de connexion. A bientot')</script>";
/*header("location:/index.php");*/ //to redirect back to "index.php" after logging out
echo "<script>location.assign('index.php')</script>";
exit();
?>