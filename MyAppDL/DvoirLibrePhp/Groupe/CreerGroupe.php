
<title>Creer Groupe | Gestion Contact</title>
</head>
<body class="bg-light ">


<?php
include_once '../includes/menu.php';
require_once '../includes/Functions.php';
require_once '../includes/messagesFunctions.php';
?>
<div class="container mt-2 border border-secondary border border-3 rounded-bottom-3">


<?php

if (isset($_GET['status'])) {
    if (sanitizeGet('status') == 1) {
        echo okMsg(sanitizeGet('msg'));
    } else {
        echo errorMsg(sanitizeGet('msg'));
    }
}

?>





		<form class=" row " action="ProcessGroupe.php" method="POST"
			enctype="multipart/form-data">

			<div class="col-md-12 mt-2">
				<i class="fas fa-user"></i> <label class="form-label">Nom</label> <input
					type="text" name="nom" class="form-control" placeholder="Nom">
			</div>



			<div class="mt-2">
				<i class="fas fa-image"></i> <label class="form-label">Icone(Image)</label>
				<input type="file" accept="image/*" name="photo"
					class="form-control" placeholder="choisirfichier">

			</div>

			<div class="d-flex justify-content-end my-2">

				<button type="reset" class="btn btn-secondary ">Annuler</button>
				<button type="submit" class="btn btn-primary ms-2">enregistrer</button>
			</div>
		</form>
	</div>
</body>
</html>
