<?php 
    require_once "config.php";
$cnx = new connexion();
$pdo = $cnx->CNXbase();
try{
    $stmt = $pdo->prepare("SELECT * FROM produits");
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);  
    $jsonProduits = json_encode($produits);

    // Print to JavaScript console
    echo "<script>console.log('Data received:', " . $jsonProduits . ");</script>";

}catch(PDOException $e){
    die("Erreur de base de données : " . $e->getMessage());
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
    <?php
    require_once "session.php";
    Verifier_session();
    require_once "header.php";
    ?>
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



            <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharma - Dynamic Background</title>
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
        #hero-section {
            height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: background-image 1s ease-in-out;
        }
    </style>
</head><body>
    <div class="site-wrap">
        <!-- Hero Section with Dynamic Background -->
        <div class="site-blocks-cover" id="hero-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
                        <div class="site-block-cover-content text-center">
                            <h1>Welcome To Pharma</h1>
                            <p>
                                <a href="traitementCommande.php" class="btn btn-primary px-5 py-3">Shop Now</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Hero Section -->
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Liste des images
            const images = [
                "svr.png",
                "filorga.png",
                "sisderma.png",
                "avene.png",
                "nuxe.png"
            ];

            let index = 0;
            const heroSection = document.getElementById("hero-section");

            // Fonction pour changer l'arrière-plan
            function changeBackground() {
                index = (index + 1) % images.length;
                heroSection.style.backgroundImage = `url('${images[index]}')`;
            }

            // Afficher immédiatement une image dès le chargement
            heroSection.style.backgroundImage = `url('${images[index]}')`;

            // Change toutes les 5 secondes
            setInterval(changeBackground, 7000);
        });
    </script>

    <!-- Bootstrap JS and jQuery (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>




</html>

            <div class="site-section">
               
            </div>

            <div class="site-section">
                <div class="container">
                    <div class="row">
                        <div class="title-section text-center col-12">
                            <h2 class="text-uppercase">Popular Products</h2>
                        </div>
                    </div>

                    <div class="row">
                    <?php if (!empty($produits)): ?>
                        <?php foreach ($produits as $produit): ?>
                        <div class="col-sm-6 col-lg-4 text-center item mb-4">
                            <span class="tag">Sale</span>
                            <a href="shop-single.php" title="<?= htmlspecialchars($produit['description']) ?>">  <img src="get_image.php?id=<?=htmlspecialchars($produit['id']) ?>" alt="Image" style="width:180px; height:250px;"></a>
                            <h3 class="text-dark"> <a href="shop-single.php"><?= htmlspecialchars($produit['nom']) ?></a></h3>
                            <p class="price">prix :<?= htmlspecialchars($produit['prix']) ?> DT</p>
                        </div>
                        <?php endforeach; ?>
                        <?php endif ?>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 text-center">
                            <a href="shop.php" class="btn btn-primary px-4 py-3">View All Products</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="site-section bg-light">
                <div class="container">
                <div class="row">
            <div class="title-section text-center col-12">
                <h2 class="text-uppercase">New Products</h2>
            </div>
        </div>
        <div class="row">
    <div class="col-md-12 block-3 products-wrap">
        <div class="nonloop-block-3 owl-carousel">
            <?php if (!empty($produits)): ?>
                <?php foreach ($produits as $produit): ?>
                    <div class="d-flex flex-column align-items-center text-center item mb-4">
                        <a href="shop-single.php?id=<?= htmlspecialchars($produit['id']) ?>">
                            <img src="get_image.php?id=<?= htmlspecialchars($produit['id']) ?>" alt="Image" class="img-fluid" style="max-width: 150px; height: 200px;">
                        </a>
                        <h3 class="text-dark mt-2">
                            <a href="shop-single.php?id=<?= htmlspecialchars($produit['id']) ?>">
                                <?= htmlspecialchars($produit['nom']) ?>
                            </a>
                        </h3>
                        <p class="price font-weight-bold"><?= htmlspecialchars($produit['prix']) ?> DT</p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    
</div>

                </div>
            </div>

            <div class="site-section">
                <div class="container">
                    <div class="row">
                        <div class="title-section text-center col-12">
                        </div>
                        </div>
                </div>
            </div>

  <?php require_once "footer.php"; ?>
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