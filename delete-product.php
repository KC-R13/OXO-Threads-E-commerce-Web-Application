<?php

if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

    if (!$connection) {
        die("Connection failed");
    }

    
    $sql = "DELETE FROM `products` WHERE `product_id` = $product_id";

    if (mysqli_query($connection, $sql)) {
        echo "Product deleted successfully!";
    } else {
        echo "Error deleting product: " . mysqli_error($connection);
    }

    mysqli_close($connection);
} else {
    echo "Invalid product ID.";
}

header("Location: admin-existingProducts.php");
exit();
?>
