<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'includes/Functions.php';
require_once 'includes/lien.php';
// Recuperer les donnees
$nom = sanitaze($_POST['nom']);
$prenom = sanitaze($_POST['prenom']);
$telephone1 = sanitaze($_POST['telephone1']);
$telephone2 = sanitaze($_POST['telephone2']);
$emailPersonnel= sanitaze($_POST['emailPersonnel']);
$emailProfessionnel= sanitaze($_POST['emailProfessionnel']);
$adresse=sanitaze($_POST['adresse']);
$genre=sanitaze($_POST['genre']);


try {
    $bd=connexionDB();
    
   //  Upload du fichier
    $result = uploadFile($UPLOAD_DIR, 'photo', [
    'PNG',
   'JPEG',
   'JPG'
   ], $fileName);


    if ($result) {

    // enregistrer les donnees dans la base de donnees
    $stmt = $bd->prepare('INSERT into contact(nom, prenom, telephone1, telephone2,emailPersonnel,emailProfessionnel,adresse,genre,photo)
                                 values ( :nom, :prenom, :telephone1, :telephone2, :emailPersonnel, :emailProfessionnel, :adresse, :genre, :photo)');
    $stmt->execute(array('nom'=>$nom,
        'prenom'=> $prenom ,
        'telephone1'=> $telephone1,
        'telephone2'=> $telephone2,
        'emailPersonnel'=> $emailPersonnel,
        'emailProfessionnel'=> $emailProfessionnel, 
        'adresse'=> $adresse, 
        'genre'=> $genre,
        'photo'=> $fileName
    ) );
    
    
  

    header('location:GererContact.php?status=1&msg=Contact Cree avec Success');
    exit;
    ;
    } else {
        
        //On redirige vers le formulaire avec message d'erreur
        header('location: CreerContact.php?status=-1&msg=Le fichier ne peut pas être téléchargé! Contact Non enregistré');
        exit;
    }
} catch (Exception $ex) {
    //On redirige vers le formulaire avec message d'erreur
    header('location: CreerContact.php?status=-1&msg=Une erreur est survenue');
  
    exit;
    
}

