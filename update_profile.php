<?php
require_once('config.php');
$cnx = new connexion();
$pdo = $cnx->CNXbase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data safely
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);
    $new_password = trim($_POST['password']);

    try {
        // Check if the user exists
        $stmt = $pdo->prepare("SELECT * FROM inscription WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Update user data
            $updateStmt = $pdo->prepare("UPDATE inscription SET nom = :nom, prenom = :prenom, role = :role, password = :password WHERE email = :email");
            $updateStmt->bindParam(':nom', $nom);
            $updateStmt->bindParam(':prenom', $prenom);
            $updateStmt->bindParam(':role', $role);
            $updateStmt->bindParam(':password', $hashed_password);
            $updateStmt->bindParam(':email', $email);

            if ($updateStmt->execute()) {
                echo "<script>alert('Mise à jour réussie !'); window.location.href='profile.php';</script>";
            } else {
                echo "<script>alert('Erreur lors de la mise à jour');</script>";
            }
        } else {
            echo "<script>alert('Utilisateur introuvable');</script>";
        }
    } catch (PDOException $e) {
        die("Erreur de base de données: " . $e->getMessage());
    }
} else {
    echo "<script>alert('Requête invalide'); window.location.href='index.php';</script>";
}