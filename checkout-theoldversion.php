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

<div class="header-name">
    <h3>Checkout Items</h3>
    <img src="img/headingline.png">
</div>

<div class="checkoutcontainer-main">

    <div class="checkoutcontainer">
                
        <div class="checkoutcolumn-table">
            <table class="checkout-itemtable">
                <tr>
                    <th style="width: 10%;">Product</th>
                    <th>Details</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
                <tr>
                    <td>
                        <img src="img/bottomwear/1.webp">
                    </td>
                    <td>
                        <div class="checkout-itemdetails">
                            <h3>Smiley Blink Oversized T shirt</h3>
                            <p>Size: XL</p>
                            <p>Price: Rs. 1270.00</p>
                        </div>
                    </td>
                    <td>
                        <select>
                            <?php
                                for ($i=1; $i<=100; $i++)
                                {
                                    ?>
                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        
                    </td>
                    <td>Rs. 1270.00</td>
                </tr>
                <tr>
                    <td>
                        <img src="img/bottomwear/2.webp">
                    </td>
                    <td>
                        <div class="checkout-itemdetails">
                            <h3>Smiley Blink Oversized T shirt</h3>
                            <p>Size: L</p>
                            <p>Price: Rs. 4160.00</p>
                        </div>
                    </td>
                    <td>
                        <select>
                            <?php
                                for ($i=1; $i<=150; $i++)
                                {
                                    ?>
                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                    <td>Rs. 4160.00</td>
                </tr>
                <tr>
                    <td>
                        <img src="img/bottomwear/3.webp">
                    </td>
                    <td>
                        <div class="checkout-itemdetails">
                            <h3>Smiley Blink Oversized T shirt</h3>
                            <p>Size: S</p>
                            <p>Price: Rs. 1100.00</p>
                        </div>
                    </td>
                    <td>
                        <!-- <select name="quantity" id="itemquantity">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select> -->
                        <select class="select-dropdown">
                            <?php
                                for ($i=1; $i<=150; $i++)
                                {
                                    ?>
                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php
                                }
                            ?>
                        </select>

                    </td>
                    <td>Rs. 1100.00</td>
                </tr>
            </table>
        </div>
        <div class="checkoutcolumn-details">
            <div class="recieptcontainer">
                <div class="reciept">
                    <div class="reciept-col1">
                        <p>SubTotal:</p>
                        <p>Shipping:</p>
                        <p>Estimated Tax:</p>
                        <p class="receipttotal-p">Total:</p>
                    </div>
                    <div class="reciept-col2">
                        <p>Rs. 6530.00</p>
                        <p>Rs. 500.00</p>
                        <p>Rs. 30.00</p>
                        <p class="receipttotal-p">Rs. 7060.00</p>
                    </div>
                </div>

                <div class="paymentproceed-buttons-div">
                    <input class="checkoutpayementbutton" type="submit" value="Proceed to Checkout">
                    <p>We Accept:</p>
                    <img src="img/cards.png">
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
