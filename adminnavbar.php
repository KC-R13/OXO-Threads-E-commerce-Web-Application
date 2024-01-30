<?php
session_start();

include 'db_connection.php';

$userLink = '';

if (isset($_SESSION["admin_id"])) {
    $adminId = $_SESSION["admin_id"];

    $sql = "SELECT username, email, phone, password, confirm_password, status FROM admin WHERE admin_id = '$adminId'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $email = $row['email'];
        $phone = $row['phone'];
        $userLink = '<a style="color:#fff;" href="admin-addUsers.php">' . $username . '</a>';
    }
}

if (isset($_SESSION["admin_id"])) {
    // Admin is logged in
    $userLink = '<a style="color:#fff;" href="admin-addUsers.php">' . $username . '</a>';
} elseif (isset($_SESSION["user_id"])) {
    // Customer is logged in
    $userLink = '<a style="color:#fff;" href="useraccount-editaccount.php">' . $customerName . '</a>';
} else {
    // User is not logged in, then redirect
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>taeoxo</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.png">

  <!--  CSS -->
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
                                <?php echo $userLink; ?>
                                <a href="#"><img src="img/icons/myaccount.png" alt="account"></a>
                                    <ul class="dropdown1">
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
                        
                    </ul>
                </div>

                <div class="row2-25">
                    
                </div>
    
            </div>

        </div>
    
</div>

<!-- navbar ends -->

    <script src="js/script.js"></script>
</body>

</html>
