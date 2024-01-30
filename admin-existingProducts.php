<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Existing Products | OXO Threads</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.png">
  <!--  CSS -->
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
            <button class="nav-tab">Manage Contacts</button>
            <div class="nav-tab-panel">
                <div class="nav-tabbox">
                    <a href="admin-contactsubmissions.php">Review Submissions</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="admin-contentcolumn existingUserColumn">
        <h1>Existing Product List</h1>



                    <?php

                        $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

                        if (!$connection) {
                        die("Connection failed");
                        }

                        $sql = "SELECT * FROM `products` WHERE `status` = 1 ORDER BY `product_id` DESC";
                        $result = mysqli_query($connection, $sql);



                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                    ?>


                                    <div class="admin-existingproducts-existingproductsbox">
                                        <div class="admin-existingproducts-existingproductscol1">
                                            <h3 name="productid">Product ID: <?php echo $row['product_id'] ?></h3>
                                            <h2 name="productname"><?php echo $row['productname'] ?></h2>
                                            <p name="productprice">Rs. <?php echo $row['productprice'] ?></p>
                                            <p name="productcategory">Category: <?php echo $row['productcategory'] ?></p>

                                            <div class="admin-existingproducts-detailsrow">
                                                <h4>Details:</h4>
                                                <p name="productdetails"><?php echo $row['product_details'] ?></p>

                                                <h4>Features</h4>
                                                <p name="productfeatures"><?php echo $row['product_features'] ?></p>

                                                <h4>Content + Care</h4>
                                                <p name="productcare"><?php echo $row['product_content'] ?></p>

                                                <h4>Size + Fit</h4>
                                                <p name="productsize"><?php echo $row['product_size'] ?></p>
                                            </div>

                                        </div>
                                        <div class="admin-existingproducts-existingproductscol2">
                                        <!-- <h3>Display Images</h3> -->
                                            <div class="existingproduct-imagebox">
                                                <img src="<?php echo $row['productimage'] ?>" alt="product">
                                                <img src="<?php echo $row['product_displayimage'] ?>" alt="product">
                                            </div>
                                            <div class="existingproductsbuttons">
                                                
                                                <a href="admin-editproduct.php?product_id=<?php echo $row['product_id']; ?>" class="edit-button">Edit</a>

                                                
                                                <input type="button" value="Delete" class="delete-button" onclick="deleteProduct(<?php echo $row['product_id']; ?>)">
                                            </div>
                                        </div>
                                    </div>

                                    

                    <?php
                            }
                        }
                    mysqli_close(($connection));
                    ?>

    </div>
    
</div>

<script src="js/adminjs.js"></script>

<script>
    // JavaScript function to handle delete confirmation
function deleteProduct(productId) {
    var confirmDelete = confirm("Are you sure you want to delete this product?");
    if (confirmDelete) {
        // Redirect to delete-product.php with the product_id
        window.location.href = "delete-product.php?product_id=" + productId;
    }
}
</script>
</body>



</html>
