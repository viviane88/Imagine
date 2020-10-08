<?php
//demarrage de la session
session_start();

//Si il y a un utilisateur connecté, on le redirige vers la page d'accueil
if(isset($_SESSION['user'])) {
	header('Location: index.php'); 
}

//Je déclare une variable d'erreur que je pourrais remplir à ma guise et que j'afficherai dans le html si elle est remplie
$erreur = null;

//Je verifie que des données ont été envoyées
if(isset($_POST['inscription'])) {
	//Je récupère les informations du formulaire
	$civility = isset($_POST['civilite'])? (int) $_POST['civilite'] : null;
	$firstname = (string) ($_POST['prenom'] ?? '');
	$lastname = (string) ($_POST['nom'] ?? '');
	$email = (string) ($_POST['email'] ?? '');
	$password =  (string) $_POST['mot_de_passe'] ?? '';
	$know_us = (int) ($_POST['connaissance'] ?? false);
	$gdpr = (bool) ($_POST['rgpd'] ?? false);

	//Pour aller plus loin, je vérifie qu'il n'y a pas d'erreurs (champs vides ou mal renseignés)
	if(empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
		$erreur = 'Veuillez remplir tous les champs avec un *';
	} 
	else if(!$gdpr) {
		$erreur = 'Veuillez accepter l\'utilisation de vos informations';
	} 
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$erreur = 'L\'email n\'est pas au bon format';
	} else {
		//Vérifier si une adresse email n'existe pas déjà
		//On pourrait aller plus loin comme tranformer le mot de passe en hash

		//Si il n'y a pas d'erreur je peux procéder à l'enregistrement de l'utilisateur dans la base de données
		//je me connecte d'abord a la base de données
		$db = mysqli_connect("localhost", "root", "root", "formations_philiance_dwwm3_td-app");
		if(!$db) {
			$erreur = 'Impossible de se connecter à la base de données';
		} else {
			//Ensuite j'insère mes données avec du SQL mais avant j'échappe les guillemets qui pourrait être nuisible pour ma requête SQL
			$firstname = mysqli_real_escape_string($db,$firstname);
			$lastname = mysqli_real_escape_string($db,$lastname);
			$email = mysqli_real_escape_string($db,$email);
			$password = mysqli_real_escape_string($db,$password);

			//Je hash le password, je créé alors une empreinte que je vais enregistré en base de données plutôt que d'enregistré le mot de passe en clair
			$hash_password = hash('sha256',$password);

			$result = mysqli_query ($db,"
				INSERT INTO users (lastname, firstname, civility, email, password, gdpr, know_us)
				VALUES ('$lastname', '$firstname', $civility, '$email', '$hash_password', $gdpr, $know_us)
			");
			if($result == false) {
				$erreur = "Echec lors de l'insertion des données : ($db->errno) $db->error";
			} else {
				//on redirige sur la page de connection
				header('Location: connexion.php');
			}
		}
		mysqli_close($db);
	}
}
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Imagine! - Inscription</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
</head>
<body>
	<header class="p-5">
		<h1 class="text-center">Trouvez l'inspiration</h1>
	</header>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="form border p-4 rounded">
					<form action="inscription.php" method="post" action="application/x-www-form-urlencoded">
						 <div class="form-group">
						 	<?php 
						 		if(!empty($erreur)):
						 	 ?>
						 	 	<p class="alert alert-danger">
						 	 		<?= $erreur ?>
						 	 	</p>
						 	<?php endif; ?>
						  	<label class="mr-2">Civilité<sup>*</sup> : </label>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="homme" name="civilite" value="1" class="custom-control-input">
								<label class="custom-control-label" for="homme">Homme</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="femme" name="civilite" value="0" class="custom-control-input">
								<label class="custom-control-label" for="femme">Femme</label>
							</div>
						  </div>
						  <div class="form-row">
						  	<div class="form-group col-md-6">
								<label for="nom">Nom<sup>*</sup></label>
								<input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom">
							</div>
						  	<div class="form-group col-md-6">
								<label for="prenom">Prénom<sup>*</sup></label>
								<input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prénom">
							</div>
						  </div>
						  <div class="form-row">
							  <div class="form-group col-md-6">
							    <label for="email">Adresse email<sup>*</sup></label>
							    <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email">
							    <small class="form-text text-muted">Nous ne la partagerons à personne</small>
							  </div>
							  <div class="form-group col-md-6">
							    <label for="password">Mot de passe<sup>*</sup></label>
							    <input type="password" class="form-control" id="password" name="mot_de_passe" placeholder="Entez votre mot de passe">
							  </div>
						 </div>
						 <div class="form-group">
							<label for="connaissance">Comment nous avez vous connu ?</label>
							<select name="connaissance" class="custom-select mr-sm-2" id="connaissance">
						        <option selected disabled>Choisissez une option</option>
						        <option value="1">Par les moteurs de recherche</option>
						        <option value="2">Par le bouche à oreille</option>
						        <option value="3">Par une publicité</option>
						    </select>
						</div>
						  <div class="form-group form-check">
						    <input type="checkbox" name="rgpd" value="1" class="form-check-input" id="rgpd">
						    <label class="form-check-label" for="rgpd">En soumettant ce formulaire j'accepte que mes informations soient utilisées dans le cadre de l'utilisation normale du service et de la relation commerciale</label>
						  </div>
						<div class="text-center">
						  <button type="submit" name="inscription" value="1" class="btn btn-primary">Je m'inscris</button><br/><br/>
						  <small>Déjà inscris ? <a href="connexion.php">Connectez-vous</a></small>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>