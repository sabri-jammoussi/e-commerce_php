<?php
session_start(); // Start the session

require_once('config.php');
$cnx = new connexion();
$pdo = $cnx->CNXbase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']); // Plain password input (no hashing here)

        try {
            // Fetch the hashed password from the database
            $stmt = $pdo->prepare("SELECT * FROM inscription WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                $_SESSION["connecte"] = "1";

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $test = $row['email'];
                echo "<script>console.log('This is a message from PHP! pass stored testttt','" . $test . "');</script>";
                $stored_password = trim($row['password']); // Fetch the hashed password from the database
                echo "<script>console.log('This is a message from PHP! pass stored','" . $stored_password . "');</script>";
                echo "<script>console.log('This is a message from PHP! pass input', '" . $password . "');</script>";
                // Use password_verify to compare the plain password with the hashed one
                if (password_verify($password, $stored_password)) {
                    echo "<script>console.log('This is a message from PHP! pass stored 7777777777');</script>";
                    $_SESSION['email'] = $email; // Store email in session
                    $_SESSION["connecte"] = "1";
                    header('Location: index.html'); // Redirect to index page
                    //exit();
                } else {
                    $error[] = "Invalid password."; // Invalid password
                }
            } else {
                $error[] = "No user found with that email."; // User not found
            }
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    } else {
        $error[] = "Email and password not provided."; // Missing email or password
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

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        form {
            height: 620px;
            width: 400px;
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
            width: 100%;
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

        .social {
            margin-top: 30px;
            display: flex;
        }

        .social div {
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255, 255, 255, 0.27);
            color: #eaf0fb;
            text-align: center;
        }

        .social div:hover {
            background-color: rgba(255, 255, 255, 0.47);
        }

        .social .fb {
            margin-left: 25px;
        }

        .social i {
            margin-right: 4px;
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
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form name="f1" method="post" action="">

        <h3>Login Here</h3>
        <?php
        if (isset($error)) {
            foreach ($error as $errorr) {
                echo '<span class="error">' . $errorr . '</span>';
            }
        }
        ?>
        <label for="username">Username</label>
        <input type="email" name="email" placeholder="Email or Phone" id="username">

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" id="password">

        <button type="submit" name="submit" id="sabri">Connexion</button>
        <a href="singup.php">Creer compte ?</a>

        <div class="social">
            <div class="go"><i class="fab fa-google"></i> Google</div>
            <div class="fb"><i class="fab fa-facebook"></i> Facebook</div>
        </div>
    </form>
</body>

</html>