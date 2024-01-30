<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | OXO Threads</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.png">
  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>

<!-- NAVBAR -->
<?php include 'navbar.php';?>
<!-- NAVBAR END -->

<!------HEAD CAROUSEL------>

<div class="headslideshow-container">
    <div class="promoSlides fade">
        <img src="img/caro1.jpg">
    </div>
    <div class="promoSlides fade">
        <img src="img/caro2.jpg">
    </div>
    <div class="promoSlides fade">
        <img src="img/caro3.jpg">
    </div>
    <div class="promoSlides fade">
        <img src="img/caro4.jpg">
    </div>
</div>

    <!-- <div class="intro">
        <h2 class="brand-name">OXO Threads</h2>
        <h3 class="slogan">Where Style Meets Comfort in Every Stitch</h3>
    </div> -->

    <div class="newarrivals">
        <div class="header-name">
        <img class="separator" src="img/headingline.png">
            <h3>New Arrivals</h3>
        <img class="separator" src="img/headingline.png">
        </div>
        
        <?php include 'newarrival.php';?>
        
    </div>

    <div class="categories">
        <div class="header-name">
            <img class="separator" src="img/headingline.png">
            <h3>Top Categories</h3>
            <img class="separator" src="img/headingline.png">
        </div>

        <div class="categorycontainer">
            <a href="bottomwear.php" class="categoryBoxLink">
            <div class="categorycolumn">
                <img src="img/displayimages_index/bottomwear.webp" alt="pants">
                <div class="categoryoverlay">
                </div>
                <h3>BottomWear</h3>
            </div>
            </a>
            
            <a href="jumpsuits.php" class="categoryBoxLink">
            <div class="categorycolumn">
                <img src="img/displayimages_index/jumpsuits.webp" alt="jumpsuits">
                <div class="categoryoverlay">
                </div>
                <h3>Rompers/Jumpsuits</h3>
            </div>
            </a>

            <a href="tees.php" class="categoryBoxLink">
            <div class="categorycolumn">
                <img src="img/displayimages_index/tees.webp" alt="tshirts">
                <div class="categoryoverlay">
                </div>
                <h3>Tees/Graphic Tees</h3>
            </div>
            </a>
            <a href="vintage.php" class="categoryBoxLink">
            <div class="categorycolumn">
                <img src="img/displayimages_index/vintage.webp" alt="vintage">
                <div class="categoryoverlay">
                </div>
                <h3>Vintage</h3>
            </div>
            </a>
            <a href="dresses.php" class="categoryBoxLink">
            <div class="categorycolumn">
                <img src="img/displayimages_index/dresses.jpg" alt="dresses">
                <div class="categoryoverlay">
                </div>
                <h3>Dresses</h3>
            </div>
            </a>
            <a href="loungewear.php" class="categoryBoxLink">
            <div class="categorycolumn">
                <img src="img/displayimages_index/loungewear.webp" alt="loungewear">
                <div class="categoryoverlay">
                </div>
                <h3>Loungewear</h3>
            </div>
            </a>
            <a href="footwear.php" class="categoryBoxLink">
            <div class="categorycolumn">
                <img src="img/footwear/6.webp" alt="shoes">
                <div class="categoryoverlay">
                </div>
                <h3>Shoes</h3>
            </div>
            </a>
            <a href="coats.php" class="categoryBoxLink">
            <div class="categorycolumn">
                <img src="img/displayimages_index/coats.webp" alt="coats">
                <div class="categoryoverlay">
                </div>
                <h3>Coats/Blazors</h3>
            </div>
            </a>
        </div>
    </div>
    
    <div class="testimonials">
        <div class="header-name">
            <img class="separator" src="img/headingline.png">
            <h3>What Our Customers Say About Us !</h3>
            <img class="separator" src="img/headingline.png">
        </div>

        <!-- review section starts  -->

        <div class="reviews">

            <div class="box-container">

            <?php
          
                $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

                if (!$connection) {
                    die("Connection failed");
                }

                
                    $productId = $_GET['id'];
                    $productName = $_GET['productname'];

                    
                    $sql = "SELECT r.*, c.userimage FROM `reviews` r
                            INNER JOIN `customers` c ON r.customer_id = c.customer_id ORDER BY `reviewid` DESC LIMIT 8";
                    $result = mysqli_query($connection, $sql);

                    if ($result) {
                       
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>

                <div class="box">
                    <div class="user">
                    <img name="userimage" src="<?php echo $row['userimage'] ?>">
                                        <div>
                                            <h3 name="fname"><?php echo $row['fname'] ?> <?php echo $row['lname'] ?></h3>
                                            <div name="star_rating" class="stars">
                                                <?php
                                               
                                                $rating = $row['stars'];

                                              
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= $rating) {
                                                      
                                                        echo '<i class="fas fa-star"></i>';
                                                    } else {
                                                     
                                                        echo '<i class="far fa-star"></i>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                    </div>
                    <p style="font-weight:bold;" name="productname">Product : <?php echo $row['productname'] ?></p>
                    <p name="review"><?php echo $row['description'] ?></p>
                </div>
                <?php
                        }

                     
                        mysqli_free_result($result);
                    } else {
                        echo "Error: " . mysqli_error($connection);
                    }
                

                mysqli_close($connection);
                ?>

            </div>

        </div>

        <!-- review section ends -->

    </div>

 




<footer>
    <?php include 'footer.php';?>
</footer>

<script>
    /** Head slideshow **/
    let slideIndex = 0;
    showSlides();
    function showSlides()
    {
    let i;
    let slides = document.getElementsByClassName("promoSlides");
    for (i = 0; i < slides.length; i++)
    {
    slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length)
    {slideIndex = 1}
    slides[slideIndex-1].style.display = "block";
    setTimeout(showSlides, 3500); //Change image every 3.5 seconds because this takes milliseconds
    }	


  document.addEventListener("DOMContentLoaded", function () {
    const starInputs = document.querySelectorAll('.userreviewrate input');

    starInputs.forEach(input => {
      input.addEventListener('change', handleStarRating);
    });

    function handleStarRating(event) {
      const selectedRating = event.target.value;

      // Resetstars to default color
      starInputs.forEach(input => {
        const label = input.nextElementSibling;
        label.style.color = '#ccc';
      });

      // Color stars up to the selected rating
      for (let i = 1; i <= selectedRating; i++) {
        starInputs[i - 1].nextElementSibling.style.color = '#ffd700';
      }
    }
  });

</script>

    <script src="js/script.js"></script>
</body>

</html>
