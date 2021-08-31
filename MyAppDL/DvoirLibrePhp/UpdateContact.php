<?php
header('Content-Type: text/html; charset=utf-8');
require_once './includes/lien.php';
require_once 'includes/Functions.php';
require_once './includes/messagesFunctions.php';

if (! empty($_POST)) {

    $nom = sanitaze($_POST['nom']);
    $prenom = sanitaze($_POST['prenom']);
    $telephone1 = sanitaze($_POST['telephone1']);
    $telephone2 = sanitaze($_POST['telephone2']);
    $emailPersonnel = sanitaze($_POST['emailPersonnel']);
    $emailProfessionnel = sanitaze($_POST['emailProfessionnel']);
    $adresse = sanitaze($_POST['adresse']);
    $genre = sanitaze($_POST['genre']);
    $id = sanitaze($_POST['id']);
    $lastPicture = sanitaze($_POST['lastPicture']);

    try {
        $bd = connexionDB();

//         Si l'utilisateur envoie une nouvelle image
        if (!empty($_FILES['photo']["name"])) {
//             On vérifie si le fichier de l'ancienne existe on le supprime
            if (! empty($lastPicture) && file_exists($UPLOAD_DIR . $lastPicture) && ! supprimerPhoto($UPLOAD_DIR . $lastPicture)) {

                // On redirige vers le formulaire avec message d'erreur
                 header('location: GererContact.php?status=-1&msg=Une erreur est survenue! Veuillez ressayer');
                exit();
            } else {

                // Upload du fichier
                $result = uploadFile($UPLOAD_DIR, 'photo', [
                    'PNG',
                    'JPEG',
                    'JPG'
                ], $fileName);


                if ($result) {


                    // Modifie les donnees dans la base de donnees
                    $stmt = $bd->prepare('update contact set nom=:nom, prenom=:prenom, telephone1=:telephone1, telephone2=:telephone2,
                            emailPersonnel=:emailPersonnel, emailProfessionnel=:emailProfessionnel,
                             adresse=:adresse, genre=:genre, photo=:photo where id=:id');

                    $stmt->execute(array(
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'telephone1' => $telephone1,
                        'telephone2' => $telephone2,
                        'emailPersonnel' => $emailPersonnel,
                        'emailProfessionnel' => $emailProfessionnel,
                        'adresse' => $adresse,
                        'genre' => $genre,
                        'id' => $id,
                        'photo' => $fileName
                    ));

                    header('location:GererContact.php?status=1&msg=Contact modifié avec Success');
                } else {

echo "Bonjour";
                    // On redirige vers le formulaire avec message d'erreur
                    header('location: UpdateContact.php?id='.$id .'&status=-1&msg=Le fichier ne peut pas être téléchargé. Contact non modifié');
                }
            }
        } else {
            // Modifie les donnees dans la base de donnees
            $stmt = $bd->prepare('update contact set nom=:nom, prenom=:prenom, telephone1=:telephone1, telephone2=:telephone2,
                            emailPersonnel=:emailPersonnel, emailProfessionnel=:emailProfessionnel,
                             adresse=:adresse, genre=:genre where id=:id');

            $stmt->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,
                'telephone1' => $telephone1,
                'telephone2' => $telephone2,
                'emailPersonnel' => $emailPersonnel,
                'emailProfessionnel' => $emailProfessionnel,
                'adresse' => $adresse,
                'genre' => $genre,
                'id' => $id
            ));

            // On redirige vers la liste des contacts
           header('location:GererContact.php?status=1&msg=Contact modifié avec Success');
        }
    } catch (Exception $ex) {
//echo $ex;
        // On redirige vers le formulaire avec message d'erreur
        header('location:UpdateContact.php?id='.$id .'&status=-1&msg=Une erreur est survenue! Veuillez ressayer');
    }
}

