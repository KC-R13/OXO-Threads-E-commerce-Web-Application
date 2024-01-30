<?php
session_start(); 
$connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $adminemail = $_POST["adminemail"];
    $adminpassword = $_POST["adminpassword"];

    
    $sql = "SELECT * FROM admin WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $adminemail, $adminpassword);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            
            $row_count = mysqli_num_rows($result);

            if ($row_count == 1) {
                
                $admin_data = mysqli_fetch_assoc($result);

                $_SESSION["admin_id"] = $admin_data["admin_id"];
                $_SESSION["admin_email"] = $admin_data["email"];

                header("Location: admin-addUsers.php"); 
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
  <title>Login Admin | OXO Threads</title>
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
                <img src="img/admin.jpg" alt="login image">
            </div>
            <div class="logincontainercol2">
                <h1>Log In (Admin)</h1>
                <!-- <form class="loginform" id="loginForm" onsubmit="submitForm(event)" action="login.php" method="post"> -->
                <form class="loginform" id="loginForm" action="admin-login.php" method="post">
                    <div class="loginitemdiv-container">
                        <div class="loginitemdiv">
                            <label class="loginlabel" for="email">Email:</label>
                            <input class="logininput"  type="email" id="email" name="adminemail" required>
                        </div>
                        <div class="loginitemdiv">
                            <label class="loginlabel" for="password">Password:</label>
                            <input class="logininput"  type="password" id="password" name="adminpassword" required>
                            <div style="display:flex; flex-direction: row;">
                            <input type="checkbox" onclick="showPassword()">Show Password
                            </div>
                        </div>
                        <div class="loginitemdiv">
                            <button class="loginbutton" name="adminbtnsubmit" id="btnsubmit" type="submit">Log In</button>
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
