<?php
session_start();

// Check if product_id is set in the URL
if (!isset($_GET['product_id'])) {
    header('Location: admin-existingProducts.php'); 
    exit();
}

$connection = mysqli_connect("localhost", "root", "", "oxothreads", 3306);

if (!$connection) {
    die("Connection failed");
}

$product_id = mysqli_real_escape_string($connection, $_GET['product_id']);

$sql = "SELECT * FROM `products` WHERE `product_id` = $product_id";
$result = mysqli_query($connection, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
} else {
   
    die("Product not found");
}

mysqli_close($connection);

// Handle form submission
if (isset($_POST['editbtnSubmit'])) {
    $connection = mysqli_connect("localhost", "root", "", "oxothreads", 3306);

    if (!$connection) {
        die("Connection failed");
    }

  
    $updatedProductName = mysqli_real_escape_string($connection, $_POST['productname']);
    $updatedProductPrice = mysqli_real_escape_string($connection, $_POST['productprice']);
    $updatedProductCategory = mysqli_real_escape_string($connection, $_POST['productcategory']);
    $updatedProductDescription = mysqli_real_escape_string($connection, $_POST['productdescription']);
    $updatedProductFeatures = mysqli_real_escape_string($connection, $_POST['productfeatures']);
    $updatedProductCare = mysqli_real_escape_string($connection, $_POST['productcare']);
    $updatedProductSize = mysqli_real_escape_string($connection, $_POST['productsize']);

   
    $image = $product['productimage'];
    if ($_FILES['productimg']['name']) {
        $image = "uploads/" . basename($_FILES['productimg']['name']);
        move_uploaded_file(($_FILES['productimg']['tmp_name']), $image);
    }

    $displayimage = $product['product_displayimage'];
    if ($_FILES['productdisplayimg']['name']) {
        $displayimage = "uploads/" . basename($_FILES['productdisplayimg']['name']);
        move_uploaded_file(($_FILES['productdisplayimg']['tmp_name']), $displayimage);
    }


    $updateSql = "UPDATE `products` SET 
        `productname` = '$updatedProductName',
        `productprice` = '$updatedProductPrice',
        `productcategory` = '$updatedProductCategory',
        `product_details` = '$updatedProductDescription',
        `product_features` = '$updatedProductFeatures',
        `product_content` = '$updatedProductCare',
        `product_size` = '$updatedProductSize',
        `productimage` = '$image',
        `product_displayimage` = '$displayimage'
        WHERE `product_id` = $product_id";

    if (mysqli_query($connection, $updateSql)) {
        echo "Product updated successfully";
        header('Location: admin-existingProducts.php'); 
        exit();
    } else {
        echo "Error updating product: " . mysqli_error($connection);
    }

    mysqli_close($connection);
}
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Product | OXO Threads</title>
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
    
    <div class="admin-contentcolumn">
        <div class="adduser-col">
            <h1>Edit Product</h1>

          
            <form class="addproduct-form" id="editProductForm" name="editProductForm" method="post" onsubmit="submitForm(event)" enctype="multipart/form-data">
                
                <div class="addproductitemdiv-container">
                    
                    <div class="addproductitemdiv">
                        <label class="addproductlabel" for="productname">Product Name:</label>
                        <input class="addproductinput" type="text" id="productname" name="productname" value="<?php echo $product['productname']; ?>">
                    </div>
                    <div class="addproductitemdiv">
                        <label class="addproductlabel" for="productprice">Product Price:</label>
                        <input class="addproductinput" type="text" id="productprice" name="productprice" value="<?php echo $product['productprice']; ?>">
                    </div>
                    <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productcategory">Select Category:</label>
                            <select class="addproductselect minimal" id="productcategory" name="productcategory">
                                <option value=""><?php echo $product['productcategory']; ?></option>
                                <option value="dresses">Dresses</option>
                                <option value="bottomwear">Bottomwear</option>
                                <option value="loungewear">LoungeWear</option>
                                <option value="jumpsuits">Jumpsuits</option>
                                <option value="tees">Tees</option>
                                <option value="vintage">Vintage</option>
                                <option value="footwear">Footwear</option>
                            </select>
                        </div>
                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productimg">Select Product Overall Image: </label>
                            <input class="addproductimage" type="file" id="productimg" name="productimg" multiple>
                            <img style="width:100px; margin-bottom: 15px;" src="<?php echo $product['productimage']; ?>">
                        </div>
                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productdisplayimg">Select Product Display Image: </label>
                            <input class="addproductimage" type="file" id="productdisplayimg" name="productdisplayimg" multiple>
                            <img style="width:100px; margin-bottom: 15px;" src="<?php echo $product['product_displayimage']; ?>">
                        </div>
                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productdescription">Product Details:</label>
                            <textarea class="addproducttextarea" id="productdescription" name="productdescription"><?php echo $product['product_details']; ?></textarea>
                        </div>

                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productfeatures">Product Features:</label>
                            <textarea class="addproducttextarea" id="productfeatures" name="productfeatures"><?php echo $product['product_features']; ?></textarea>
                        </div>

                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productcontent">Product Content + Care:</label>
                            <textarea class="addproducttextarea" id="productcare" name="productcare"><?php echo $product['product_content']; ?></textarea>
                        </div>

                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productsize">Product Size + Fit:</label>
                            <textarea class="addproducttextarea" id="productsize" name="productsize"><?php echo $product['product_size']; ?></textarea>
                        </div>
                </div>

                <div class="addproductitemdiv-forbuttons">
                    <input id="editbtnSubmit" name="editbtnSubmit" class="editproductbutton" type="submit" value="Save Changes">
                    <a href="admin-existingProducts.php" class="addproductbutton">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="js/adminjs.js"></script>

</body>
</html>
