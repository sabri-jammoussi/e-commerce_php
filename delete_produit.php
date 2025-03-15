<?php
require_once "config.php";
$cnx = new connexion();
$pdo = $cnx->CNXbase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM produits WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: listeProduit.php?success=delete");
        exit();
    } catch (PDOException $e) {
        die("Erreur de suppression : " . $e->getMessage());
    }
}
