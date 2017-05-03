<?php
use Core\Auth\DBAuth;
$app2 = App::getInstance();
$auth2 = new DBAuth($app2->getDb());

if ($auth2->logged()) {
	header('location: admin.php');
}

?>
<div class="row" id="login">
	<div class="col-md-12">
		<h1>Espace presse</h1>
		<p>Pour acceder à l'espace presse, veuillez vous connecter</p>
	</div>
	<form method="post" action="admin.php" class="col-md-offset-4 col-md-4">
		<label>Identifiant</label>
		<input class="form-control" type="text" name="username" placeholder="Nom d'utilisateur">
		<label>Mot de passe</label>
		<input class="form-control" type="password" name="password" placeholder="Mot de passe">
		<input class="btn btn-primary col-md-offset-5" type="submit">
	</form>
</div>