<?php
session_start();

include 'db_connection.php';


if (isset($_SESSION["user_id"])) {
    $customerId = $_SESSION["user_id"];

    $sql = "SELECT fname, lname, email, telephone, userimage, password, confirmpassword, status FROM customers WHERE customer_id = '$customerId'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
        $customerName = $row['fname'];
        $email = $row['email'];
        $phone = $row['telephone'];
        $userImage = $row['userimage'] ? $row['userimage'] : $userImage;

        $retrieveUserID = $customerId;
        $userLink = '<a style="color:#fff;" href="useraccount-editaccount.php">' . $customerName . '</a>';
        $userImageLink = isset($_SESSION["user_id"]) ? 'useraccount-editaccount.php' : 'login.php';
    }
}

$userLink = ''; 

if (isset($_SESSION["admin_id"])) {
    // Admin is logged in, 
    $userLink = '<a style="color:#fff;" href="admin-addUsers.php?admin_id">' . $username . '</a>';
} elseif (isset($_SESSION["user_id"])) {
    // Customer is logged in
    $userLink = '<a style="color:#fff;" href="useraccount-editaccount.php?user_id=' . $_SESSION["user_id"] . '">' . $customerName . '</a>';
    $retrieveUserID = $customerId;
} else {
    // User is not logged in
    $userLink = '<a style="color:#fff;" href="login.php"> login </a>';
}


if (isset($_SESSION["user_id"])) {
    $userLink .= '<a style="color:#fff;" href="useraccount-editaccount.php?user_id=' . $_SESSION["user_id"] . '"></a>';
    $retrieveUserID = $customerId;
}


if (isset($_SESSION["admin_id"])) {
    $userLink .= '<a style="color:#fff;" href="admin-addUsers.php?admin_id"></a>';
}




?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>taeoxo</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.png">

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>

<!-- Navbar start -->
<div class="navbar guestnavbar">

        <!-- THE SECOND ROW START -->
        <div>

            <!-- second second row -->

            <div class="row1 row1-height row1-second"> 
                <div class="row1-80">
                <a href="index.php"><img class="logo-image" src="img/logo-black.png" alt="logo"></a>
                </div>

                <div class="row1-20">
                        <ul class="nav-list">
                            <li class="nav-item">
                                <a href="checkout.php">
                                    <img src="img/icons/cart.png" alt="shoppingcart">
                                    <!-- <span class="itemNoBadge">3</span> -->
                                </a>
                            </li>
                            <li class="nav-item">
                                <?php echo $userLink; ?>
                                <a href="#"><img src="img/icons/myaccount.png" alt="account"></a>
                                    <ul class="dropdown1">
                                        <!-- <li class="dropdown1-item"><a href="useraccount-editaccount.php">User Account</a></li>
                                        <li class="dropdown1-item"><a href="admin-addUsers.php">Admin Account</a></li> -->
                                        <!-- <li class="dropdown1-item"><a href="login.php">Login</a></li>
                                        <li class="dropdown1-item"><a href="register.php">Register</a></li> -->
                                        <li class="dropdown1-item"><a href="logout.php">Sign Out</a></li>
                                    </ul>
                            </li>
                        </ul>
                </div>         
            </div>

            <!-- second third row -->
            <div class="row2">
                <div class="row2-75">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a href="index.php">Home</a>
                        </li>
                        
                        <!-- <li class="nav-item">
                            <a href="#">Collection</a>
                            <div class="collectiondropdown">
                                    <ul class="dropdown">
                                        <h3>Shop by Categories</h3>
                                        <li class="dropdown-item"><a href="dresses.php">Dresses</a></li>
                                        <li class="dropdown-item"><a href="jumpsuits.php">Rompers/Jumpsuits</a></li>
                                        <li class="dropdown-item"><a href="bottomwear.php">BottomWear</a></li>
                                        <li class="dropdown-item"><a href="loungewear.php">Loungewear</a></li>
                                        <li class="dropdown-item"><a href="tees.php">Tees/Graphic Tees</a></li>
                                        <li class="dropdown-item"><a href="vintage.php">Vintage</a></li>
                                    </ul>
                                    <ul class="dropdown">
                                        <h3>Shop by Brands</h3>
                                        <li class="dropdown-item"><a href="levi.php">Levi's®</a></li>
                                        <li class="dropdown-item"><a href="adidas.php">ADIDAS</a></li>
                                        <li class="dropdown-item"><a href="gucci.php">GUCCI</a></li>
                                        <li class="dropdown-item"><a href="ysl.php">YSL</a></li>
                                    </ul>
                                    <ul class="dropdown">
                                        <h3>Featured</h3>
                                        <li class="dropdown-item"><a href="newarrivals.php">New Arrivals</a></li>
                                        <li class="dropdown-item"><a href="summer.php">Summer Collection</a></li>
                                        <li class="dropdown-item"><a href="fall.php">Fall Collection</a></li>
                                        <li class="dropdown-item"><a href="winter.php">Winter Collection</a></li>
                                        <li class="dropdown-item"><a href="sanrio.php">Sanrio Collection</a></li>
                                        <li class="dropdown-item"><a href="tokyofashionweek.php">Tokyo Fashion Week Fits</a></li>
                                    </ul>

                            </div>
                        </li> -->
                        <li class="nav-item">
                            <a href="aboutus.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="contactus.php">Contact Us</a>
                        </li>
                    </ul>
                </div>

                <div class="row2-25">
                    <div class="column">
                        <input type="text" id="box" placeholder="Search anything..." class="search__box">
                        <a href="#" id="icon" onclick="toggleShow()"><img src="img/icons/search.png" alt="search"></a>
                    </div>
                </div>
    
            </div>

        </div>
    
</div>

<!-- navbar ends -->

    <script src="js/script.js"></script>
</body>

</html>