if (isset($_GET['id'])) {
    $id = sanitaze($_GET['id']);

						if (isset($_GET['status'])) {
    if (sanitizeGet('status') == 1) {
        echo okMsg(sanitizeGet('msg'));
    } else {
        echo errorMsg(sanitizeGet('msg'));
    }
}
    try {
        $bd = connexionDB();

        $stmt = $bd->prepare('select  * from contact where id=:id');
        $stmt->execute(array(
            'id' => $id
        ));



        if ($data = $stmt->fetch()) {

            // Afficher les données dans le formulaire


						require_once 'includes/menu.php';


			  ?>

						<title>UpdateContact</title>
						</head>
						<body bg-light>
							<div class=container>

      <form class=" row " action="UpdateContact.php"
			method="POST" enctype="multipart/form-data">

			<!-- Affichage du profile de l'utilisateur -->
			<div class="d-flex align-items-center justify-content-center mt-5">
				<img src="<?php echo $APP_UPLOAD_URL.$data['photo']?>"
					class="w-25 rounded-circle">
			</div>

			<!-- Cacher l'id et le nom de l'image du profile courant du contact  -->
			<input type="hidden" name="id" value="<?php echo $id ?>"> <input
				type="hidden" name="lastPicture" class="form-control"
				value="<?php echo $data['photo']?>">


			<div class="col-md-12 mt-2">
				<i class="fas fa-user"></i> <label class="form-label">Nom</label> <input
					type="text" name="nom" class="form-control" placeholder="Nom"
					value="<?php echo $data['nom']?>">
			</div>
			<div class="col-md-12 mt-2">
				<i class="fas fa-user"></i> <label class="form-label">Prenom</label>
				<input type="text" name="prenom" class="form-control"
					placeholder="Prenom" value="<?php echo $data['prenom']?>">
			</div>
			<div class="col-md-6 mt-2">
				<i class="fas fa-phone-alt"></i> <label class="form-label">Telephone1</label>
				<input type="text" name="telephone1" class="form-control"
					placeholder="Telephone1" value="<?php echo $data['telephone1']?>">
			</div>
			<div class="col-md-6 mt-2">
				<i class="fas fa-phone-alt"></i> <label class="form-label">Telephone2</label>
				<input type="text" name="telephone2" class="form-control"
					placeholder="Telephone2" value="<?php echo $data['telephone2']?>">
			</div>
			<div class="col-md-6 mt-2">
				<i class="fas fa-envelope"></i> <label class="form-label">EmailPersonnel</label>
				<input type="text" name="emailPersonnel" class="form-control"
					placeholder="EmailPersonel"
					value="<?php echo $data['emailPersonnel']?>">
			</div>
			<div class="col-md-6 mt-2">
				<i class="fas fa-envelope"></i> <label class="form-label">EmailProfessionnel</label>
				<input type="text" name="emailProfessionnel" class="form-control"
					placeholder="EmailProfessionnel"
					value="<?php echo $data['emailProfessionnel']?>">
			</div>
			<div class="col-md-12 mt-2">
				<i class="fas fa-address-card"></i> <label class="form-label">Adresse</label>
				<input type="text" name="adresse" class="form-control"
					placeholder="Adresse" value="<?php echo $data['adresse']?>">
			</div>

			<div class="col-md-12 mt-2">
				<i class="fas fa-image"></i> <label class="form-label">Photo</label>
				<input type="file" name="photo" class="form-control">
			</div>



			<div class="mt-2">
				Genre
				<div class="form-check">
					<input class="form-check-input" type="radio" name="genre"
						value="homme"
						checked=" <?php $data['genre']=="homme"?true:false  ?>"> <label
						class="form-check-label"> Homme </label>
				</div>

				<div class="form-check">
					<input class="form-check-input" type="radio" name="genre"
						value="femme"
						checked="<?php $data['genre']=="femme"?true:false  ?>"> <label
						class="form-check-label"> Femme </label>
				</div>
			</div>

			<div class="d-flex justify-content-end mb-2">

				<button type="reset" class="btn btn-secondary ">Annuler</button>
				<button type="submit" class="btn btn-primary ms-2">Modifier</button>
			</div>
		</form>
        <?php
        } else {
            echo "<h1>Le contact que vous cherchez à modifier n'existe pas</h1> ";
        }
    } catch (Exception $ex) {}
}
?>
</div>
</body>

</html>
