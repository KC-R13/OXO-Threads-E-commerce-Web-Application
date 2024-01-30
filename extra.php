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

            $sql = "SELECT * FROM `products` WHERE `product_id` = 20";
            $result = mysqli_query($connection, $sql);



            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
        ?>

        <div class="productimg-column">
            <div class="grid-container">
                <div class="imgbox">
                    <img src="<?php echo $row['productimage'] ?>" alt="prod 1">
                </div>
                
            </div>
        </div>

        <div class="productdetail-column">
            <h3><?php echo $row['productname'] ?></h3>
            <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <!-- <p>(127)</p> -->
            </div>
            <h2>Rs. 6300.00</h2>
            <h4>Size*</h4>
            <div class="sizediv">
                    <input type="radio" name="size" id="xsmall">
                    <label for="xsmall">
                        <p>XS</p>
                    </label>

                    <input type="radio" name="size" id="small">
                    <label for="small">
                        <p>S</p>
                    </label>

                    <input type="radio" name="size" id="medium">
                    <label for="medium">
                        <p>M</p>	
                    </label>

                    <input type="radio" name="size" id="large">
                    <label for="large">
                        <p>L</p>
                    </label>
                    
                    <input type="radio" name="size" id="xl">
                    <label for="xl">
                        <p>XL</p>
                    </label>
            </div>
            <a href="sizeguide.pdf">Size Guide</a>
            <input type="submit" value="Add to Cart" class="addtocart-button">

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
        </div>


        <?php
                }
            }
        // mysqli_close(($conn));
        ?>

    </div>
    <div class="product-reviewcontainer">
        <div class="addreviewscontainer">
            <label class="reviewtextbox-label" for="reviewtextbox">Rate the product:</label>
            <div class="userreviewrate">
                <input type="radio" id="star5" name="rate" value="5" />
                <label for="star5" title="star5">5 stars</label>
                <input type="radio" id="star4" name="rate" value="4" />
                <label for="star4" title="star4">4 stars</label>
                <input type="radio" id="star3" name="rate" value="3" />
                <label for="star3" title="star2">3 stars</label>
                <input type="radio" id="star2" name="rate" value="2" />
                <label for="star2" title="2 star">2 stars</label>
                <input type="radio" id="star1" name="rate" value="1" />
                <label for="star1" title="1 star">1 star</label>
            </div>

            <div class="reviewtextbox-div">
                <label class="reviewtextbox-label" for="reviewtextbox">Write a review:</label>
                <textarea class="reviewtextbox" id="reviewtextbox" name="reviewtextbox"></textarea>
            </div>

            <input type="submit" class="addreview-btn" value="Add Review" />

        </div>
        <div class="existingreviewscontainer">
            <div class="reviews inproductreviews">

                <div class="box-container">

                    <div class="box">
                        <div class="user">
                            <img src="img/users/user1.png" alt="">
                            <div>
                                <h3>Lee Mark</h3>
                                <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p>Love this store! The quality of their clothes is amazing. 
                            The fit is perfect, and the prices are reasonable. I'm a happy customer.
                            </p>
                    </div>

                    <div class="box">
                        <div class="user">
                            <img src="img/users/user2.png" alt="">
                            <div>
                                <h3>Choi San</h3>
                                <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p>Great place to find unique outfits. 
                            Quality is good, but sizing can be a bit inconsistent (Use UK sizing!). Overall, a solid choice for fashion.</p>
                    </div>

                    <div class="box">
                        <div class="user">
                            <img src="img/users/user3.png" alt="">
                            <div>
                                <h3>Baby Tiger</h3>
                                <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                
                                </div>
                            </div>
                        </div>
                        <p>I'm a repeat customer because this site never disappoints. 
                            My wardrobe is full of their clothes, and I've never had a bad experience.</p>
                    </div>

                    <div class="box">
                        <div class="user">
                            <img src="img/users/user4.png" alt="">
                            <div>
                                <h3>The Neo King</h3>
                                <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p>This store always has the latest fashion. 
                            It's a reliable source for my trendy wardrobe. Quick shipping and no-fuss shopping!</p>
                    </div>

                    <div class="box">
                        <div class="user">
                            <img src="img/users/user5.png" alt="">
                            <div>
                                <h3>Edward the 127th</h3>
                                <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p>Fantastic variety and pretty affordable prices. 
                            Just wish the shipping would be faster, but then again quality and comfort makes up for it. </p>
                    </div>

                    <div class="box">
                        <div class="user">
                            <img src="img/users/user6.png" alt="">
                            <div>
                                <h3>Kim Edward</h3>
                                <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p>Nice place to shop for fashion. 
                            The delivery took a bit longer
                            but the clothes were worth the wait. Good value for money.</p>
                    </div>

                    <div class="box">
                        <div class="user">
                            <img src="img/users/user7.png" alt="">
                            <div>
                                <h3>Deathcore Fairy</h3>
                                <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p>Excellent experience! The clothes are stylish and comfortable. 
                            Fast shipping & everything in perfect condition. Highly recommended!</p>
                    </div>

                    <div class="box">
                        <div class="user">
                            <img src="img/users/user8.png" alt="">
                            <div>
                                <h3>Happy Pills UWU</h3>
                                <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p>Outstanding quality and service! The clothes feel premium, 
                            and the website is user-friendly. I'll be a repeat customer for sure.</p>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>



<footer>
    <?php include 'footer.php';?>
</footer>
    <script src="js/script.js"></script>
</body>

</html>
