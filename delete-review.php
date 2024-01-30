<?php

if (isset($_GET['reviewid']) && is_numeric($_GET['reviewid'])) {
    $review_id = $_GET['reviewid'];

    $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

    if (!$connection) {
        die("Connection failed");
    }

    $sql = "DELETE FROM `reviews` WHERE `reviewid` = $review_id";

    if (mysqli_query($connection, $sql)) {
        echo "review deleted successfully!";
    } else {
        echo "Error deleting product: " . mysqli_error($connection);
    }

    mysqli_close($connection);
} else {
    echo "Invalid review ID.";
}

header("Location: admin-faqs.php");
exit();
?>
