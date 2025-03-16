<?php
require_once "config.php";
// Supprimer un produit du panier
if (isset($_GET['supprimer'])) {
    $id = intval($_GET['supprimer']);
    unset($_SESSION['panier'][$id]);
    header("Location: cart.php");
    exit;
}

// Vider tout le panier
if (isset($_GET['vider_panier'])) {
    $_SESSION['panier'] = [];
    header("Location: cart.php");
    exit;
}

// Mettre à jour les quantités
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantites'])) {
    foreach ($_POST['quantite'] as $id => $quantite) {
        $_SESSION['panier'][$id]['quantite'] = max(1, intval($quantite));
    }
    header("Location: cart.php");
    exit;
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pharma &mdash; Colorlib Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="site-wrap">
        <?php require_once "header.php"; ?>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0">
                        <a href="index.php">Home</a> <span class="mx-2 mb-0">/</span>
                        <strong class="text-black">Cart</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <?php if (empty($_SESSION['panier'])): ?>
                    <p class="text-center">Votre panier est vide.</p>
                <?php else: ?>
                    <div class="row mb-5">
                        <form class="col-md-12" method="post">
                            <div class="site-blocks-table">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-total">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($_SESSION['panier'] as $id => $produit): ?>
                                            <?php $sousTotal = $produit['prix'] * $produit['quantite']; ?>
                                            <?php $total += $sousTotal;
                                            $_SESSION['total_commande'] = $total;

                                            ?>
                                            <tr>
                                                <td class="product-thumbnail text-center">
                                                    <img src="get_image.php?id=<?= $id ?>" alt="Image" class="img-fluid"
                                                        width="100">
                                                </td>
                                                <td class="product-name text-center">
                                                    <h2 class="h5 text-black"><?= htmlspecialchars($produit['nom']) ?></h2>
                                                </td>
                                                <td><?= number_format($produit['prix'], 2) ?> DT</td>
                                                <td>
                                                    <div class="input-group mb-3" style="max-width: 120px; margin:auto">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-outline-primary js-btn-minus"
                                                                type="button">&minus;</button>
                                                        </div>
                                                        <input type="number" name="quantite[<?= $id ?>]"
                                                            value="<?= $produit['quantite'] ?>" min="1"
                                                            class="form-control text-center">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-primary js-btn-plus"
                                                                type="button">&plus;</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= number_format($sousTotal, 2) ?> DT</td>
                                                <td>
                                                    <a href="cart.php?supprimer=<?= $id ?>" class="btn btn-danger btn-sm">❌</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" name="update_quantites"
                                        class="btn btn-primary btn-md btn-block">🔄 Update Cart</button>
                                    <a href="shop.php" class="btn btn-outline-primary btn-md btn-block">🛍️ Continue
                                        Shopping</a>
                                    <a href="cart.php?vider_panier=1" class="btn btn-warning btn-md btn-block">🗑️ Empty
                                        Cart</a>
                                </div>
                                <div class="col-md-6 pl-5">
                                    <div class="row justify-content-end">
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-md-12 text-right border-bottom mb-5">
                                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <span class="text-black">Total:</span>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <strong class="text-black"><?= number_format($total, 2) ?> DT</strong>
                                                </div>
                                            </div>
                                            <a href="traitementCommande.php" class="btn btn-success btn-lg btn-block">✅
                                                Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".js-btn-minus").forEach(button => {
                button.addEventListener("click", function() {
                    let input = this.closest(".input-group").querySelector("input");
                    let value = parseInt(input.value, 10) || 1;
                    if (value > 1) {
                        input.value = value - 1;
                    }
                });
            });

            document.querySelectorAll(".js-btn-plus").forEach(button => {
                button.addEventListener("click", function() {
                    let input = this.closest(".input-group").querySelector("input");
                    let value = parseInt(input.value, 10) || 1;
                    input.value = value + 1;
                });
            });
        });
    </script>
</body>

</html>