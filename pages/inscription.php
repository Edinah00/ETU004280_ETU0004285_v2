<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inscription</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">

  <div class="container py-5">
    <div class="text-center mb-4">
      <img src="../assets/images/Shelly.png" class="img-fluid" style="max-height: 100px;" alt="Logo">
    </div>

    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-center mb-3">Inscription</h5>
            <p class="text-center text-muted">Vos données resteront privées</p>

            <form action="treat_ins.php" method="get">
              <div class="mb-3">
                <input type="text" name="nom" class="form-control" placeholder="Nom" required>
              </div>
              <div class="mb-3">
                <input type="date" name="dtn" class="form-control" placeholder="Date de naissance" required>
              </div>
              <div class="mb-3">
                <input type="text" name="genre" class="form-control" placeholder="Genre" required>
              </div>
              <div class="mb-3">
                <input type="email" name="mail" class="form-control" placeholder="Adresse mail" required>
              </div>
              <div class="mb-3">
                <input type="text" name="ville" class="form-control" placeholder="Origine" required>
              </div>
              <div class="mb-3">
                <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required>
              </div>

              <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">S'inscrire</button>
              </div>
            </form>

            <div class="text-center">
              <a href="../index.php">Retour à l'accueil</a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
