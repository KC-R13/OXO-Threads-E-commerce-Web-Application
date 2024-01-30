<?php
session_start();

// chck if user_id is set in url
if (!isset($_GET['user_id'])) {
    header('Location: useraccount-orderhistory.php');
    exit();
}

$connection = mysqli_connect("localhost", "root", "", "oxothreads", 3306);

if (!$connection) {
    die("Connection failed");
}

$user_id = mysqli_real_escape_string($connection, $_GET['user_id']);


$sql = "SELECT * FROM `customers` WHERE `customer_id` = $user_id";
$result = mysqli_query($connection, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $customer = mysqli_fetch_assoc($result);
} else {
   
    die("customer not found");
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order History | OXO Threads</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.png">
  <!-- CSS -->
  <link rel="stylesheet" href="css/userStyles.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<!-- NAVBAR -->
<?php include 'usernavbar.php';?>
<!-- NAVBAR END -->

<div class="usercontainer-main">
    <div class="user-nav-column">
        <div class="user-navtab">
            <button class="nav-tab">My Account</button>
            <div class="nav-tab-panel">
                <div class="nav-tabbox">
                    <a href="useraccount-editaccount.php?user_id=<?php echo $customer['customer_id']; ?>">Edit Information</a>
                    <a href="useraccount-orderhistory.php?user_id=<?php echo $customer['customer_id']; ?>">Order History</a>
                </div>
            </div>
          </div>
    </div>
    <div class="user-contentcolumn existingUserColumn">

        <h1>Order History</h1>


        <?php
        $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

        if (!$connection) {
            die("Connection failed");
        }

        $sql = "SELECT * FROM `checkouts` WHERE `customer_id` = $user_id";
        $result = mysqli_query($connection, $sql);

        if(mysqli_num_rows($result) > 0){
            while($checkoutRow = mysqli_fetch_assoc($result)){
                ?>
                <div class="admin-orderhistory-orderhistorybox">
                    <div class="admin-orderhistory-orderhistorycol1">
                        <h3 name="orderid">Order ID : <?php echo $checkoutRow['checkout_id'] ?></h3>
                        <p name="total_price">Total Price : <?php echo $checkoutRow['total_price'] ?></p>
                        <p name="orderdate">Date : <?php echo $checkoutRow['checkout_datetime'] ?></p>

                        <div class="admin-orderhistory-image-detailbox">

                            <?php

                            $sql2 = "SELECT ci.*, (SELECT productname FROM `products` WHERE product_id = ci.product_id) as productname
                                    FROM `checkout_items` ci
                                    WHERE ci.`checkout_id` = ?";
                            $stmt = mysqli_prepare($connection, $sql2);

                            if ($stmt) {
                                mysqli_stmt_bind_param($stmt, "i", $checkoutRow['checkout_id']);
                                mysqli_stmt_execute($stmt);
                                $result2 = mysqli_stmt_get_result($stmt);

                                if(mysqli_num_rows($result2) > 0){
                                    while($itemRow = mysqli_fetch_assoc($result2)){
                                        ?>
                                        <div class="admin-orderhistory-image-detailrow">
                                            <div class="admin-orderhistory-imagecol">
                                                <img name="product_displayimage" src="<?php echo $itemRow['product_image'] ?>">
                                            </div>
                                            <div class="admin-orderhistory-detailcol">
                                                <p name="productname">Product Name : <?php echo $itemRow['productname'] ?></p>
                                                <p name="productid">Product ID : <?php echo $itemRow['product_id'] ?></p>
                                                <p name="size">Size : <?php echo $itemRow['size'] ?></p>
                                                <p name="quantity">Quantity : <?php echo $itemRow['quantitys'] ?></p>
                                                <p name="product_price">Price : <?php echo $itemRow['product_price'] ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                mysqli_stmt_close($stmt);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        mysqli_close($connection);
        ?>


        
        
        <!-- <div class="orderhistorybox">
            <div class="orderhistorycol1">
                <h3>Order ID : 12713</h3>
                <p>2023.11.26</p>
                <div class="image-detailrow">
                    <div class="imagecol">
                        <img src="img/dresses/1.webp">
                    </div>
                    <div class="detailcol">
                        <p>Smiley Blink Oversized Tshirt</p>
                        <p>Size: XL</p>
                        <p>Price: 2380.00</p>
                        <a href="receipt.pdf" class="orderdetailbutton">
                            Details
                        </a>
                    </div>
                </div>
            </div>
            <div class="orderhistorycol2">
                <button disabled>Shipped</button>
                <button disabled>Paid</button>
            </div>
        </div> -->

        

        
        
    </div>
    
</div>

<script src="js/adminjs.js"></script>
</body>

</html>
