<?php
include 'config.php'; // Inclusion de la connexion à la base de données

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $produit = $_POST['produit'];
    $quantite = $_POST['quantite'];

    // Insérer la commande dans la base de données
    $sql = "INSERT INTO commandes (nom, email, produit, quantite) VALUES (:nom, :email, :produit, :quantite)";
    $stmt = $con->prepare($sql);

    if ($stmt->execute([
        ':nom' => $nom,
        ':email' => $email,
        ':produit' => $produit,
        ':quantite' => $quantite
    ])) {
        $message = "<div class='alert alert-success'>Merci d'avoir commandé <strong>$produit</strong> !</div>";
    } else {
        $message = "<div class='alert alert-danger'>Une erreur s'est produite.</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commander un produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Passer une commande</h2>
        <?php echo $message; ?>

        <form action="" method="POST" class="p-4 shadow bg-white rounded">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="produit" class="form-label">Produit</label>
                <input type="text" class="form-control" id="produit" name="produit" required>
            </div>
            <div class="mb-3">
                <label for="quantite" class="form-label">Quantité</label>
                <input type="number" class="form-control" id="quantite" name="quantite" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Commander</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
