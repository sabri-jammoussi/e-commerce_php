<?php
require_once "config.php";
$cnx = new connexion();
$pdo = $cnx->CNXbase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

    try {
        if (!empty($_FILES['image']['tmp_name'])) {
            echo "<script>console.log('Data received:');</script>";

            $imageData = file_get_contents($_FILES['image']['tmp_name']);
            $stmt = $pdo->prepare("UPDATE produits SET nom=?, description=?, prix=?,stock=?, image=? WHERE id=?");
            $stmt->execute([$nom, $description, $prix, $stock, $imageData, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE produits SET nom=?, description=?, prix=?,stock=? WHERE id=?");
            $stmt->execute([$nom, $description, $prix, $stock, $id]);
        }

        header("Location: listeProduit.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur de mise à jour : " . $e->getMessage());
    }
}
