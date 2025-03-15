<?php
session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nom = $_POST['nom'];
    $prix = floatval($_POST['prix']);

    if (!isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id] = [
            'nom' => $nom,
            'prix' => $prix,
            'quantite' => 1
        ];
    } else {
        $_SESSION['panier'][$id]['quantite']++;
    }

    if (isset($_POST['commander'])) {
        // Redirige directement vers la page de commande
        header("Location: commande.php");
        exit;
    } else {
        // Redirige vers le panier après ajout
        header("Location: panier.php");
        exit;
    }
}
?>
