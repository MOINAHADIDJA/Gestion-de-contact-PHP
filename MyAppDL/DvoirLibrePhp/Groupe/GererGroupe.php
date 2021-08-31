<?php
header('Content-Type: text/html; charset=utf-8');

// fonction pour se connecter
require_once '../includes/Functions.php';
require_once '../includes/lien.php';
require_once '../includes/messagesFunctions.php';

if (isset($_GET['status'])) {
    if (sanitizeGet('status') == 1) {
        echo okMsg(sanitizeGet('msg'));
    } else {
        echo errorMsg(sanitizeGet('msg'));
    }
}

try {

    $bd = connexionDB();

    if (isset($_GET['id'])) {
        $id = sanitizeGet('id');
				$stmt = $bd->prepare("select image from groupe where id=:id ");
				$stmt->execute(array(
					"id"=>$id
				));

				$image = $stmt->fetch()['image'];

				if (!empty($image)) {


				$isDeleted = supprimerPhoto($UPLOAD_DIR.$image);
				if ($isDeleted) {


        $stmt = $bd->prepare('delete from groupe where id=:id ');
        $stmt->execute(array(
            'id' => $id
        ));

				$stmt = $bd->prepare('delete from groupecontact where idGroupe=:id ');
        $stmt->execute(array(
            'id' => $id
        ));
					}

					else {
						 header('location: ?status=-1&msg=Une erreur est survenue. Veuillez Ressayer');

					}
					}
    }
    if (isset($_GET['recherche'])) {
			$nom = sanitizeGet('recherche');
        $stmt = $bd->prepare("select * from groupe where nom LIKE '%$nom%'");
$stmt->execute();


    } else {

        $stmt = $bd->prepare('select * from groupe');
        $stmt->execute();
    }

    include_once '../includes/menu.php';
     ?>

    <title>Gerer Groupe | Gestion Contact</title>
    </head>
    <body>
    <div class="container mt-2">

    		<form action="GererGroupe.php" method="GET">
    			<input type="text" name="recherche" placeholder="Rechercher nom" value="" class="p-1">
    			<button class="btn btn-outline-success" type="submit" >Recherche</button>
    		</form>

<?php

    echo '<table class="table table-striped table-hover mt-2">';
    echo '<thead><tr><th>photo</th><th>Nom</th><th>Actions</th></tr></thead>';

    while ($data = $stmt->fetch()) {

        $linkDel = '<a class="btn btn-danger text-decoration-none mb-2"  style="width: 120px;" href="GererGroupe.php?id=' . $data['id'] . '"> Supprimer </a>';
				$linkAdd = '<a class="btn btn-dark text-decoration-none mb-2"  style="width: 120px;"href="AjoutContactAgroupe.php?id=' . $data['id'] . '"> Ajouter Contact </a>';
				$linkList = '<a class=" btn btn-secondary text-decoration-none"  style="width: 120px;" href="ListeContact.php?id=' . $data['id'] . '"> Voir Contacts </a>';


				echo '<tr><td><img class="rounded-circle" width="50" height="50" src="'. $APP_UPLOAD_URL .$data['image'] .'"></td><td>' . $data['nom'] .'</td><td>'.$linkDel  . '<br>'.$linkAdd.'<br>'.$linkList.'</td></tr>';
    }
    echo '</table>';
} catch (Exception $ex) {

    //On redirige vers le formulaire avec message d'erreur
		echo $ex;
    header('location: ?status=-1&msg=Une erreur est survenue. Veuillez Ressayer');


}
?>
</div>

</body>
</html>
