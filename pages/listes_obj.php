<?php 
require('../inc/fonctions.php');
session_start();
$global_obj = get_all_object();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Liste des objets</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
      <a class="navbar-brand" href="#">Objets à emprunter</a>
      <div class="d-flex">
        <a href="filtrage.php" class="btn btn-outline-info">Filtrer par catégorie</a>
      </div>
    </div>
  </nav>

  <div class="container py-4">
    <h2 class="text-center mb-4">Liste des objets disponibles</h2>
    
    <?php if (mysqli_num_rows($global_obj) > 0): ?>
      <div class="row g-4">
        <?php while ($global = mysqli_fetch_assoc($global_obj)) { ?>
          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <img src="../uploads/<?php echo $global['image'] ?? 'placeholder.jpg'; ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Image de l'objet">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?php echo htmlspecialchars($global['nom_objet']); ?></h5>
                <?php 
                $detail = get_all_object_emprunter($global['id_objet']); 
                if ($detail_data = mysqli_fetch_assoc($detail)) {
                ?>
                  <p class="card-text text-muted mb-2">Date de retour : <?php echo htmlspecialchars($detail_data['date_retour']); ?></p>
                <?php } ?>
                <a href="#" class="btn btn-outline-primary mt-auto">Voir plus</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php else: ?>
      <div class="alert alert-info text-center">Aucun objet trouvé.</div>
    <?php endif; ?>
  </div>

</body>
</html>
