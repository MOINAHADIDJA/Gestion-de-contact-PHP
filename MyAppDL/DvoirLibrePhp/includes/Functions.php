<?php
//fonction pour se connecter
function connexionDB() {
    
    $dburl = "mysql:host=" .host. ";port=" .port. ";charset=utf8;dbname=" .database;
    
    $pdo_options [PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO ( $dburl, user, password, $pdo_options );

    return $bdd;
}


function sanitaze($var)
{
    $r = isset($var) ? htmlspecialchars(trim($var)) : "";

    // TODO : on doit faire ...

    return $r;
}



function sanitizePost($var)
{
    $r = isset($var) ? htmlspecialchars(trim($_POST[$var])) : "";

    // TODO : on doit faire ...

    return $r;
}

function sanitizeGet($var){
    $r = isset($var) ? htmlspecialchars(trim($_GET[$var])) : "";

    // TODO : on doit faire ...

    return $r;
}

function supprimerPhoto($nom){
try {
  return unlink(sanitaze($nom));

} catch (Exception $ex) {
   
    return false;
}


}

/**
 * Cette fonction permet de défint un nom normalisé pour le fichier
 */
function randomizeFileName($file)
{
    $number = rand(1111111111, 9999999999);

    $dateString = 'photo_' . $number . date('Y_m_d_H_i_s_u') . $file;

    return $dateString;
}

/**
 * permet de télécharger (upload) un ficher vers le serveur
 */
function uploadFile($target_dir, $fileToUpload, $extensions, &$fileName)
{
    $uploadOk = true;

    $upperExtensions = [];
    foreach ($extensions as $i) {
        $upperExtensions[] = strtoupper($i);
    }

    // On normalise le nom du fichier
    $fileNameRand = randomizeFileName(basename($_FILES[$fileToUpload]["name"]));
    $fileName = $fileNameRand;
    
    // $target_dir le dossier qui va contenir les fichier
    $target_file = $target_dir . $fileNameRand;

    // Obtenir l'extension du fichiers
    $imageFileType = strtoupper(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérifier que cette extension est acceptable
    if (! in_array($imageFileType, $upperExtensions)) {
        $uploadOk = false;
    }

    // TODO: TRES IMPORTANT : Il reste à vérifier si le fichier est une image ou non
    
    // Vérifier la taille du fichier
    if ($_FILES[$fileToUpload]["size"] > 140906) {

        $uploadOk = false;

    }

    // Si y a pas de problèmes
    
    if ($uploadOk) {

        // Déplacer le fichier vers son emplacement sur le serveur
        $upload = move_uploaded_file($_FILES[$fileToUpload]["tmp_name"], $target_file);

        // On retourne le status de l'upload
        return $upload;
        
    }

    return $uploadOk;
}


