<?php
require_once "config.php";
$cnx = new connexion();
$pdo = $cnx->CNXbase();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

    // Handle file upload for image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imageTmp = $image['tmp_name'];
        $imageData = file_get_contents($imageTmp); // Get the binary data of the image

        // Insert the product into the database
        try {
            $stmt = $pdo->prepare("INSERT INTO produits (nom, description, prix,stock, image) VALUES (:nom, :description, :prix,:stock, :image)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB); // Bind as BLOB

            if ($stmt->execute()) {
                header("Location: listeProduit.php?success=1");
                exit();
            } else {
                echo "Error: Could not insert the product.";
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    } else {
        echo "Image not selected or error occurred during upload.";
    }
}
