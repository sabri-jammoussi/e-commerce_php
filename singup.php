<?php
session_start(); // Start the session
include('config.php');

$cnx = new connexion();
$pdo = $cnx->CNXbase();
$error = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['prenom']) && !empty($_POST['nom'])) {

        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];
        $role = isset($_POST['role']) ? $_POST['role'] : 'client';

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("SELECT id FROM inscription WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $error[] = "Utilisateur existe déjà !";
            } else {
                $stmt = $pdo->prepare("INSERT INTO inscription (prenom, nom, email, password, role) VALUES (?, ?, ?, ?, ?)");
                if ($stmt->execute([$prenom, $nom, $email, $hashed_password, $role])) {
                    header("Location: index.html");
                    exit();
                } else {
                    $error[] = "Erreur lors de l'inscription.";
                }
            }
        } catch (Exception $e) {
            $error[] = "Erreur: " . $e->getMessage();
        }
    } else {
        $error[] = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #080710;
        }

        form {
            height: 600px;
            width: 600px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        button {
            margin-top: 50px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .name-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            /* Adjust spacing */
        }

        .name-container div {
            width: 48%;
            /* Adjust width so they fit next to each other */
        }

        .name-container input {
            width: 100%;
            /* Ensure input takes full width of its container */
        }

        .error {
            margin: 10px 0;
            display: block;
            background: crimson;
            color: #fff;
            border-radius: 5px;
            font-size: 20px;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>

    <form name="f1" method="post" action="singup.php">

        <h3>Login Here</h3>
        <?php
        if (isset($error) && !empty($error)) {
            foreach ($error as $errorr) {
                echo '<span class="error">' . $errorr . '</span>';
            }
        }
        ?>
        <div class="name-container">
            <div>
                <label for="nom">Nom</label>
                <input type="text" name="nom" placeholder="Nom" id="nom">
            </div>
            <div>
                <label for="prenom">Prenom</label>
                <input type="text" name="prenom" placeholder="Prenom" id="prenom">
            </div>

        </div>
        <div class="name-container">
            <div>
                <label for="email">email</label>
                <input type="text" name="email" placeholder="email" id="email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" id="password">
            </div>

        </div>

        <button type="submit" name="submit" id="sabri">s'inscrire</button>

    </form>
</body>

</html>