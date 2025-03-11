<?php
include 'config.php'; // Inclusion de la connexion
$database = new connexion();
$con = $database->CNXbase();
$message = "";

// Récupérer les produits disponibles
$produits = [];
try {
    $stmt = $con->query("SELECT id, nom FROM produits"); // Remplace 'produits' par le nom de ta table
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = "<div class='alert alert-danger'>Erreur de récupération des produits : " . $e->getMessage() . "</div>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($con)) {
        die("Erreur : Connexion à la base de données non établie.");
    }

    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $produit = $_POST['produit']; // ID du produit sélectionné
    $quantite = $_POST['quantite'];

    try {
        $sql = "INSERT INTO commandes (nom, email, id, quantite) VALUES (:nom, :email, :produit, :quantite)";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':produit' => $produit,
            ':quantite' => $quantite
        ]);

        $_SESSION['message'] = "<div class='alert alert-success'>Merci d'avoir commandé !</div>";
        header("Location: confirmation.php");
        exit();
    } catch (PDOException $e) {
        $message = "<div class='alert alert-danger'>Erreur : " . $e->getMessage() . "</div>";
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
                <select class="form-control" id="produit" name="produit" required>
                    <option value="">Sélectionner un produit</option>
                    <?php foreach ($produits as $produit) : ?>
                        <option value="<?= $produit['id'] ?>"><?= htmlspecialchars($produit['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="quantite" class="form-label">Quantité</label>
                <input type="number" class="form-control" id="quantite" name="quantite" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Commander</button>
        </form>
    </div>
</body>
</html>
