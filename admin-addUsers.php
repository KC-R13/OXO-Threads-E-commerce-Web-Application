
<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Admins | OXO Threads</title>
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
                <h1>Register/Add a New Admin</h1>
                <form class="adduser-form"  id="registerForm" name="registerForm" method="post" enctype="multipart/form-data" onsubmit="submitForm(event)" >
                    <div class="registeritemdiv-container">
                        <div class="registeritemdiv">
                            <label class="registerlabel" for="userName">Username:</label>
                            <input class="registerinput" type="text" id="userName" name="userName">
                        </div>
                        <div class="registeritemdiv">
                            <label class="registerlabel" for="email">Email:</label>
                            <input class="registerinput"  type="email" id="email" name="email">
                        </div>
                        <div class="registeritemdiv">
                            <label class="registerlabel" for="phone">Telephone Number:</label>
                            <input class="registerinput"  type="tel" id="phone" name="phone">
                        </div>
                        <div class="registeritemdiv">
                            <label class="registerlabel" for="password">Password:</label>
                            <input class="registerinput"  type="password" id="password" name="password">
                        </div>
                        <div class="registeritemdiv">
                            <label class="registerlabel" for="confirmpassword">Confirm Password:</label>
                            <input class="registerinput"  type="password" id="confirmpassword" name="confirmpassword">
                        </div>
                        <div class="registeritemdiv-forbuttons">
                            <input class="registerbutton" type="submit" name="registerBtn" id="registerBtn" value="Register">
                            <input class="registerbutton" type="reset" onclick="resetForm()" value="Reset">
                        </div>
                    </div>
                </form>
            </div>
    </div>
    
</div>


<script>

    function submitForm(event) {
        event.preventDefault(); // Prevent the form from submitting 

       
        const userName = document.getElementById('userName').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmpassword').value;

    

        if (userName.trim() === '') 
        {
            alert('Please enter a username');
            return;
        }

        if (phone.trim() === '') 
        {
            alert('Please enter the telephone number');
            return;
        }

        if (!validateEmail(email)) {
            alert('Please enter a valid email address.');
            return;
        }

        if (!validatePhone(phone)) {
            alert('Please enter a valid phone number.');
            return;
        }

        if (password !== confirmPassword) {
            alert('Passwords do not match.');
            return;
        }

        // submit the form
        document.getElementById('registerForm').submit();
    }

    function validateEmail(email) {
        const emailRegex = /\S+@\S+\.\S+/;
        return emailRegex.test(email);
    }

    function validatePhone(phone) {
        const phoneRegex = /^\d{10}$/;
        return phoneRegex.test(phone);
    }

    function resetForm() {
        document.getElementById('registerForm').reset();
    }

</script>
<script src="js/adminjs.js"></script>

</body>





<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $username = $_POST['userName'];
    $email = $_POST['email'];
    $telephone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $status = 1;

    $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

    if (!$connection) {
          die("Connection failed");
    }
        

    $sql = "INSERT INTO `admin` (`admin_id`, `username`, `email`, `phone`, `password`, `confirm_password`, `status`) 
    VALUES (NULL, '".$username."', '".$email."', '".$telephone."', '".$password."', '".$confirmpassword."', '".$status."')";

        
    if(mysqli_query($connection, $sql)){
        echo "Registered successfully";
    } else {
        echo "something went wrong!";
    }

        $connection->close();
}

?>





</html>
