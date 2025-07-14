<?php
require('../inc/fonctions.php');
session_start();

if (!isset($_GET['id_obj'])) {
    header("Location: listes_obj.php");
    exit();
}

$id_objet = intval($_GET['id_obj']);
$obj = get_object_by_id($id_objet);
$images = get_images_by_object_id($id_objet);
$historique = get_emprunts_by_object_id($id_objet);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fiche de l'objet</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand" href="#">Fiche objet</a>
    <a href="listes_obj.php" class="btn btn-outline-secondary">Retour à la liste</a>
  </div>
</nav>

<div class="container py-4">
  <?php if ($obj): ?>
    <div class="row mb-4">
      <div class="col-md-6">
        <img src="../uploads/<?php echo $obj['image'] ?? 'placeholder.jpg'; ?>" class="img-fluid rounded shadow-sm" alt="Image principale">
      </div>
      <div class="col-md-6">
        <h3><?php echo htmlspecialchars($obj['nom_objet']); ?></h3>
        <p><strong>Catégorie :</strong> <?php echo htmlspecialchars(get_category_name($obj['id_categorie'])); ?></p>
        <p><strong>Propriétaire :</strong> <?php echo htmlspecialchars(get_owner_name($obj['id_membre'])); ?></p>
      </div>
    </div>

    <?php if (mysqli_num_rows($images) > 0): ?>
      <h5 class="mb-3">Autres images :</h5>
      <div class="row g-3 mb-4">
        <?php while ($img = mysqli_fetch_assoc($images)) { ?>
          <div class="col-4 col-md-2">
            <img src="../uploads/<?php echo $img['nom_image']; ?>" class="img-fluid rounded shadow-sm" alt="Autre image">
          </div>
        <?php } ?>
      </div>
    <?php endif; ?>

    <h5>Historique des emprunts :</h5>
    <?php if (mysqli_num_rows($historique) > 0): ?>
      <ul class="list-group">
        <?php while ($hist = mysqli_fetch_assoc($historique)) { ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <?php echo get_membre_nom($hist['id_membre']); ?>
            <span class="badge bg-primary">
              <?php echo $hist['date_emprunt'] . ' → ' . $hist['date_retour']; ?>
            </span>
          </li>
        <?php } ?>
      </ul>
    <?php else: ?>
      <p class="text-muted">Aucun historique d’emprunt trouvé.</p>
    <?php endif; ?>

  <?php else: ?>
    <div class="alert alert-danger">Objet introuvable.</div>
  <?php endif; ?>
</div>

</body>
</html>
