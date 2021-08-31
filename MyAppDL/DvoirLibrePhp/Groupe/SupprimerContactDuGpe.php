<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../includes/Functions.php';
require_once '../includes/lien.php';
require_once '../includes/messagesFunctions.php';

if (isset($_GET['id']) && isset($_GET['idC'])) {


try {

    $bd = connexionDB();

    // Enregistrer les données dans la base de données

    $stmt = $bd->prepare("delete from groupecontact where  idContact=:idC and idGroupe=:id");
    $stmt->execute(array(
        "idC"=>sanitizeGet('idC'),
        "id"=>sanitizeGet('id')

    ));

    echo okMsg('Contact bien supprimé du groupe');


} catch (Exception $ex) {
    echo errorMsg('une erreur est survenue');
}
}
