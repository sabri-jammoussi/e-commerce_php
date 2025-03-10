<?php
// getImage.php

// Connexion à la base de données
require_once "config.php";

// Vérifier si un ID est fourni
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convertir l'ID en entier pour plus de sécurité

    // Requête pour récupérer l'image
    $stmt = $conn->prepare("SELECT image FROM produits WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imageData);
    $stmt->fetch();

    // Vérifier si une image a été trouvée
    if ($imageData) {
        // Définir le type de contenu comme image (ajuste en fonction de ton format)
        header("Content-Type: image/png"); // ou image/jpeg si c'est du JPEG
        echo $imageData;
    } else {
        echo "Image non trouvée.";
    }

    // Fermer la déclaration et la connexion
    $stmt->close();
    $conn->close();
} else {
    echo "Aucun ID fourni.";
}


