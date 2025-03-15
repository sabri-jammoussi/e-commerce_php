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


            <?php
            require_once('header.php');
            ?>
        </div>
    </div>
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Store</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                    <div id="slider-range" class="border-primary"></div>
                    <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white"
                        disabled="" />
                </div>
                <div class="col-lg-6">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Reference</h3>
                    <button type="button" class="btn btn-secondary btn-md dropdown-toggle px-4"
                        id="dropdownMenuReference" data-toggle="dropdown">Reference</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                        <a class="dropdown-item" href="#">Relevance</a>
                        <a class="dropdown-item" href="#">Name, A to Z</a>
                        <a class="dropdown-item" href="#">Name, Z to A</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Price, low to high</a>
                        <a class="dropdown-item" href="#">Price, high to low</a>
                    </div>
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
</div>

            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <div class="site-block-27">
                        <ul>
                            <li><a href="#">&lt;</a></li>
                            <li class="active"><span>1</span></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&gt;</a></li>
                        </ul>
                    </div>
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