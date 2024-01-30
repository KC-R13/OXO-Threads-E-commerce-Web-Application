<?php

$connection = mysqli_connect("localhost", "root", "", "oxothreads", 3306);


if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $customerId = $_POST['user_id']; 

    
    $productId = $_POST['product_id']; 
    $productName = $_POST['productname'];
    $productPrice = $_POST['productprice'];
    $productImage = $_POST['productimage'];

    
    $size = isset($_POST['size']) ? $_POST['size'] : '';

      
        if (isset($_POST['xsmall'])) {
            $size = 'XS';
        } elseif (isset($_POST['small'])) {
            $size = 'S';
        } elseif (isset($_POST['medium'])) {
            $size = 'M';
        } elseif (isset($_POST['large'])) {
            $size = 'L';
        } elseif (isset($_POST['xl'])) {
            $size = 'XL';
        }

   
    $quantity = 1;

  
    $sql = "INSERT INTO shopping_cart (customer_id, product_id, product_name, quantity, size, price, productimage) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($connection, $sql);

    mysqli_stmt_bind_param($stmt, "iisisds", $customerId, $productId, $productName, $quantity, $size, $productPrice, $productImage);
    mysqli_stmt_execute($stmt); 

    $cartId = mysqli_insert_id($connection);

    header("Location: checkout.php?id=$cartId");
    exit();
}

mysqli_close($connection);
?>
