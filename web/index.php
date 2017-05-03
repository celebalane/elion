<?php

use Core\Auth\DBAuth;
define('ROOT', dirname(__DIR__));
require ROOT.'/app/App.php'; // permet l'absolute
App::load();

if (isset($_GET['p'])) {
	$page = $_GET['p'];
}else{
	$page = "home";
}

//////////////bouton connect 
$app = App::getInstance();
$auth = new DBAuth($app->getDb());
if ($auth->logged()) {
	$connect = "Disconnect";
}else{
	$connect = "login";
}
/////////////////////////

ob_start();
if ($page==='home') {  // Charge centre page (content)
	require ROOT.'/pages/index.php';
}elseif($page==='presentation'){
	require ROOT.'/pages/presentation.php';
}elseif($page==='vehicule'){
	require ROOT.'/pages/vehicule.php';
}elseif($page==='contact'){
	require ROOT.'/pages/contact.php';
}elseif($page==='form'){
	require ROOT.'/pages/form.php';
}elseif ($page==='login') {
	require ROOT.'/pages/users/login.php';
}elseif ($page==='disconnect') {
	require ROOT.'/pages/users/disconnect.php';
}elseif ($page==='presse'){
	require ROOT.'/pages/presse.php';
}elseif ($page==='403') {
	require ROOT.'/pages/errors/403.php';
}elseif ($page==='404') {
	require ROOT.'/pages/errors/404.php';
}
$content = ob_get_clean(); // Le template

if($page==='home'){
	require ROOT.'/pages/templates/accueilTemplate.php';
}elseif($page==='presse'){
	require ROOT.'/pages/templates/presseTemplate.php';
}else{
	require ROOT.'/pages/templates/default.php'; 
}