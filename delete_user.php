<?php
require_once("config.php"); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    try {
        $cnx = new connexion();
        $pdo = $cnx->CNXbase();

        $stmt = $pdo->prepare("DELETE FROM inscription WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: listeClient.php"); // Redirect after deletion
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
} else {
    header("Location: listeClient.php"); // Redirect if accessed directly
    exit();
}
