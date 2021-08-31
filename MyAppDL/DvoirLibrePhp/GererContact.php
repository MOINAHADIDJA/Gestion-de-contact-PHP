<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'includes/Functions.php';
require_once 'includes/lien.php';
require_once 'includes/messagesFunctions.php';



try {

    $bd = connexionDB();

    if (isset($_GET['id'])) {
        $id = sanitizeGet('id');

        $stmt = $bd->prepare("select photo from contact where id=:id ");
        $stmt->execute(array(
            "id"=>$id
        ));

				$image = $stmt->fetch()['photo'];

				if (!empty($image)) {

				$isDeleted = supprimerPhoto($UPLOAD_DIR.$image);
								if ($isDeleted) {

					$stmt = $bd->prepare('delete from contact where id=:id ');
	                $stmt->execute(array(
	            'id' => $id
	                ));
	                
	                header('location: ?status=1&msg=Contact supprimé avec Succès');

					}

					else {
						header('location: ?status=-1&msg=Une erreur est survenue. Veuillez Ressayer');

					}
				}
    }
    if (isset($_POST['selection']) && sanitizePost('selection') != null && sanitizePost('selection') == "nom" && sanitizePost('recherche') != null) {
        $nom = sanitizePost('recherche');
        $stmt = $bd->prepare("select * from contact where nom LIKE '$nom%'");

        $stmt->execute();

    } else if (isset($_POST['selection']) && sanitizePost('selection') != null && sanitizePost('selection') == "tel") {
        $tel = sanitizePost('recherche');
        $stmt = $bd->prepare("select * from contact where telephone1 LIKE '$tel%' OR telephone2 LIKE '$tel%'");
        $stmt->execute();


    } else {

        $stmt = $bd->prepare('select * from contact');
        $stmt->execute();
    }
    $datas =  $stmt->fetchAll();

    $groups = [];
    foreach ($datas as $data ) {

        $stmtgrp = $bd->prepare('select nom from groupe g, groupecontact gc where gc.idGroupe=g.id and gc.idContact=:id');
        $stmtgrp->execute(array(
            'id' => $data['id']
        ));

        //On récupère ses groupes
        $stmtgrp->execute();
        $groupes= "";
        while($datagrp = $stmtgrp->fetch()){
            $groupes.='<li>'. $datagrp['nom'].'</li>';
        }

        array_push($groups,$groupes);

        include_once 'includes/menu.php';

        }

} catch (Exception $ex) {

    //On redirige vers le formulaire avec message d'erreur
    header('location: ?status=-1&msg=Une erreur est survenue. Veuillez Ressayer');


}

if (isset($_GET['status'])) {
    if (sanitizeGet('status') == 1) {
        echo okMsg(sanitizeGet('msg'));
    } else {
        echo errorMsg(sanitizeGet('msg'));
    }
}

require_once './includes/menu.php';
?>

        <title>GererContact</title>
</head>
<body class="bg-light ">
        <div class="container mt-2">

        <form action="<?php echo $APP_URL.'GererContact.php'?>" method="POST">
        <select name="selection" class="p-1">
        <option value="nom" selected>Rechercher par nom</option>

        <option value="tel">par telephone</option>
        </select> <input type="text" name="recherche" value="" class="p-1">
        <button class="btn btn-outline-success " type="submit">Recherche</button>
        </form>


     <table class="table table-striped table-hover ">
      <thead><tr><th>photo</th><th>Nom</th><th>Prenom</th><th>Actions</th></tr></thead>

<?php
$i=0;
foreach($datas as $data){
        $linkDel = '<a class="text-decoration-none btn btn-danger" style="width: 120px;" href="GererContact.php?id=' . $data['id'] . '"> Supprimer </a></boutton>';
        $linkUpdate = '<a class="text-decoration-none text-white btn btn-success my-2" style="width: 120px;" href="UpdateContact.php?id=' . $data['id'] . '"> Modifier </a>';
?>

        <tr><td><img class="rounded-circle" width="50" height="50" src="<?= $APP_UPLOAD_URL .
        $data['photo'] ?> "></td>
        <td>
<?= $data['nom']  ?>

        </td>
        <td>
          <?= $data['prenom']  ?>
        </td>
        <td>

      <button type="button" class="btn btn-primary mb-2" style="width: 120px;" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $data['id'] ?>">
        Details</button>
<div class="modal fade" id="exampleModal<?= $data['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
<div class="modal-content">
<div class="modal-header bg-dark ">
<h5 class="modal-title" id="exampleModalLabel">Les informations du contact</h5>
<button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
 <i class="fas fa-window-close text-white fa-2x"></i>
</button>
</div>
  <div class="modal-body">

<div class="d-flex justify-content-center">
<img class="rounded-circle " width="80" height="80" src="<?= $APP_UPLOAD_URL.$data['photo'] ?>">
</div>
<ul class="list-unstyled ">

<li class="mb-2"> <span class="me-2 fw-bold"> Nom :</span><?= $data['nom'] ?></li>
<li class="mb-2"> <span class="me-2 fw-bold" > Prenom :</span><?php echo  $data['prenom'] ;?></li>
<li class="mb-2"> <span class="me-2 fw-bold"> Tel1 :</span><?php echo $data['telephone1'] ;?></li>
<li class="mb-2"> <span class="me-2 fw-bold"> Tel2 :</span><?php echo $data['telephone2'];?></li>
<li class="mb-2"> <span class="me-2 fw-bold"> EmailPersonnel :</span><?=  $data['emailPersonnel'] ?></li>
<li class="mb-2"> <span class="me-2 fw-bold"> EmailProfessionnel :</span><?= $data['emailProfessionnel'] ?></li>
<li class="mb-2"> <span class="me-2 fw-bold"> Adresse :</span><?php echo $data['adresse'];?></li>
<li class="mb-2"> <span class="me-2 fw-bold"> Genre :</span><?= $data['genre'] ?></li>
<li class="mb-2 "> <b>Groupes</b> :<ul><?php echo $groups[$i];?> </ul></li>
</ul>
</div>
<div class="modal-footer bg-dark">
<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
<a class="text-decoration-none  btn btn-success" href="UpdateContact.php?id=<?php echo $data['id'];?>"> Modifier </a>
</div>
</div>
</div>
</div>

        <br>
        <?php echo $linkUpdate.'<br>'. $linkDel; ?>
        </td>
        </tr>

</div>
<?php 
$i++;
} ?>
</body>
</html>