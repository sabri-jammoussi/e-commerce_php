<?php
require_once("config.php")
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="site-wrap">
        <div class="site-navbar py-2">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="logo">
                        <div class="site-logo">
                            <a href="index.php" class="js-logo-clone">Pharma</a>
                        </div>
                    </div>
                    <div class="main-nav d-none d-lg-block">
                        <nav class="site-navigation text-right text-md-center" role="navigation">
                            <ul class="site-menu js-clone-nav d-none d-lg-block">
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "client") : ?>
                                    <li class=""><a href="index.php">Home</a></li>
                                    <li><a href="shop.php">Store</a></li>
                                    <li><a href="about.php">About</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                <?php endif; ?>

                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") : ?>
                                    <li><a href="listeProduit.php">Liste des produits</a></li>
                                    <li><a href="listeClient.php">Liste des clients</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "client") : ?>

                        <div class="icons">
                            <a href="#" class="icons-btn d-inline-block js-search-open">
                                <span class="icon-search"></span>
                            </a>
                            <a href="cart.php" class="icons-btn d-inline-block bag">
                                <span class="icon-shopping-bag"></span>
                                <span class="number">25</span>
                            </a>
                            <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none">
                                <span class="icon-menu"></span>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="dropdown">
                        <a href="" class="icons-btn d-inline-block " id="userDropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true" title="<?= $_SESSION["inscription"] ?>">
                            <span class="icon-user" style="font-size: 20px;"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="profile.php">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="deconnexion.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>