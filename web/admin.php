<?php

use Core\Auth\DBAuth;

define('ROOT', dirname(__DIR__));
require ROOT.'/app/App.php';
App::load();

if (isset($_GET['p'])) {
	$page = $_GET['p'];
}else{
	$page = "presse";
}

$app = App::getInstance();
$auth = new DBAuth($app->getDb());

//connexion utilisateur via login.php
if ($_POST) {
	if (isset($_POST['username'], $_POST['password'])) {
		if ($auth->login($_POST['username'], $_POST['password'])) {
			header('location: index.php?p=presse');
		}else{
			header('location: index.php?p=login');
			exit();
		}
	}
}
//fin connexion utilisateur via login.php

if (!$auth->logged()) {
	$app->forbidden();
}

$connect = "Disconnect";

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
}elseif($page==='presse'){
	require ROOT.'/pages/presse.php';
}
else{
	require ROOT.'/pages/errors/404.php';
}
$content = ob_get_clean();
require ROOT.'/pages/templates/presseTemplate.php'; 