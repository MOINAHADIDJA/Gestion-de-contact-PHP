<?php 

require_once 'lien.php'

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark
         ">
	<div class="container-fluid ms-4">
    <a class="navbar-brand" href="#"></a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
			data-bs-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse"

		id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 " >


				<li class="nav-item"><a class="nav-link"
					href="<?php echo $APP_URL.'CreerContact.php'?>">Ajouter Contact</a></li>
				<li class="nav-item"><a class="nav-link"
					href="<?php echo $APP_URL.'GererContact.php'?>">Gerer Contact</a></li>
          <li class="nav-item"><a class="nav-link"
  					href="<?php echo $APP_URL.'Groupe/CreerGroupe.php'?>">Ajouter Groupe</a></li>
            <li class="nav-item"><a class="nav-link"
              href="<?php echo $APP_URL.'Groupe/GererGroupe.php'?>">Gerer Groupe</a></li>
</ul>

		</div>
	</div>
</nav>
