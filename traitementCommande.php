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
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $produit = $_POST['produit']; // ID du produit sélectionné
    $total_commande = $_SESSION['total_commande'] ?? 0;
    try {
        $sql = "INSERT INTO commandes (nom, prenom, telephone, adresse, email, id, total) VALUES (:nom, :prenom, :telephone, :adresse, :email, :produit, :total)";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':telephone' => $telephone,
            ':adresse' => $adresse,
            ':email' => $email,
            ':produit' => $produit,
            ':total' => $total_commande
        ]);

        $_SESSION['message'] = "<div class='alert alert-success'>Merci d'avoir commandé !</div>";
        $_SESSION['panier'] = [];

        header("Location: confirmation.php");
        exit();
    } catch (PDOException $e) {
        $message = "<div class='alert alert-danger'>Erreur : " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php
include "header.php"
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer une commande</title>
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
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Numéro de téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" required>
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">

            </div>
            <div class="mb-3">
                <label for="quantite" class="form-label">Total prix</label>
                <input type="number" class="form-control" id="quantite" name="quantite"
                    value="<?= $_SESSION['total_commande'] ?>" disabled>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Commander</button>
                <a type="reset" class="btn btn-secondary me-2" href="index.php">Annuler</a>
            </div>
        </form>
    </div>
</body>

</html>