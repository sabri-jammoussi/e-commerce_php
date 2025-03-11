<?php
// getImage.php

// Connexion à la base de données
require_once "config.php";
$database = new connexion();
$con = $database->CNXbase();

// Vérifier si un ID est fourni
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convertir l'ID en entier pour plus de sécurité

    // Requête pour récupérer l'image
    $stmt = $con->prepare("SELECT image FROM produits WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Vérifier si une image a été trouvée
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $imageData = $row['image'];

        // Définir le type de contenu comme image (ajuste en fonction de ton format)
        header("Content-Type: image/png"); // ou image/jpeg si c'est du JPEG
        echo $imageData;
    } else {
        echo "Image non trouvée.";
    }

    // Fermer la connexion
    $stmt->closeCursor();
} else {
    echo "Aucun ID fourni.";
}
?>
