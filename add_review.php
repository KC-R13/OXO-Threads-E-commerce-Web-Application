<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (!isset($_SESSION["user_id"])) {
        header('Location: login.php');
        exit();
    }

   
    $customerId = $_SESSION["user_id"];
    
    
    $connection = mysqli_connect("localhost", "root", "", "oxothreads", 3306);

    if (!$connection) {
        die("Connection failed");
    }

    $customerSql = "SELECT fname, lname FROM customers WHERE customer_id = '$customerId'";
    $customerResult = mysqli_query($connection, $customerSql);

    if ($customerResult && mysqli_num_rows($customerResult) > 0) {
        $customerRow = mysqli_fetch_assoc($customerResult);
        $fname = $customerRow['fname'];
        $lname = $customerRow['lname'];
    } else {
        
        die("Customer not found");
    }

    
    $productId = 74;
    $productSql = "SELECT productname FROM products WHERE product_id = '$productId'"; 
    $productResult = mysqli_query($connection, $productSql);

    if ($productResult && mysqli_num_rows($productResult) > 0) {
        $productRow = mysqli_fetch_assoc($productResult);
        $productname = $productRow['productname'];
    } else {
        
        die("Product not found");
    }

    
    $description = mysqli_real_escape_string($connection, $_POST["reviewtextbox"]);
    $stars = mysqli_real_escape_string($connection, $_POST["rate"]);
    $date = date("Y-m-d");

    
    $insertSql = "INSERT INTO reviews (customer_id, fname, lname, description, stars, productname, status, date)
                  VALUES ('$customerId', '$fname', '$lname', '$description', '$stars', '$productname', '$status', '$date')";

    if (mysqli_query($connection, $insertSql)) {
        // echo "Review added successfully";
        
        header('Location: productpage.php');

    } else {
        echo "Error adding review: " . mysqli_error($connection);
    }

    mysqli_close($connection);
}
?>
