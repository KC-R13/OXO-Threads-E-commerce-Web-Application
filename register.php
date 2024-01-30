<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | OXO Threads</title>
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

<div class="register-main-container">
    <div class="registerbackgroundcontainer">
        <div class="registerbackgroundcontainercol1">
        </div>
        <div class="registerbackgroundcontainercol2">
        </div>
    </div>
        <div class="registercontainer">
            <div class="registercontainercol1">
                <img src="img/registerimg.jpg" alt="register image">
            </div>
            <div class="registercontainercol2">
                <h1>Register/Sign Up</h1>
                <form class="adduser-form"  id="registerForm" name="registerForm" method="post" enctype="multipart/form-data" onsubmit="submitForm(event)" >
                    <div class="registeritemdiv-container">
                        <div class="registeritemdiv">
                            <label class="registerlabel" for="userimg">Profile Image: </label>
                            <input class="registerinput" type="file" id="userimg" name="userimg">
                        </div>
                        <div class="registeritemdiv">
                            <label class="registerlabel" for="firstName">First Name:</label>
                            <input class="registerinput" type="text" id="firstName" name="firstName">
                        </div>
                        <div class="registeritemdiv">
                            <label class="registerlabel" for="lastName">Last Name:</label>
                            <input class="registerinput"  type="text" id="lastName" name="lastName">
                        </div>
                        <div class="registeritemdiv">
                            <label class="registerlabel" for="email">Email:</label>
                            <input class="registerinput"  type="email" id="email" name="email">
                        </div>
                        <div class="registeritemdiv">
                            <label class="registerlabel" for="phone">Telephone Number:</label>
                            <input class="registerinput"  type="number" id="phone" name="phone">
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
                            <button id="btnRegisterCustomer" name="btnRegisterCustomer" class="registerbutton" type="submit">Register</button>
                            <button id="resetRegister" name="resetRegister" class="registerbutton" type="reset" onclick="resetForm()">Reset</button>
                        </div>
                        <div class="registeritemdiv-forbuttons">
                            <a href="login.php">Already registered? Log in now!</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
</div>

<footer>
    <?php include 'guestfooter.php';?>
</footer>

<script>

function submitForm(event) {
    event.preventDefault();

    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmpassword').value;


    if (firstName.trim() === '') 
    {
        alert('Please enter the first name');
        return;
    }

    if (lastName.trim() === '') 
    {
        alert('Please enter the last name');
        return;
    }

    if (email.trim() === '') 
    {
        alert('Please enter the email');
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

</body>




<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $email = $_POST['email'];
    $telephone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $status = 1;

    $userimage ="uploads/customers/" .basename($_FILES['userimg']['name']);
    move_uploaded_file(($_FILES['userimg']['tmp_name']), $userimage);

    $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

    if (!$connection) {
          die("Connection failed");
    }
        
    $sql = "INSERT INTO `customers` (`customer_id`, `fname`, `lname`, `email`, `telephone`, `userimage`, `password`, `confirmpassword`, `status`) 
    VALUES (NULL, '".$firstname."', '".$lastname."', '".$email."', '".$telephone."', '".$userimage."', '".$password."', '".$confirmpassword."', '".$status."')";

        
    if(mysqli_query($connection, $sql)){
        echo "Registered successfully";
    } else {
        echo "something went wrong!";
    }

        $connection->close();
}

?>

</html>
