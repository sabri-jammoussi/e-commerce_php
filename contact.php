<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Autoload PHPMailer classes if you're using Composer
require 'vendor/autoload.php';

// SMTP server configuration
$mail = new PHPMailer(true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get the form data
        $firstName = $_POST['c_fname'];
        $lastName = $_POST['c_lname'];
        $email = $_POST['c_email'];
        $subject = $_POST['c_subject'];
        $message = $_POST['c_message'];

        // Set SMTP options
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through (use your provider's SMTP server)
        $mail->SMTPAuth = true;
        $mail->Username = 'sabrijm123@gmail.com'; // SMTP username
        $mail->Password = 'ygcv oplu wjtp szmq'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;  // TCP port to connect to

        // Recipients
        $mail->setFrom($email, $firstName . ' ' . $lastName);
        $mail->addAddress('sabrijm123@gmail.com', 'Admin'); // Add recipient email

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "<strong>Message from: </strong>" . $firstName . " " . $lastName . "<br>"
            . "<strong>Email: </strong>" . $email . "<br>"
            . "<strong>Message: </strong><br>" . nl2br($message);

        // Send the email
        if ($mail->send()) {
            echo '<script>alert("Message has been sent successfully!");</script>';
        } else {
            echo '<script>alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '");</script>';
        }
    } catch (Exception $e) {
        echo '<script>alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pharma &mdash; Colorlib Template</title>
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
</head>

<body>
    <div class="site-wrap">
        <div class="site-navbar py-2">
            <div class="search-wrap">
                <div class="container">
                    <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                    <form action="#" method="post">
                        <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
                    </form>
                </div>
            </div>
            <?php require_once "header.php"; ?>
        </div>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0">
                        <a href="index.php">Home</a> <span class="mx-2 mb-0">/</span>
                        <strong class="text-black">Contact</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="h3 mb-5 text-black">Get In Touch</h2>
                    </div>
                    <div class="col-md-12">

                        <form action="#" method="post">

                            <div class="p-3 p-lg-5 border">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="c_fname" class="text-black">First Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_fname" name="c_fname">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="c_lname" class="text-black">Last Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_lname" name="c_lname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_email" class="text-black">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="c_email" name="c_email"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_subject" class="text-black">Subject </label>
                                        <input type="text" class="form-control" id="c_subject" name="c_subject">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_message" class="text-black">Message </label>
                                        <textarea name="c_message" id="c_message" cols="30" rows="7"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <input type="submit" class="btn btn-primary btn-lg btn-block"
                                            value="Send Message">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <?php require_once "footer.php" ?>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/main.js"></script>

</body>

</html>