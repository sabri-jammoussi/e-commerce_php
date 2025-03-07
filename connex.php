<?php
// config.php

$servername = "localhost"; // ou l'adresse du serveur de la base de données
$username = "root"; // ton nom d'utilisateur
$password = ""; // ton mot de passe
$dbname = "projet_php_iit"; // le nom de ta base de données

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
