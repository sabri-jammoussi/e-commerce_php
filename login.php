<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'projet_php_iit');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']); // Ensure no extra spaces

        // Fetch the plain text password from the database
        $stmt = $conn->prepare("SELECT password FROM inscription WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = trim($row['password']); // Ensure no spaces

            echo "Stored Password: " . $stored_password . "<br>";
            echo "Entered Password: " . $password . "<br>";

            // Compare passwords directly
            if ($password === $stored_password) {
                $_SESSION['email'] = $email;
                echo " Login successful! Redirecting...";
                header('Location: index.html');
                exit();
            } else {
                echo " Invalid password.";
            }
        } else {
            echo " No user found with that email.";
        }

        $stmt->close();
    } else {
        echo " Email and password not provided.";
    }
}

/* if (!empty($_POST['email']) && !empty($_POST['password'])) {
$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM inscription WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
if (password_verify($password, $row['password'])) { // Verify hashed password
$_SESSION['user'] = $row;
header('Location: index.html');
exit;
} else {
echo "Invalid password.";
}
} else {
echo "No user found.";
}

$stmt->close();
} else {
echo "Email and password not provided.";
}
*/
$conn->close();