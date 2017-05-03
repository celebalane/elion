<?php
$errors = array(); // on crée une vérif de champs
if (!empty($_POST)) {
	if(!array_key_exists('nom', $_POST) || !preg_match("/^[a-zA-Zéè ]*$/",$_POST['nom']) ) {// on verifie l'existence du champ et d'un contenu
  		$errors ['nom'] = "Vous n'avez pas renseigné votre nom";
  	}

	if(!array_key_exists('prenom', $_POST) || !preg_match("/^[a-zA-Zéè ]*$/",$_POST['prenom'])) {
  		$errors ['prenom'] = "vous n'avez pas renseigné votre prénom";
  	}

	if(!array_key_exists('tel', $_POST) || ($_POST['tel'] == '' || !preg_match("`[0-9]{10}`",$_POST['tel']))) { //Vérif que ce soit bien un numéro de tel
	 	$errors ['tel'] = "Veuillez rentrez un numéro valide";
	}

	if(!array_key_exists('mail', $_POST) || $_POST['mail'] == '' || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {// on verifie existence de la clé
  		$errors ['mail'] = "vous n'avez pas renseigné votre email";
  	}

	if(!array_key_exists('message', $_POST) || $_POST['message'] == '') {
  		$errors ['message'] = "vous n'avez pas renseigné votre message";
  	}

	if(isset($_POST["message"])){
  		$message ="Je suis un/une <b>".$_POST["type"]."</b><br/>Mon téléphone est le <b>".$_POST["tel"]."</b><br/>Mon nom est <b>".$_POST["nom"]."</b><br/>Mon prénom est <b>".$_POST["prenom"]."</b><br/><br/>".htmlspecialchars(($_POST["message"]));
	}


 function my_mail($user_mail, $name, $lastname, $message_sujet, $message_html){  //Configuration mail
        
        $mail = new PHPMailer;

        $mail->isSMTP();                                      
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;                               
        $mail->Username = '';               
        $mail->Password = '';                           

        $mail->SMTPSecure = 'ssl';                            
        $mail->Port = 465;                                    
        $mail->setLanguage('fr', '/optional/path/to/language/directory/');

        $mail->setFrom($user_mail, 'Contact Elion');
        $mail->addAddress('', $name.' '.$lastname);
        $mail->addReplyTo($user_mail, $name.' '.$lastname);
        $mail->isHTML(true);                                  

        $mail->Subject = htmlspecialchars($message_sujet);
        $mail->Body    = $message_html;
        $mail->AltBody = $message_html;

        if(!$mail->send()) {
            echo 'Message non envoyé.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
}

//Verifications de la présence d'erreur
  if(!empty($errors)){ 
  	$_SESSION['errors'] = $errors;//on stocke les erreurs
    $_SESSION['inputs'] = $_POST;
  if(isset($_SESSION['success'])){unset($_SESSION['success']);}
  }else{
    if(isset($_SESSION['errors'])){unset($_SESSION["errors"]);}
    if(isset($_SESSION['inputs'])){unset($_SESSION["inputs"]);}
    $_SESSION['success'] = "Votre message a bien été envoyé !";
    
    my_mail($_POST["mail"],$_POST["nom"],$_POST["prenom"],$_POST['sujet'], $message); //Envoi du mail
  }
}
?>
<!--Affichage des indications pour l'envoi-->
<div class="row">
    <?php if(isset($_SESSION["errors"])){ ?>
        <div class="alert alert-danger">
         	<?php foreach ($_SESSION["errors"] as $erreur) {
            	echo $erreur.'<br>';
            } ?>

        </div>
    <?php }elseif(isset($_SESSION["success"])) { ?>
        <div class="alert alert-success">
            <?= $_SESSION["success"] ?>
        </div>
    <?php } ?>
</div>
<div class="row" id="contact">
	<form class="form-horizontal col-md-6 col-md-offset-3 col-xs-12" method="post" action="">
        <h1>Contact</h1>
        <p>Pour tout renseignements supplémentaires ou demande d'accès à notre zone presse veuillez utiliser le formulaire suivant.</p>
        <div class="col-md-6">
        	<div class="form-group">
            	<label for="type" class="col-md-3 control-label">Type</label>
            	<div class="col-sm-9">
              	<select class="form-control" id="type" name="type">
                	<option>Entreprise</option>
                	<option>Particulier</option>
                	<option>Journaliste</option>
              	</select>
            	</div>
        	</div>
        	<div class="form-group">
            	<label for="nom" class="col-md-3 control-label">Nom*</label>
            	<div class="col-md-9">
            		<input type="text" name="nom" value="<?php echo isset($_SESSION['inputs']['nom'])? $_SESSION['inputs']['nom'] : ''; ?>" placeholder="Ex : Dupond" maxlength="30" class="form-control" required />
            	</div>
        	</div>
        	<div class="form-group">
            	<label for="prenom" class="col-md-3 control-label">Prénom*</label>
            	<div class="col-md-9">
            		<input type="text" name="prenom" value="<?php echo isset($_SESSION['inputs']['prenom'])? $_SESSION['inputs']['prenom'] : ''; ?>"  placeholder="Ex : Nicolas" maxlength="30" class="form-control" required />
            	</div>
        	</div>
        	<div class="form-group">
            	<label for="telephone" class="col-md-3 control-label">Tél*</label>
            	<div class="col-md-9">
            		<input class="form-control" type="telephone" name="tel" placeholder="Téléphone"/>
            	</div>
        	</div>
        	<div class="form-group">
            	<label for="mail" class="col-md-3 control-label">Mail*</label>
            	<div class="col-md-9">
              		<input type="email" name="mail" value="<?php echo isset($_SESSION['inputs']['mail'])? $_SESSION['inputs']['mail'] : ''; ?>" placeholder="Ex : dupond@gmail.com" class="form-control" required />
            	</div>
        	</div>
        </div>
        <div class="col-md-6">
        	<div class="form-group">
            	<label for="sujet" class="col-md-3 control-label">Sujet*</label>
            	<div class="col-md-9">
              		<select class="form-control" name="sujet">
                		<option value="Demande de Renseignement">Demande de renseignement</option>
                		<option value="Espace Presse">Accès à l'espace presse</option>
                		<option value="Autre">Autre</option>
              		</select>
            	</div>
        	</div>
        	<div class="form-group">
            	<label for="message" class="col-md-3 control-label">Message*</label>
            	<div class="col-md-9 input-group">
              		<textarea name="message" placeholder="Votre message" maxlength="500" rows="9" class="form-control" required><?php echo isset($_SESSION['inputs']['message'])? $_SESSION['inputs']['message'] : ''; ?></textarea>
            	</div>
        	</div>
        	<!--Bouton envoi-->
        	<div class="form-group">
            	<div class="row">
              		<div class="col-sm-offset-10 col-sm-2 col-xs-offset-7 col-xs-2">
                		<button type="submit" name="envoi" class="btn btn-default">Envoyer</button>
              		</div>
            	</div>
        	</div>
        </div>
    </form>
</div>

<?php
  unset($_SESSION['inputs']); // on nettoie les données précédentes
  unset($_SESSION['success']);
  unset($_SESSION['errors']);
?>