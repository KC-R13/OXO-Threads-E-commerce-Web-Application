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
<?php include 'adminnavbar.php';?>
<!-- NAVBAR END -->

<div class="admincontainer-main">
    <div class="admin-nav-column">
        <div class="admin-navtab">
            <button class="nav-tab">Manage Users</button>
            <div class="nav-tab-panel">
                <div class="nav-tabbox">
                    <a href="admin-addUsers.php">Add Admins</a>
                    <a href="admin-existingUsers.php">Existing Customers</a>
                    <a href="admin-existingAdmins.php">Existing Admins</a>
                </div>
            </div>
        </div>

        <div class="admin-navtab">
            <button class="nav-tab">Manage Orders</button>
            <div class="nav-tab-panel">
                <div class="nav-tabbox">
                    <a href="admin-orderHistory.php">Order History</a>
                </div>
            </div>
        </div>

        <div class="admin-navtab">
            <button class="nav-tab">Manage Products</button>
            <div class="nav-tab-panel">
                <div class="nav-tabbox">
                    <a href="admin-addNewProducts.php">Add New Products</a>
                </div>
                <div class="nav-tabbox">
                    <a href="admin-existingProducts.php">Edit Existing Products</a>
                </div>
            </div>
        </div>

        <div class="admin-navtab">
            <button class="nav-tab">Manage FAQs</button>
            <div class="nav-tab-panel">
                <div class="nav-tabbox">
                    <a href="admin-faqs.php">Review FAQs</a>
                </div>
            </div>
        </div>
        <div class="admin-navtab">
            <button class="nav-tab">Manage Contacts</button>
            <div class="nav-tab-panel">
                <div class="nav-tabbox">
                    <a href="admin-contactsubmissions.php">Review Submissions</a>
                </div>
            </div>
        </div>
    </div>
    <div class="admin-contentcolumn existingUserColumn">
        <h1>Order History</h1>

        <?php
        $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

        if (!$connection) {
            die("Connection failed");
        }

        $sql = "SELECT * FROM `checkouts`";
        $result = mysqli_query($connection, $sql);

        if(mysqli_num_rows($result) > 0){
            while($checkoutRow = mysqli_fetch_assoc($result)){
                ?>
                <div class="admin-orderhistory-orderhistorybox">
                    <div class="admin-orderhistory-orderhistorycol1">
                        <h3 name="orderid">Order ID : <?php echo $checkoutRow['checkout_id'] ?></h3>
                        <p name="total_price">Total Price : <?php echo $checkoutRow['total_price'] ?></p>
                        <p name="orderdate">Date : <?php echo $checkoutRow['checkout_datetime'] ?></p>
                        <p name="cust_id">Customer ID : <?php echo $checkoutRow['customer_id'] ?></p>

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

                    <div class="admin-orderhistory-orderhistorycol2">
                        <div style="width:100%;">
                            <div class="orderstatusbuttons">
                                <input type="submit" name="completed" value="Completed" class="">
                                <input type="submit" name="pending" value="Pending" class="">
                            </div>
                            <div class="paymentstatusbuttons">
                                <input type="submit" name="paid" value="Paid" class="">
                                <input type="submit" name="unpaid" value="Unpaid" class="">
                            </div>
                        </div>
                        <div style="width:100%;">
                            <a href="receipt.pdf" class="admin-orderhistory-orderdetailbutton">
                                Details
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        mysqli_close($connection);
        ?>
    </div>
</div>

<script src="js/adminjs.js"></script>
</body>
</html>
