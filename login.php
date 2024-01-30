<?php
session_start(); 

$connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $useremail = $_POST["useremail"];
    $userpassword = $_POST["userpassword"];

    $sql = "SELECT * FROM customers WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $useremail, $userpassword);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
           
            $row_count = mysqli_num_rows($result);

            if ($row_count == 1) {
                
                $user_data = mysqli_fetch_assoc($result);

                $_SESSION["user_id"] = $user_data["customer_id"];
                $_SESSION["user_email"] = $user_data["email"];

                header("Location: index.php"); 
                exit();
            } else {
                $error_message = "Invalid email or password";
            }
        } else {
            $error_message = "Database error: " . mysqli_error($connection);
        }

        mysqli_stmt_close($stmt);
    } else {
        $error_message = "Statement preparation error: " . mysqli_error($connection);
    }
}


mysqli_close($connection);
?>




<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | OXO Threads</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.png">
  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>

<!-- NAVBAR -->
<?php include 'guestnavbar.php';?>
<!-- NAVBAR END -->

<div class="login-main-container">
    <div class="loginbackgroundcontainer">
        <div class="loginbackgroundcontainercol1">
        </div>
        <div class="loginbackgroundcontainercol2">
        </div>
    </div>
        <div class="logincontainer">
            <div class="logincontainercol1">
                <img src="img/loginimg.jpg" alt="login image">
            </div>
            <div class="logincontainercol2">
                <h1>Log In</h1>
                <!-- <form class="loginform" id="loginForm" onsubmit="submitForm(event)" action="login.php" method="post"> -->
                <form class="loginform" id="loginForm" action="login.php" method="post">
                    <div class="loginitemdiv-container">
                        <div class="loginitemdiv">
                            <label class="loginlabel" for="email">Email:</label>
                            <input class="logininput"  type="email" id="email" name="useremail" required>
                        </div>
                        <div class="loginitemdiv">
                            <label class="loginlabel" for="password">Password:</label>
                            <input class="logininput"  type="password" id="password" name="userpassword" required>
                            <div style="display:flex; flex-direction: row;">
                            <input type="checkbox" onclick="showPassword()">Show Password
                            </div>
                        </div>
                        <div class="loginitemdiv">
                            <button class="loginbutton" name="btnsubmit" id="btnsubmit" type="submit">Log In</button>
                        </div>
                        <div class="loginitemdiv">
                            <a href="register.php">Not registered customer? Register now!</a>
                        </div>
                        <div class="loginitemdiv">
                            <a href="admin-login.php">You're an admin of ours? Login Here!</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
</div>

<script>
function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>


<footer>
    <?php include 'guestfooter.php';?>
</footer>


</body>


<?php

?>

</html>
