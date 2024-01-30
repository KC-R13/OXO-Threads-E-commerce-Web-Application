<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product | OXO Threads</title>
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

<div class="product-maincontainer">
            <div class="header-name">
                <img src="img/headingline.png">
            </div>
    <div class="product-container">


    <?php
       
        $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

        if (!$connection) {
            die("Connection failed");
        }

        if (isset($_GET['id'])) {
            $productId = $_GET['id'];

            $sql = "SELECT * FROM `products` WHERE `product_id` = $productId";
            $result = mysqli_query($connection, $sql);

            if ($result) {
              
                if ($row = mysqli_fetch_assoc($result)) {
                    ?>
                <form action="addToCart.php" method="post">
                    <div class="product-container">
                        <div class="productimg-column">
                            <div class="grid-container">
                                <div class="imgbox">
                                    <img src="<?php echo $row['productimage'] ?>" alt="product">
                                </div>
                            </div>
                        </div>

                        <div class="productdetail-column">
                            <h3 name="productname">  <?php echo $row['productname'] ?></h3>
                            <!-- <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div> -->
                            <h2 name="productprice">Rs. <?php echo $row['productprice'] ?></h2>
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $retrieveUserID; ?>">
                            <input type="hidden" name="productname" value="<?php echo $row['productname']; ?>">
                            <input type="hidden" name="productimage" value="<?php echo $row['product_displayimage'] ?>">
                            <input type="hidden" name="productprice" value="<?php echo $row['productprice']; ?>">
                            <h4>Size*</h4>
                            <div class="sizediv">
                                    <input type="radio" name="xsmall" id="xsmall">
                                    <label for="xsmall">
                                        <p>XS</p>
                                    </label>

                                    <input type="radio" name="small" id="small">
                                    <label for="small">
                                        <p>S</p>
                                    </label>

                                    <input type="radio" name="medium" id="medium">
                                    <label for="medium">
                                        <p>M</p>	
                                    </label>

                                    <input type="radio" name="large" id="large">
                                    <label for="large">
                                        <p>L</p>
                                    </label>
                                    
                                    <input type="radio" name="xl" id="xl">
                                    <label for="xl">
                                        <p>XL</p>
                                    </label>
                            </div>
                            <a href="sizeguide.pdf">Size Guide</a>
                            <input type="submit" name="addtocart-button" id="addtocart-button" value="Add to Cart" class="addtocart-button">
                </form>
                            <div class="header-name">
                                <!-- <img src=""> -->
                                <hr>
                            </div>
                            
                            <div class="detailsbox">
                                <h3>Details:</h3>
                                <p name="productdetails" class="productdescription">
                                <?php echo $row['product_details'] ?>
                                </p>
                                <h3>Features</h3>
                                <p name="productfeatures">
                                <?php echo $row['product_features'] ?>
                                </p>
                                <h3>Content + Care</h3>
                                <p name="productcare">
                                <?php echo $row['product_content'] ?>
                                </p>
                                <h3>Size + Fit</h3>
                                <p name="productsize">
                                <?php echo $row['product_size'] ?>
                                </p>
                            </div>
                            
                            <!----meow----->
                        </div>
                    </div>
                    <?php
                } else {
                    echo "Product not found!";
                }

                
                mysqli_free_result($result);
            } else {
                echo "Error: " . mysqli_error($connection);
            }
        } else {
           
            echo "Invalid request!";
        }

    
    mysqli_close($connection);
    ?>


    </div>
    <div class="product-reviewcontainer">
        <form method="post" action="add_review.php">
            <div class="addreviewscontainer">
                <label class="reviewtextbox-label" for="reviewtextbox">Rate the product:</label>
                <div class="userreviewrate">
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="star1"></label>

                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="star2"></label>

                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="star3"></label>

                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="star4"></label>

                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="star5"></label>
                </div>

                <div class="reviewtextbox-div">
                    <input type="text" name="product_id" value="<?php echo $row['product_id']; ?>">
                    
                    <label class="reviewtextbox-label" for="reviewtextbox">Write a review:</label>
                    <textarea class="reviewtextbox" id="reviewtextbox" name="reviewtextbox"></textarea>
                </div>
                <a href="productpage.php?id=<?php echo $row['product_id'] ?>&productname=<?php echo $row['productname'] ?>">
                <input type="submit" name="addreviewbtn" id="addreview-btn" class="addreview-btn" value="Add Review" />
            </div>
        </form> 


        <div class="existingreviewscontainer">
            <div class="reviews inproductreviews">
            <div class="box-container">
                <?php
                
                $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

                if (!$connection) {
                    die("Connection failed");
                }

               
                if (isset($_GET['id'])) {
                    $productId = $_GET['id'];
                    $productName = $_GET['productname'];

                  
                    $sql = "SELECT r.*, c.userimage FROM `reviews` r
                            INNER JOIN `customers` c ON r.customer_id = c.customer_id
                            WHERE r.`productname` LIKE '$productName'";
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
                                    <p name="review"><?php echo $row['description'] ?></p>
                                </div>
                            
                            <?php
                        }

                     
                        mysqli_free_result($result);
                    } else {
                        echo "Error: " . mysqli_error($connection);
                    }
                } else {
                  
                    echo "Invalid request!";
                }

              
                mysqli_close($connection);
                ?>
                </div>
            </div>

        </div>



    </div>
</div>



<footer>
    <?php include 'footer.php';?>
</footer>
    <script src="js/script.js"></script>


        <script>
  document.addEventListener("DOMContentLoaded", function () {
    const starInputs = document.querySelectorAll('.userreviewrate input');

    starInputs.forEach(input => {
      input.addEventListener('change', handleStarRating);
    });

    function handleStarRating(event) {
      const selectedRating = event.target.value;

      // Reset all stars to default color
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
</body>




</html>
