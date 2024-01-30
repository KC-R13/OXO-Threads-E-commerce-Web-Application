<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header('Location: index.php');
    exit();
}

// var_dump($_POST['quantitys']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = mysqli_connect("localhost", "root", "", "oxothreads", 3306);

    if (!$connection) {
        die("Connection failed");
    }

    $customerId = $_SESSION["user_id"];

    if (isset($_POST['remove'])) {
        $removeCartId = $_POST['remove_cart_id'];

        // remove the item from shopping cart
        $sqlRemoveItem = "DELETE FROM `shopping_cart` WHERE `cart_id` = ? AND `customer_id` = ?";
        $stmtRemoveItem = mysqli_prepare($connection, $sqlRemoveItem);

        if ($stmtRemoveItem) {
            mysqli_stmt_bind_param($stmtRemoveItem, "ii", $removeCartId, $customerId);
            mysqli_stmt_execute($stmtRemoveItem);

            mysqli_stmt_close($stmtRemoveItem);
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    }

    if (isset($_POST['proceedcheckoutBtn'])) {
        //new record for checkout
        $checkoutDateTime = date('Y-m-d H:i:s');
        $sqlCheckout = "INSERT INTO `checkouts` (`customer_id`, `checkout_datetime`, `total_price`) VALUES (?, ?, ?)";
        $stmtCheckout = mysqli_prepare($connection, $sqlCheckout);

        if ($stmtCheckout) {
            $totalPrice = 0; 
            mysqli_stmt_bind_param($stmtCheckout, "iss", $customerId, $checkoutDateTime, $totalPrice);
            mysqli_stmt_execute($stmtCheckout);
            $checkoutId = mysqli_insert_id($connection); 
            mysqli_stmt_close($stmtCheckout); 

            //getting chekout items
            foreach ($_POST['cart_id'] as $cartId) {
                //getting shoping cart dtails
                $sqlProduct = "SELECT * FROM `shopping_cart` WHERE `cart_id` = ?";
                $stmtProduct = mysqli_prepare($connection, $sqlProduct);

                if ($stmtProduct) {
                    mysqli_stmt_bind_param($stmtProduct, "i", $cartId);
                    mysqli_stmt_execute($stmtProduct);
                    $resultProduct = mysqli_stmt_get_result($stmtProduct);

                    if ($resultProduct && $rowProduct = mysqli_fetch_assoc($resultProduct)) {
                        
                        $quantity = isset($_POST['quantitys'][$cartId]) ? intval($_POST['quantitys'][$cartId]) : 1;

                        $itemTotalPrice = $quantity * $rowProduct['price'];

                        $totalPrice += $itemTotalPrice;

                        $sqlItems = "INSERT INTO `checkout_items` (`checkout_id`, `product_id`, `size`, `quantitys`, `product_price`, `product_image`) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmtItemsLoop = mysqli_prepare($connection, $sqlItems);

                        if ($stmtItemsLoop) {
                            mysqli_stmt_bind_param($stmtItemsLoop, "iisids", $checkoutId, $rowProduct['product_id'], $rowProduct['size'], $quantity, $rowProduct['price'], $rowProduct['productimage']);
                            mysqli_stmt_execute($stmtItemsLoop);
                            mysqli_stmt_close($stmtItemsLoop);
                        } else {
                            echo "Error: " . mysqli_error($connection);
                        }
                    }

                    mysqli_stmt_close($stmtProduct);
                }
            }

            $sqlUpdateTotalPrice = "UPDATE `checkouts` SET `total_price` = ? WHERE `checkout_id` = ?";
            $stmtUpdateTotalPrice = mysqli_prepare($connection, $sqlUpdateTotalPrice);

            if ($stmtUpdateTotalPrice) {
                mysqli_stmt_bind_param($stmtUpdateTotalPrice, "di", $totalPrice, $checkoutId);
                mysqli_stmt_execute($stmtUpdateTotalPrice);
                mysqli_stmt_close($stmtUpdateTotalPrice);
            } else {
                echo "Error: " . mysqli_error($connection);
            }

            $sqlRemove = "DELETE FROM `shopping_cart` WHERE `customer_id` = ?";
            $stmtRemove = mysqli_prepare($connection, $sqlRemove);

            if ($stmtRemove) {
                mysqli_stmt_bind_param($stmtRemove, "i", $customerId);
                mysqli_stmt_execute($stmtRemove);
                mysqli_stmt_close($stmtRemove);
            } else {
                echo "Error: " . mysqli_error($connection);
            }
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    }

    mysqli_close($connection);
}
?>





<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | OXO Threads</title>
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

<div class="header-name checkout-itemheader">
    <h3>Checkout Items</h3>
    <!-- <img src="img/headingline.png"> -->
    <hr>
</div>

<div class="checkoutcontainer-main">

    <div class="checkoutcontainer">
        <form method="post" action="">
                        <div class="checkoutcolumn-table">
                            <!-- <form method="post" action=""> -->
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "oxothreads", 3306);

                            if (!$connection) {
                                die("Connection failed");
                            }

                            if (isset($_SESSION["user_id"])) {
                                $customerId = $_SESSION["user_id"];

                                $sql = "SELECT * FROM `shopping_cart` WHERE `customer_id` = ?";
                                $stmt = mysqli_prepare($connection, $sql);

                                if ($stmt) {
                                    mysqli_stmt_bind_param($stmt, "i", $customerId);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    if ($result) {
                                        
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            
                                            <div class="checkout-item-container">
                                                <div class="checkout-item-imagecol">
                                                    <img src="<?php echo $row['productimage'] ?>" alt="Product Image">
                                                </div>
                                                <div class="checkout-item-detailcol">
                                                    <div class="checkout-item-detailrow">
                                                        <h3>Price : Rs <span><?php echo $row['price'] ?></span></h3>
                                                    </div>
                                                    <div class="checkout-item-detailrow">
                                                        <h2><?php echo $row['product_name'] ?></h2>
                                                    </div>
                                                    <div class="checkout-item-detailrow">
                                                        <h2>Size : <span><?php echo $row['size'] ?></span></h2>
                                                    </div>
                                                    <div class="checkout-item-detailrow quantityrowflex">
                                                        <h2>Quantity: </h2>
                                                        <select name="quantitys[<?php echo $row['cart_id']; ?>]">
                                                            <?php
                                                            for ($i = 1; $i <= 100; $i++) {
                                                                $selected = ($i == $row['quantitys']) ? 'selected' : '';
                                                                echo "<option value=\"$i\" $selected>$i</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="checkout-item-detailrow">
                                                        <input type="hidden" name="remove_cart_id" value="<?php echo $row['cart_id']; ?>">
                                                        <input type="submit" name="remove" value="Remove" class="remove-button">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

                                            <input type="hidden" name="cart_id[]" value="<?php echo $row['cart_id']; ?>">
                                            <?php
                                        }

                                        
                                        mysqli_free_result($result);
                                    } else {
                                        echo "Error: " . mysqli_error($connection);
                                    }

                                    mysqli_stmt_close($stmt);
                                } else {
                                    echo "Error: " . mysqli_error($connection);
                                }
                            } else {
                              
                                echo "User not logged in!";
                            }

                          
                            mysqli_close($connection);
                            ?>
                            <!-- </form> -->
                        </div>




        
                    <div class="checkoutcolumn-details">
                        <div class="recieptcontainer">
                                <div class="reciept">
                                <div class="reciept-col1">
                                  
                                    <p class="receipttotal-p">Total:</p>
                                </div>
                                <div class="reciept-col2">
                                    <p name="total-price" class="receipttotal-p">Rs. <?php echo number_format($totalPrice, 2); ?></p>
                                </div>
                                </div>

                               
                                <input type="hidden" name="total_price" value="<?php echo $totalPrice; ?>">
                
                                
                                <!-- Checkout button -->
                                
                                <div class="paymentproceed-buttons-div">
                                    <input class="checkoutpayementbutton" type="submit" name="proceedcheckoutBtn" value="Proceed to Checkout">
                                    <p>We Accept:</p>
                                    <img src="img/cards.png">
                                </div>
                            
                        </div>
                    </div>
        </form>
    </div>


</div>
    

 




<footer>
    <?php include 'extrafooter.php';?>
</footer>

    <script src="js/script.js"></script>

</body>

</html>
