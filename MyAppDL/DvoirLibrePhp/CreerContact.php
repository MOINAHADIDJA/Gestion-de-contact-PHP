
<title>CreerContact</title>
</head>
<body class="bg-light ">
<?php
include_once 'includes/menu.php';
require_once 'includes/Functions.php';
require_once 'includes/messagesFunctions.php';
 ?>
<div class="container mt-2 border border-secondary border border-3 rounded-bottom-3">

 <?php 
 if (isset($_GET['status'])) {
     if (sanitizeGet('status') == 1) {
         echo okMsg('Le participant a été bien ajouté');
     } else {
         echo errorMsg(sanitizeGet('msg')); 
         
     }
 }
 
 ?>





<form class=" row " action="ProcessForm.php" method="POST" enctype="multipart/form-data"  >
      
     <div class="col-md-12 mt-2">
     <i class="fas fa-user"></i>
    <label class="form-label">Nom</label>
    <input type="text" name="nom" class="form-control" placeholder="Nom" >
    </div>
    <div class="col-md-12 mt-2">
    <i class="fas fa-user"></i>
     <label class="form-label">Prenom</label>
    <input type="text" name="prenom" class="form-control" placeholder="Prenom" >
    </div>
    <div class="col-md-6 mt-2">
    <i class="fas fa-phone-alt"></i>
    <label class="form-label">Telephone1</label>
    <input type="text" name="telephone1" class="form-control" placeholder="Telephone1" >
    </div>
    <div class="col-md-6 mt-2">
    <i class="fas fa-phone-alt"></i>
    <label class="form-label">Telephone2</label>
    <input type="text" name="telephone2" class="form-control" placeholder="Telephone2" >
    </div>
    <div class="col-md-6 mt-2">
    <i class="fas fa-envelope"></i>
    <label class="form-label">EmailPersonnel</label>
    <input type="text" name="emailPersonnel" class="form-control" placeholder="EmailPersonel" >
    </div>
    <div class="col-md-6 mt-2">
    <i class="fas fa-envelope"></i>
    <label class="form-label">EmailProfessionnel</label>
    <input type="text" name="emailProfessionnel" class="form-control" placeholder="EmailProfessionnel" >
    </div>
    <div class="col-md-12 mt-2">
    <i class="fas fa-address-card"></i>
    <label class="form-label">Adresse</label>
    <input type="text" name="adresse" class="form-control" placeholder="Adresse" >
 </div>
 <div class="mt-2">
  <i class="fas fa-image"></i>
 <label class="form-label">Photo</label>
    <input type="file" accept="image/*" name="photo" class="form-control" placeholder="choisirfichier" >
 
  </div>
  
 <div class="mt-2">
 Genre
  <div class="form-check">
  <input class="form-check-input" type="radio" name="genre" value="homme">
  <label class="form-check-label" >
    Homme
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="radio" name="genre" value="femme">
  <label class="form-check-label" >
    Femme
  </label>
</div>
  </div>
  
 
  <div class="d-flex justify-content-end mb-2">

    <button type="reset" class="btn btn-secondary ">Annuler</button>
    <button type="submit" class="btn btn-primary ms-2">enregistrer</button>
  </div>
  </form>
</div>
</body>
</html>