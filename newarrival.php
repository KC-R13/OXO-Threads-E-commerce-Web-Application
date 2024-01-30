<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
  <link rel="stylesheet" href="css/style.css">
  
  <style>
    
    .nAslide-box {
    text-align: left;
    padding: 20px;
    border: 1px solid #ccc;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    }
    .nAslide-box img {
    max-width: 100%;
    height: auto;
    }

    .newArrivalsSlider .nAslide-boxLink{
      text-align: center;
      display: flex;
      flex-direction: column;
      color: #000;
      text-decoration: none;
      margin: 0 0;
      align-items: flex-start;
    }

    .newArrivalsSlider .nAslide-boxLink .nAslide-box h3{
      font-size: 15px;
    }

    .newArrivalsSlider .nAslide-boxLink .nAslide-box p{
      font-size: 14px;
    }

    .newArrivalsSlider .nAslide-boxLink .nAslide-box .stars {
      color: #ffd700;
      font-size: 16px;
    }



  </style>
</head>
<body>

<div class="newArrivalsSlider">



            <?php

                $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

                if (!$connection) {
                die("Connection failed");
                }

                $sql = "SELECT * FROM `products` ORDER BY `product_id` DESC LIMIT 8";
                $result = mysqli_query($connection, $sql);



                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
            ?>

                <a class="nAslide-boxLink" href="productpage.php?id=<?php echo $row['product_id'] ?>&productname=<?php echo $row['productname'] ?>">
                    <div class="nAslide-box">
                        <img src="<?php echo $row['product_displayimage'] ?>" alt="Image 1">
                        <h3><?php echo $row['productname'] ?></h3>
                        <p>Rs. <?php echo $row['productprice'] ?></p>
                        <div class="stars">★★★★☆</div>
                    </div>
                </a>

            <?php
                }
            }
            // mysqli_close(($conn));
            ?>











    <!-- 

    <a class="nAslide-boxLink" href="productpage.php">
        <div class="nAslide-box">
            <img src="img/newarrivals/1.webp" alt="Image 1">
            <h3>NeoCity Aesthetic Fluffy Sweater</h3>
            <p>Rs. 6200.00</p>
            <div class="stars">★★★★☆</div>
        </div>
    </a>
    
    <a class="nAslide-boxLink" href="productpage.php">
        <div class="nAslide-box">
            <img src="img/newarrivals/2.jpg" alt="Image 2">
            <h3>Compression Long Sleeved Shirt</h3>
            <p>Rs. 6200.00</p>
            <div class="stars">★★★★★</div>
        </div>
    </a>
    <a class="nAslide-boxLink" href="productpage.php">
        <div class="nAslide-box">
            <img src="img/newarrivals/3.webp" alt="Image 3">
            <h3>Smiley Blink Oversized T-shirt</h3>
            <p>Rs. 6200.00</p>
            <div class="stars">★★★★☆</div>
        </div>
    </a>
    <a class="nAslide-boxLink" href="productpage.php">
        <div class="nAslide-box">
            <img src="img/newarrivals/4.jpg" alt="Image 4">
            <h3>Coudory Dreams Sweater (Brown)</h3>
            <p>Rs. 6200.00</p>
            <div class="stars">★★★★★</div>
        </div>
    </a>
    <a class="nAslide-boxLink" href="productpage.php">
        <div class="nAslide-box">
            <img src="img/newarrivals/5.webp" alt="Image 5">
            <h3>NeoCity Bee Sweater (TaeOXO)</h3>
            <p>Rs. 6200.00</p>
            <div class="stars">★★★★★</div>
        </div>
    </a>
    <a class="nAslide-boxLink" href="productpage.php">
        <div class="nAslide-box">
            <img src="img/newarrivals/6.webp" alt="Image 6">
            <h3>KHJ Unisex Grey Over-Coat</h3>
            <p>Rs. 6200.00</p>
            <div class="stars">★★★★★</div>
        </div>
    </a>
    <a class="nAslide-boxLink" href="productpage.php">
        <div class="nAslide-box">
            <img src="img/newarrivals/7.jpg" alt="Image 7">
            <h3>Le's Dream Unisex Suit-Fit</h3>
            <p>Rs. 6200.00</p>
            <div class="stars">★★★★☆</div>
        </div>
    </a>
    <a class="nAslide-boxLink" href="productpage.php">
        <div class="nAslide-box">
            <img src="img/newarrivals/8.webp" alt="Image 8">
            <h3>BearHugs Fluff Sweater Hyuck Version</h3>
            <p>Rs. 6200.00</p>
            <div class="stars">★★★★★</div>
        </div>
    </a>
    <a class="nAslide-boxLink" href="productpage.php">
        <div class="nAslide-box">
            <img src="img/newarrivals/9.jpg" alt="Image 9">
            <h3>Solar WEIU Grey Over-Blazor</h3>
            <p>Rs. 6200.00</p>
            <div class="stars">★★★★★</div>
        </div>
    </a>
    <a class="nAslide-boxLink" href="productpage.php">
        <div class="nAslide-box">
            <img src="img/newarrivals/10.webp" alt="Image 10">
            <h3>Mars Grey TrenchCoat (HwaSeong Ver.)</h3>
            <p>Rs. 6200.00</p>
            <div class="stars">★★★★☆</div>
        </div>
    </a>
    <a class="nAslide-boxLink" href="productpage.php">
        <div class="nAslide-box">
            <img src="img/newarrivals/11.webp" alt="Image 11">
            <h3>YSL Leather Hyuck Boots</h3>
            <p>Rs. 6200.00</p>
            <div class="stars">★★★★★</div>
        </div>
    </a>
    <a class="nAslide-boxLink" href="productpage.php">
        <div class="nAslide-box">
            <img src="img/newarrivals/12.webp" alt="Image 12">
            <h3>Johnny's FE NewAge Sweater</h3>
            <p>Rs. 6200.00</p>
            <div class="stars">★★★★☆</div>
        </div>
    </a>
    <a class="nAslide-boxLink" href="productpage.php">
        <div class="nAslide-box">
            <img src="img/newarrivals/13.jpg" alt="Image 13">
            <h3>Deja Vu White Blouse (HwaSeong Ver.)</h3>
            <p>Rs. 6200.00</p>
            <div class="stars">★★★★★</div>
        </div>
    </a> -->

    
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
  $(document).ready(function(){
    $('.newArrivalsSlider').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      easing: 'ease-in'
    });
  });
</script>
</body>
</html>
