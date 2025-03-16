<?php
require_once "config.php";
$cnx = new connexion();
$pdo = $cnx->CNXbase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];

    try {
        if (!empty($_FILES['image']['tmp_name'])) {
            echo "<script>console.log('Data received:');</script>";

            $imageData = file_get_contents($_FILES['image']['tmp_name']);
            $stmt = $pdo->prepare("UPDATE produits SET nom=?, description=?, prix=?, image=? WHERE id=?");
            $stmt->execute([$nom, $description, $prix, $imageData, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE produits SET nom=?, description=?, prix=? WHERE id=?");
            $stmt->execute([$nom, $description, $prix, $id]);
        }

        header("Location: listeProduit.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur de mise à jour : " . $e->getMessage());
    }
}
