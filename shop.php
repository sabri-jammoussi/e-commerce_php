<?php
require_once "config.php";
$cnx = new connexion();
$pdo = $cnx->CNXbase();

$produit = null;
$parPage = 9; // Nombre de produits par page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$start = ($page - 1) * $parPage;

// Vérifier si on est sur la page d'un produit unique
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    try {
        $stmt = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur de base de données : " . $e->getMessage());
    }
} else {
    // Récupérer la liste des produits avec pagination
    try {
        $stmt = $pdo->prepare("SELECT * FROM produits LIMIT :start, :parPage");
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':parPage', $parPage, PDO::PARAM_INT);
        $stmt->execute();
        $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur de base de données : " . $e->getMessage());
    }
}

// Compter le nombre total de produits pour la pagination
$totalProduits = $pdo->query("SELECT COUNT(*) FROM produits")->fetchColumn();
$totalPages = ceil($totalProduits / $parPage);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Découvrez notre boutique en ligne avec une large sélection de produits.">
    <meta name="author" content="Nom de l'auteur">
    <title><?= $produit ? htmlspecialchars($produit['nom']) . ' - Détails' : 'Boutique' ?></title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="site-wrap">
        <?php require_once('header.php'); ?>
    </div>

    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="index.php">Home</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black"><?= $produit ? 'Détails du Produit' : 'Boutique' ?></strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">

            <?php if ($produit): ?>
            <!-- Affichage du produit unique -->
            <div class="row">
                <div class="col-md-5">
                    <img src="get_image.php?id=<?= htmlspecialchars($produit['id']) ?>"
                        alt="<?= htmlspecialchars($produit['nom']) ?>" style="width:50%;" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2><?= htmlspecialchars($produit['nom']) ?></h2>
                    <p><?= htmlspecialchars($produit['description']) ?></p>
                    <p class="price"><strong>Prix :</strong> <?= htmlspecialchars($produit['prix']) ?> DT</p>
                    <a href="shop.php" class="btn btn-primary">Retour à la boutique</a>


                    <!-- Formulaire Ajouter au panier -->
                    <form method="post" action="ajouter_panier.php" class="d-flex align-items-center mt-4">
                        <!-- Produits cachés -->
                        <input type="hidden" name="id" value="<?= htmlspecialchars($produit['id']) ?>">
                        <input type="hidden" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>">
                        <input type="hidden" name="prix" value="<?= htmlspecialchars($produit['prix']) ?>">

                        <!-- Quantité -->
                        <div class="form-group me-3">
                            <label for="quantite" class="form-label">Quantité :</label>
                            <input type="number" name="quantite" id="quantite" class="form-control" value="1" min="1"
                                max="100" style="width: 60px;">
                        </div>

                        <!-- Bouton Ajouter au panier -->
                        <div class="form-group me-2">
                            <button type="submit" name="ajouter_panier" class="btn btn-success btn-sm">🛒 Ajouter au
                                panier</button>
                        </div>

                        <!-- Bouton Passer commande -->
                        <div class="form-group">
                            <a href="traitementCommande.php" class="btn btn-primary btn-sm">✅ Passer commande</a>
                        </div>
                    </form>
                </div>
            </div>

            <?php else: ?>
            <!-- Affichage de la liste des produits -->
            <h1 class="text-center">Boutique</h1>
            <div class="row">
                <?php foreach ($produits as $prod): ?>
                <div class="col-sm-6 col-lg-4 text-center item mb-4">
                    <span class="tag">Promo</span>
                    <a href="shop.php?id=<?= htmlspecialchars($prod['id']) ?>"
                        title="<?= htmlspecialchars($prod['description']) ?>">
                        <img src="get_image.php?id=<?= htmlspecialchars($prod['id']) ?>"
                            alt="<?= htmlspecialchars($prod['nom']) ?>" class="img-fluid"
                            style="width:180px; height:250px;">
                    </a>
                    <h3 class="text-dark">
                        <a
                            href="shop.php?id=<?= htmlspecialchars($prod['id']) ?>"><?= htmlspecialchars($prod['nom']) ?></a>
                    </h3>
                    <p class="price">Prix : <?= htmlspecialchars($prod['prix']) ?> DT</p>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination Dynamique -->
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <div class="site-block-27">
                        <ul>
                            <?php if ($page > 1): ?>
                            <li><a href="shop.php?page=<?= $page - 1 ?>">&lt;</a></li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li <?= $i == $page ? 'class="active"' : '' ?>>
                                <a href="shop.php?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                            <?php endfor; ?>
                            <?php if ($page < $totalPages): ?>
                            <li><a href="shop.php?page=<?= $page + 1 ?>">&gt;</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <?php endif; ?>

        </div>
    </div>

    <?php require_once "footer.php" ?>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>