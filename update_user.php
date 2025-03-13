<?php
require_once("config.php"); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    try {
        $cnx = new connexion();
        $pdo = $cnx->CNXbase();

        $stmt = $pdo->prepare("UPDATE inscription SET nom = ?, prenom = ?, email = ?, role = ? WHERE id = ?");
        $stmt->execute([$nom, $prenom, $email, $role, $id]);

        header("Location: listeClient.php"); // Redirect after update
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour : " . $e->getMessage());
    }
} else {
    header("Location: listeClient.php"); // Redirect if accessed directly
    exit();
}
