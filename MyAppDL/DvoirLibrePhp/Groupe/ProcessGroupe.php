<?php


require_once '../includes/Functions.php';
require_once '../includes/messagesFunctions.php';
require_once '../includes/lien.php';




try {
    $bd=connexionDB();

   //  Upload du fichier
    $result = uploadFile($UPLOAD_DIR, 'photo', [
    'PNG',
   'JPEG',
   'JPG'
   ], $fileName);



    if ($result) {
    if (! empty($_POST)) {
        $image =$_FILES;
        $nom = sanitizePost('nom');

        $db = connexionDB();

        $searchStmt = $db->prepare("select * from groupe where nom=:nom ");
        $searchStmt->execute(array(
          "nom"=>$nom
        ));

        if ($searchStmt->fetchAll()==NULL) {
          $stmt = $db->prepare("INSERT INTO groupe(nom,image) values(:nom,:image)");

          $stmt->execute(array(
              "nom" => $nom,
              "image" => $fileName
          ));

          header('location:CreerGroupe.php?status=1&msg=Nouveau Groupe créé');

          exit();
        }
        else {
            header('location:CreerGroupe.php?status=-1&msg=Groupe existe déjà');
            exit();
        }


    }
  }
 else {

    //On redirige vers le formulaire avec message d'erreur
    header('location: CreerGroupe.php?status=-1&msg=Le fichier ne peut pas être téléchargé! Groupe Non Créé');
    exit;
}
} catch (Exception $e) {

  echo $e;
    // header('location:CreerGroupe.php?status=-1&msg=Une erreur est survenue');
    exit();
}
