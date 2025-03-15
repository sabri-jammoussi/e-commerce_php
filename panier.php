<?php
session_start();

// Supprimer un produit du panier
if (isset($_GET['supprimer'])) {
    $id = intval($_GET['supprimer']);
    unset($_SESSION['panier'][$id]);
    header("Location: panier.php");
    exit;
}

// Vider tout le panier
if (isset($_GET['vider_panier'])) {
    $_SESSION['panier'] = [];
    header("Location: panier.php");
    exit;
}

// Mettre à jour les quantités
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantites'])) {
    foreach ($_POST['quantite'] as $id => $quantite) {
        $_SESSION['panier'][$id]['quantite'] = max(1, intval($quantite));
    }
    header("Location: panier.php");
    exit;
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Panier - Pharma</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1 class="mt-4">🛒 Votre Panier</h1>
    
    <?php if (empty($_SESSION['panier'])): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <form method="post">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['panier'] as $id => $produit): ?>
                        <?php $sousTotal = $produit['prix'] * $produit['quantite']; ?>
                        <?php $total += $sousTotal; ?>
                        <tr>
                            <td><?= htmlspecialchars($produit['nom']) ?></td>
                            <td><?= number_format($produit['prix'], 2) ?> DT</td>
                            <td>
                                <input type="number" name="quantite[<?= $id ?>]" value="<?= $produit['quantite'] ?>" min="1" class="form-control" style="width: 60px;">
                            </td>
                            <td><?= number_format($sousTotal, 2) ?> DT</td>
                            <td>
                                <a href="panier.php?supprimer=<?= $id ?>" class="btn btn-danger btn-sm">❌</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <p><strong>Total :</strong> <?= number_format($total, 2) ?> DT</p>
            <button type="submit" name="update_quantites" class="btn btn-primary">🔄 Mettre à jour</button>
            <a href="panier.php?vider_panier=1" class="btn btn-warning">🗑️ Vider le panier</a>
            <a href="shop.php" class="btn btn-secondary">🛍️ Continuer vos achats</a>
            <a href="traitementCommande.php" class="btn btn-success">✅ Passer commande</a>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
