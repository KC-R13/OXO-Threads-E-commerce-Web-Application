<?php
session_start();

if (isset($_POST['btnSubmit'])) {
  
    $productname = $_POST['productname'];
    $productprice = $_POST['productprice'];
    $productcategory = $_POST['productcategory'];
    $productdescription = $_POST['productdescription'];
    $productfeatures = $_POST['productfeatures'];
    $productcare = $_POST['productcare'];
    $productsize = $_POST['productsize'];
    $status = 1;

    $image = "uploads/" . basename($_FILES['productimg']['name']);
    move_uploaded_file(($_FILES['productimg']['tmp_name']), $image);

    $displayimage = "uploads/" . basename($_FILES['productdisplayimg']['name']);
    move_uploaded_file(($_FILES['productdisplayimg']['tmp_name']), $displayimage);

    $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

    if (!$connection) {
        die("Connection failed");
    }

    $sql = "INSERT INTO `products` (`product_id`, `productname`, `product_details`, `product_content`, `product_features`, `product_size`, `productcategory`, `productimage`, `product_displayimage` , `productprice`, `status`)
    VALUES (NULL, '$productname', '$productdescription', '$productcare', '$productfeatures', '$productsize', '$productcategory', '$image', '$displayimage', '$productprice', '$status')";

    if (mysqli_query($connection, $sql)) {
        echo "Product uploaded successfully";
    } else {
        echo "Something went wrong!";
    }

    $connection->close();

    // to avoid resubmission
    header("Location: admin-existingProducts.php");
    exit();
}
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Products | OXO Threads</title>
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
                <h1>Add a New Product</h1>

                <form class="addproduct-form" id="addProductForm" name="addProductForm" method="post" onsubmit="submitForm(event)" enctype="multipart/form-data">
                    <div class="addproductitemdiv-container">
                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productname">Product Name:</label>
                            <input class="addproductinput" type="text" id="productname" name="productname">
                        </div>
                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productprice">Product Price:</label>
                            <input class="addproductinput" type="text" id="productprice" name="productprice">
                        </div>
                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productcategory">Select Category:</label>
                            <select class="addproductselect minimal" id="productcategory" name="productcategory">
                                <option value="">Select a category</option>
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
                        </div>
                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productdisplayimg">Select Product Display Image: </label>
                            <input class="addproductimage" type="file" id="productdisplayimg" name="productdisplayimg" multiple>
                        </div>
                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productdescription">Product Details:</label>
                            <textarea class="addproducttextarea" id="productdescription" name="productdescription"></textarea>
                        </div>

                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productfeatures">Product Features:</label>
                            <textarea class="addproducttextarea" id="productfeatures" name="productfeatures"></textarea>
                        </div>

                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productcontent">Product Content + Care:</label>
                            <textarea class="addproducttextarea" id="productcare" name="productcare"></textarea>
                        </div>

                        <div class="addproductitemdiv">
                            <label class="addproductlabel" for="productsize">Product Size + Fit:</label>
                            <textarea class="addproducttextarea" id="productsize" name="productsize"></textarea>
                        </div>

                        <div class="addproductitemdiv-forbuttons">
                            <input id="btnSubmit" name="btnSubmit" class="addproductbutton" type="submit">
                            <input id="btnReset" name="btnReset" class="addproductbutton" type="reset" onclick="resetForm()">
                        </div>
                    </div>
                </form>
            </div>
    </div>
    
</div>

<!-- 
<footer>
    <php include 'guestfooter.php';?>
</footer> -->


<script>

function submitForm(event) {
    event.preventDefault(); // Prevent the form from submitting initially

    // Get form input values
    const productName = document.getElementById('productname').value;
    const productPrice = document.getElementById('productprice').value;
    const productCategory = document.getElementById('productcategory').value;
    // const productFeatured = document.getElementById('productfeatured').value;
    const productImages = document.getElementById('productimg').files;
    const productDescription = document.getElementById('productdescription').value;

    if (productName.trim() === '') 
    {
        alert('Please add a product name');
        return;
    }

    if (productPrice.trim() === '') {
        alert('Please add a product price');
        return;
    }

    if (productCategory === '') {
        alert('Please add a product category');
        return;
    }

    if (productDescription.trim() === '') {
        alert('Please add a product description');
        return;
    }

    // Validate product price as a number
    if (isNaN(parseFloat(productPrice))) {
        alert('Product price must be a valid number.');
        return;
    }


    //submit the form
    document.getElementById('addProductForm').submit();
}

function resetForm() {
    document.getElementById('addProductForm').reset();
}

</script>


<script src="js/adminjs.js"></script>

</body>





<?php
// if (isset($_POST['btnSubmit'])) {
//     // Retrieve form data
//     $productname = $_POST['productname'];
//     $productprice = $_POST['productprice'];
//     $productcategory = $_POST['productcategory'];
//     $productdescription = $_POST['productdescription'];
//     $productfeatures = $_POST['productfeatures'];
//     $productcare = $_POST['productcare'];
//     $productsize = $_POST['productsize'];
//     $status = 1;

//     $image = "uploads/" . basename($_FILES['productimg']['name']);
//     move_uploaded_file(($_FILES['productimg']['tmp_name']), $image);

//     $displayimage = "uploads/" . basename($_FILES['productdisplayimg']['name']);
//     move_uploaded_file(($_FILES['productdisplayimg']['tmp_name']), $displayimage);

//     $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

//     if (!$connection) {
//         die("Connection failed");
//     }

//     // SQL query to insert data into the "products" table
//     $sql = "INSERT INTO `products` (`product_id`, `productname`, `product_details`, `product_content`, `product_features`, `product_size`, `productcategory`, `productimage`, `product_displayimage` , `productprice`, `status`)
//     VALUES (NULL, '" . $productname . "', '" . $productdescription . "', '" . $productcare . "', '" . $productfeatures . "', '" . $productsize . "', '" . $productcategory . "', '" . $image . "', '" . $displayimage . "', '" . $productprice . "', '" . $status . "')";

//     if (mysqli_query($connection, $sql)) {
//         echo "Creation uploaded successfully";
//     } else {
//         echo "Something went wrong!";
//     }

//     // Close the database connection
//     $connection->close();
// }
?>

</html>
