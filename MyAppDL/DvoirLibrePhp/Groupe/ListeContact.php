
<?php
  require_once '../includes/Functions.php';
  include_once '../includes/menu.php';
 require_once '../includes/lien.php';
  require_once '../includes/messagesFunctions.php';
 


  if (isset($_GET['status'])) {
      if (sanitizeGet('status') == 1) {
          echo okMsg(sanitizeGet('msg'));
      } else {
          echo errorMsg(sanitizeGet('msg'));
      }
  }

  ?>

<div class="container mt-2">

<h3 >La liste des contacts appartenant au groupe</h3>

<form class="row mb-3" action="" method="GET" >
  <div class="col-md-4 col-6 ">



<?php


try {

    $bd = connexionDB();

    $stmt = $bd->prepare('select * from groupe' );
    $stmt->execute();
?>

<select class="select" name="id">


<?php

    while($data = $stmt->fetch()){

   ?>

  <option class="form-check-label" for="flexCheckDefault" value="<?= $data['id'] ?>"  <?php echo (sanitizeGet('id')== $data['id'])? 'selected="selected"':'';?>">
   <?php echo $data['nom']?>
 </option>



<?php }
} catch (Exception $ex) {
}
?>
</select>


    <button type="submit" class="btn btn-outline-success ms-2 btn-sm">Rechercher</button>
  </div>

</form>


<?php


if (isset($_GET['id'])) {
try {
    $bd = connexionDB();

  $stmt = $bd->prepare('select c.* from contact c, groupecontact gc where gc.idContact=c.id and gc.idGroupe=:id');
$stmt->execute(array(
  "id"=>sanitizeGet('id')
));


    echo '<table class="table table-striped ">';
    echo '<thead><tr><th>photo</th><th>Nom</th><th>Prenom</th><th>Actions</th></tr></thead>';

    while ($data = $stmt->fetch()) {
                $linkDel = '<a class="text-decoration-none btn btn-danger" style="width: 120px;" href="SupprimerContactDuGpe.php?id='.sanitizeGet('id').'&idC='.$data['id'] . '"> Supprimer </a></boutton>';        
       
        $var='<button type="button" class="btn btn-primary  mb-2" style="width: 120px;" data-bs-toggle="modal" data-bs-target="#exampleModal'.$data['id'].'">
        Details</button>
<div class="modal fade" id="exampleModal'.$data['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<img class="rounded-circle " width="80" height="80" src="'. $APP_UPLOAD_URL .$data['photo'] .'">
</div>
<ul class="list-unstyled ">
    
<li class="mb-2"> <span class="me-2 fw-bold"> Nom :</span>' . $data['nom'] .'</li>
<li class="mb-2"> <span class="me-2 fw-bold" > Prenom :</span>' . $data['prenom'] .'</li>
<li class="mb-2"> <span class="me-2 fw-bold"> Tel1 :</span>' . $data['telephone1'] . '</li>
<li class="mb-2"> <span class="me-2 fw-bold"> Tel2 :</span>' . $data['telephone2'] .'</li>
<li class="mb-2"> <span class="me-2 fw-bold"> EmailPersonnel :</span>' . $data['emailPersonnel'] . '</li>
<li class="mb-2"> <span class="me-2 fw-bold"> EmailProfessionnel :</span>' . $data['emailProfessionnel'] . '</li>
<li class="mb-2"> <span class="me-2 fw-bold"> Adresse :</span>' . $data['adresse'] . '</li>
<li class="mb-2"> <span class="me-2 fw-bold"> Genre :</span>' . $data['genre'] . '</li>
</ul>
</div>
<div class="modal-footer bg-dark">
<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
<a class="text-decoration-none  btn btn-success" href="../UpdateContact.php?id=' . $data['id'] . '"> Modifier </a>
</div>
</div>
</div>
</div> ';     

        echo '<tr><td><img class="rounded-circle" width="50" height="50" src="'. $APP_UPLOAD_URL .
        $data['photo'] .'"></td><td>' . $data['nom'] . '</td><td>' . $data['prenom'] .'</td><td>'.$var.'<br>'.$linkDel.'</td></tr>';
        
    }
    echo '</table>';


    echo '<a href="GererGroupe.php" class="btn btn-primary">Retourner à la liste des groupes</a>';
} catch (Exception $ex) {
    //On redirige vers le formulaire avec message d'erreur
    header('location: ?status=-1&msg=Une erreur est survenue. Veuillez Ressayer');


}


}
 ?></div>
</body>
</html>
