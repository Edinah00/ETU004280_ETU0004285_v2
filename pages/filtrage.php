<?php
require('../inc/fonctions.php');

$result = null;

if (!empty($_GET['dept'])) {
    $result = get_all_object_per_category($_GET['dept']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Filtrage par catégorie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Filtrage des objets</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="listes_obj.php">Retour à l'accueil</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-3">Filtrer les objets par catégorie</h2>
        <form method="GET" class="mb-4 p-3 border rounded bg-light">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="dept" class="form-label">Catégorie :</label>
                    <select name="dept" id="dept" class="form-select">
                        <option value="">--Choisir une catégorie--</option>
                        <?php
                        $categories = get_all_category();
                        while ($category = mysqli_fetch_assoc($categories)) {
                            $selected = (isset($_GET['dept']) && $_GET['dept'] == $category['nom_categorie']) ? "selected" : "";
                            echo "<option value='" . htmlspecialchars($category['nom_categorie']) . "' $selected>" . htmlspecialchars($category['nom_categorie']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </form>

        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <h3 class="mt-4 mb-3">Résultats</h3>
            <div class="row g-4">
                <?php while ($global = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <img src="../uploads/<?php echo $global['image'] ?? 'placeholder.jpg'; ?>" class="card-img-top" alt="Image de l'objet">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($global['nom_objet']); ?></h5>
                                <?php 
                                $detail = get_all_object_emprunter($global['id_objet']); 
                                if ($detail_data = mysqli_fetch_assoc($detail)) {
                                ?>
                                    <p class="card-text text-muted">Date de retour : <?php echo htmlspecialchars($detail_data['date_retour']); ?></p>
                                <?php } ?>
                                <a href="#" class="btn btn-outline-primary">Voir plus</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php elseif ($result): ?>
            <div class="alert alert-info mt-4" role="alert">
                Aucun objet trouvé pour cette catégorie.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
