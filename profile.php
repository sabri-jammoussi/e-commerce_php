<?php
require_once('config.php');

if (!isset($_SESSION['inscription'])) {
    die("User not logged in.");
}

$cnx = new connexion();
$pdo = $cnx->CNXbase();

try {
    // Use a WHERE clause to get the correct user
    $stmt = $pdo->prepare("SELECT * FROM inscription WHERE email = :email");
    $stmt->bindParam(':email', $_SESSION['inscription'], PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Assign user data
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $role = $row['role'];
    } else {
        echo "<script>console.log('No matching user found');</script>";
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pharma &mdash; Profile Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    <style>
    button {
        margin-top: 50px;
        background-color: #ffffff;
        color: #080710;
        padding: 15px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <?php require_once "header.php"; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white text-center">
                        <h4>Mettre à jour le profil</h4>
                    </div>
                    <div class="card-body">
                        <form action="update_profile.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="nom">Nom</label>
                                <input type="text" id="nom" name="nom" class="form-control" value="<?= $nom ?>"
                                    required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="prenom">Prénom</label>
                                <input type="text" id="prenom" name="prenom" class="form-control" value="<?= $prenom ?>"
                                    required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?= $email ?>"
                                    required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="role">Role</label>
                                <input type="text" id="role" name="role" class="form-control" required
                                    value="<?= $role ?>" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Nouveau Mot de passe</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Valider</button>
                                <a type="reset" class="btn btn-secondary me-2" href="index.php">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>