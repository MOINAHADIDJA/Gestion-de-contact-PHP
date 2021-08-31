<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../includes/Functions.php';
require_once '../includes/lien.php';
require_once '../includes/messagesFunctions.php';


if (isset($_GET['id']) && isset($_GET['idC'])) {
    
    try {
        
        $db = connexionDB();
        $searchStmt = $db->prepare("select * from groupecontact where idContact=:idC and idGroupe=:id ");
        $searchStmt->execute(array(
            "idC"=>sanitizeGet('idC'),
            "id"=>sanitizeGet('id')
        ));
        
        if (!empty($searchStmt->fetch())) {
            
            //   echo"contact existe deja";
            header('location: ?id='.sanitizeGet('id').'&status=-1&msg=contact existe déjà au groupe');
            exit();
        }
        else{
            
            
            
            $bd = connexionDB();
            $stmt = $bd->prepare('insert into groupecontact(idContact,idGroupe) values(:idContact,:idGroupe)');
            $stmt->execute(array(
                "idContact"=>sanitizeGet('idC'),
                "idGroupe"=>sanitizeGet('id')
            ));
            header('location: ?id='.sanitizeGet('id').'&status=1&msg=Contact est bien ajouté au groupe');
            exit();
        }
        
    }
    catch (Exception $ex) {
        // echo $ex;
        //On redirige vers le formulaire avec message d'erreur
        header('location:?id='.sanitizeGet('id').'status=-1&msg=Une erreur est survenue. Veuillez Ressayer');
        exit();
        
        
    }
}

if (isset($_GET['status'])) {
    if (sanitizeGet('status') == 1) {
        echo okMsg(sanitizeGet('msg'));
    } else {
        echo errorMsg(sanitizeGet('msg'));
    }
}


if (isset($_GET['id'])) {

try {

   
$bd = connexionDB();
// TODO : Finir ici en affichant que les contact qui n'appartiennent pas au groupe
    $stmt = $bd->prepare("select * from contact");
    // $stmt->execute(array(
    //   "id"=>$id
    // ));
$stmt->execute();

//ob_start();



//$content = ob_get_clean();
//echo $content;
require_once '../includes/menu.php';

?>
 
<title>ListeContact</title>
</head>
<body class="bg-light">
<div class="container mt-2">


  <h4>Liste des contacts à ajouter</h4>
  <table class="table  table-striped">
    <thead><tr><th>photo</th><th>Nom</th><th>Prenom</th><th>Actions</th></tr></thead>
<?php 

    while ($data = $stmt->fetch()) {

			$linkAdd = '<a class="text-decoration-none btn btn-dark " href="?id='.sanitizeGet('id').'&idC='.$data['id'] .'"> Ajouter au Groupe </a>';

     echo '<tr><td><img class="rounded-circle" width="50" height="50" src="'. $APP_UPLOAD_URL .
        $data['photo'] .'"></td><td>' . $data['nom'] . '</td><td>' . $data['prenom'] .'</td><td>' . $linkAdd . '</td></tr>';
    }
    echo '</table>';

		echo '<a href="GererGroupe.php" class="btn btn-primary">Retourner à la liste des groupes</a>';


} catch (Exception $ex) {
//echo $ex;
    //On redirige vers le formulaire avec message d'erreur
     header('location: ?status=-1&msg=Une erreur est survenue. Veuillez Ressayer');
}


}
?>
</div>

</body>
</html>
