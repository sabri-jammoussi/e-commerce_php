<?php
session_start();
$message = isset($_SESSION['message']) ? $_SESSION['message'] : "Aucune commande enregistrée.";
unset($_SESSION['message']); // Supprime le message après affichage
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Redirection automatique après 5 secondes -->
    <meta http-equiv="refresh" content="5;url=index.php">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Confirmation</h2>
        <div class="alert alert-success text-center">
            <?php echo $message; ?>
        </div>
        <p class="text-center mt-3">Vous serez redirigé vers l'accueil dans quelques secondes...</p>
    </div>
</body>
</html>
