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



            <div class="site-blocks-cover" style="background-image: url('images/hero_1.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
                            <div class="site-block-cover-content text-center">
                                <h2 class="sub-title">Effective Medicine, New Medicine Everyday</h2>
                                <h1>Welcome To Pharma</h1>
                                <p>
                                    <a href="traitementCommande.php" class="btn btn-primary px-5 py-3">Shop Now</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="site-section">
                <div class="container">
                    <div class="row align-items-stretch section-overlap">
                        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                            <div class="banner-wrap bg-primary h-100">
                                <a href="#" class="h-100">
                                    <h5>Free <br> Shipping</h5>
                                    <p>
                                        Amet sit amet dolor
                                        <strong>Lorem, ipsum dolor sit amet consectetur adipisicing.</strong>
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                            <div class="banner-wrap h-100">
                                <a href="#" class="h-100">
                                    <h5>Season <br> Sale 50% Off</h5>
                                    <p>
                                        Amet sit amet dolor
                                        <strong>Lorem, ipsum dolor sit amet consectetur adipisicing.</strong>
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                            <div class="banner-wrap bg-warning h-100">
                                <a href="#" class="h-100">
                                    <h5>Buy <br> A Gift Card</h5>
                                    <p>
                                        Amet sit amet dolor
                                        <strong>Lorem, ipsum dolor sit amet consectetur adipisicing.</strong>
                                    </p>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
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
                            <p class="price">quatité :<?= htmlspecialchars($produit['stock']) ?> </p>
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
                            <div class="text-center item mb-4">
                                <a href="shop-single.php?id=<?= htmlspecialchars($produit['id']) ?>">
                                    <img src="get_image.php?id=<?= htmlspecialchars($produit['id']) ?>" alt="Image" style="width:150px; height:200px;">
                                </a>
                                <h3 class="text-dark">
                                    <a href="shop-single.php?id=<?= htmlspecialchars($produit['id']) ?>">
                                        <?= htmlspecialchars($produit['nom']) ?>
                                    </a>
                                </h3>
                                <p class="price"><?= htmlspecialchars($produit['prix']) ?> DT</p>
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
                            <h2 class="text-uppercase">Testimonials</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 block-3 products-wrap">
                            <div class="nonloop-block-3 no-direction owl-carousel">

                                <div class="testimony">
                                    <blockquote>
                                        <img src="images/person_1.jpg" alt="Image"
                                            class="img-fluid w-25 mb-4 rounded-circle">
                                        <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis
                                            voluptatem consectetur
                                            quam tempore obcaecati maiores voluptate aspernatur iusto eveniet, placeat
                                            ab quod tenetur ducimus.
                                            Minus ratione sit quaerat unde.&rdquo;</p>
                                    </blockquote>

                                    <p>&mdash; Kelly Holmes</p>
                                </div>

                                <div class="testimony">
                                    <blockquote>
                                        <img src="images/person_2.jpg" alt="Image"
                                            class="img-fluid w-25 mb-4 rounded-circle">
                                        <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis
                                            voluptatem consectetur
                                            quam tempore
                                            obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod
                                            tenetur ducimus. Minus ratione
                                            sit quaerat
                                            unde.&rdquo;</p>
                                    </blockquote>

                                    <p>&mdash; Rebecca Morando</p>
                                </div>

                                <div class="testimony">
                                    <blockquote>
                                        <img src="images/person_3.jpg" alt="Image"
                                            class="img-fluid w-25 mb-4 rounded-circle">
                                        <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis
                                            voluptatem consectetur
                                            quam tempore
                                            obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod
                                            tenetur ducimus. Minus ratione
                                            sit quaerat
                                            unde.&rdquo;</p>
                                    </blockquote>

                                    <p>&mdash; Lucas Gallone</p>
                                </div>

                                <div class="testimony">
                                    <blockquote>
                                        <img src="images/person_4.jpg" alt="Image"
                                            class="img-fluid w-25 mb-4 rounded-circle">
                                        <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis
                                            voluptatem consectetur
                                            quam tempore
                                            obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod
                                            tenetur ducimus. Minus ratione
                                            sit quaerat
                                            unde.&rdquo;</p>
                                    </blockquote>

                                    <p>&mdash; Andrew Neel</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
                <div class="container">
                    <div class="row align-items-stretch">
                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
                                <div class="banner-1-inner align-self-center">
                                    <h2>Pharma Products</h2>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus
                                        rem odio voluptatem.
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
                                <div class="banner-1-inner ml-auto  align-self-center">
                                    <h2>Rated by Experts</h2>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus
                                        rem odio voluptatem.
                                    </p>
                                </div>
                            </a>
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