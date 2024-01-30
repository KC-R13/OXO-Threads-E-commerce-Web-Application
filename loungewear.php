<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loungewear | OXO Threads</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
</head>
<body>
    <!-- NAVBAR -->
    <?php include 'navbar.php';?>
    <!-- NAVBAR END -->

    <div class="categories-page">
        <div class="catpage-container">
            <div class="header-name">
                <img src="img/headingline.png">
                <h3>Loungewear Collection</h3>
                <img src="img/headingline.png">
            </div>

            <div class="sortbybox">
                <form method="get">
                    <select class="sortbyselect" id="sortby" name="sortby" onchange="this.form.submit()">
                        <option value="none" selected disabled hidden>Sort By</option>
                        <option value="hightolow">Price: High to Low</option>
                        <option value="lowtohigh">Price: Low to High</option>
                        <option value="atoz">A-Z</option>
                        <option value="ztoa">Z-A</option>
                    </select>
                </form>
            </div>

            <!---row---->
            <div class="catpage-row">
                <?php
                $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

                if (!$connection) {
                    die("Connection failed");
                }

                $sortOption = "productname"; 
                if (isset($_GET['sortby'])) {
                    switch ($_GET['sortby']) {
                        case 'hightolow':
                            $sortOption = 'productprice DESC';
                            break;
                        case 'lowtohigh':
                            $sortOption = 'productprice ASC';
                            break;
                        case 'atoz':
                            $sortOption = 'productname ASC';
                            break;
                        case 'ztoa':
                            $sortOption = 'productname DESC';
                            break;
                        default:
                            $sortOption = 'productname';
                            break;
                    }
                }

                $sql = "SELECT * FROM `products` WHERE `productcategory` LIKE 'loungewear' AND `status` = 1 ORDER BY $sortOption";
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="catpage-column">
                            <a class="nAslide-boxLink" href="productpage.php?id=<?php echo $row['product_id'] ?>&productname=<?php echo $row['productname'] ?>">
                                <div class="nAslide-box category-nAslide-box">
                                    <img src="<?php echo $row['product_displayimage'] ?>" alt="Image 1">
                                    <h3><?php echo $row['productname'] ?></h3>
                                    <p>Rs. <?php echo $row['productprice'] ?></p>
                                    <div class="stars">★★★★☆</div>
                                </div>
                            </a>
                        </div>
                <?php
                    }
                }
                mysqli_close($connection);
                ?>
            </div>
        </div>
    </div>

    <footer>
        <?php include 'footer.php';?>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
