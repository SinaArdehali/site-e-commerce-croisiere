<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/CPTBrouillon/core/init.php';
include 'includes/head.php';
$password = 'password';
$hashed = password_hash($password,PASSWORD_DEFAULT);
echo $hashed;
?>

<?php include 'includes/footer.php'; ?>