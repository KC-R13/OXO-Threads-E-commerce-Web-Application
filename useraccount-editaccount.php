<?php
session_start();

if (!isset($_GET['user_id'])) {
    header('Location: useraccount-orderhistory.php'); 
    exit();
}


$connection = mysqli_connect("localhost", "root", "", "oxothreads", 3306);

if (!$connection) {
    die("Connection failed");
}

$user_id = mysqli_real_escape_string($connection, $_GET['user_id']);


$sql = "SELECT * FROM `customers` WHERE `customer_id` = $user_id";
$result = mysqli_query($connection, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $customer = mysqli_fetch_assoc($result);
} else {
   
    die("customer not found");
}

mysqli_close($connection);


if (isset($_POST['editprofilebtn'])) {
    $connection = mysqli_connect("localhost", "root", "", "oxothreads", 3306);

    if (!$connection) {
        die("Connection failed");
    }

    
    $updatedCustomerFirstName = mysqli_real_escape_string($connection, $_POST['fname']);
    $updatedCustomerLastName = mysqli_real_escape_string($connection, $_POST['lname']);
    $updatedCustomerEmail = mysqli_real_escape_string($connection, $_POST['email']);
    $updatedCustomerTelephone = mysqli_real_escape_string($connection, $_POST['telephone']);
    $updatedCustomerUserImage = mysqli_real_escape_string($connection, $_POST['userimage']);
    $updatedCustomerPassword = mysqli_real_escape_string($connection, $_POST['password']);
    $updatedCustomerConfirmPassword = mysqli_real_escape_string($connection, $_POST['confirmpassword']);

    if ($_FILES['userimage']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "uploads/"; 
        $targetFile = $targetDir . basename($_FILES['userimage']['name']);
        
    
        if (move_uploaded_file($_FILES['userimage']['tmp_name'], $targetFile)) {
        
            $updatedCustomerUserImage = mysqli_real_escape_string($connection, $targetFile);
        } else {
            echo "Error uploading file.";
        }
    }

 
    $updateSql = "UPDATE `customers` SET 
        `fname` = '$updatedCustomerFirstName',
        `lname` = '$updatedCustomerLastName',
        `email` = '$updatedCustomerEmail',
        `telephone` = '$updatedCustomerTelephone',
        `userimage` = '$updatedCustomerUserImage',
        `password` = '$updatedCustomerPassword',
        `confirmpassword` = '$updatedCustomerConfirmPassword'
        WHERE `customer_id` = $user_id";

    if (mysqli_query($connection, $updateSql)) {
        // echo "Customer updated successfully";
        header('Location: useraccount-orderhistory.php'); 
        exit();
    } else {
        echo "Error updating customer: " . mysqli_error($connection);
    }

    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account | OXO Threads</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <!-- CSS -->
    <link rel="stylesheet" href="css/userStyles.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <!-- NAVBAR -->
    <?php include 'usernavbar.php';?>
    <!-- NAVBAR END -->

    <div class="usercontainer-main">
        <div class="user-nav-column">
            <div class="user-navtab">
                <button class="nav-tab">My Account</button>
                <div class="nav-tab-panel">
                    <div class="nav-tabbox">
                        <a href="useraccount-editaccount.php?user_id=<?php echo $customer['customer_id']; ?>">Edit Information</a>
                        <a href="useraccount-orderhistory.php?user_id=<?php echo $customer['customer_id']; ?>">Order History</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="user-contentcolumn">
            <div class="profile">
                <div class="content">
                    <h1>Edit Profile</h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- Photo -->
                        <fieldset>
                            <div class="column-35">
                                <label class="avatar" for="avatar">Your Photo</label>
                            </div>
                            <div class="column-65">
                                <div class="photo" title="Upload your Avatar!">
                                    <img src="<?php echo $customer['userimage']; ?>">
                                </div>
                                <input name="userimage" type="file" class="btn" />
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="column-35">
                                <label for="fname">First Name:</label>
                            </div>
                            <div class="column-65">
                                <input type="text" name="fname" id="fname" value="<?php echo $customer['fname']; ?>" required />
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="column-35">
                                <label for="lname">Last Name:</label>
                            </div>
                            <div class="column-65">
                                <input type="text" name="lname" id="lname" value="<?php echo $customer['lname']; ?>" required />
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="column-35">
                                <label for="email">Email:</label>
                            </div>
                            <div class="column-65">
                                <input type="text" name="email" id="email" value="<?php echo $customer['email']; ?>" required />
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="column-35">
                                <label for="telephone">Telephone:</label>
                            </div>
                            <div class="column-65">
                                <input type="number" name="telephone" id="telephone" value="<?php echo $customer['telephone']; ?>" required />
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="column-35">
                                <label for="password">Password:</label>
                            </div>
                            <div class="column-65">
                                <input type="password" name="password" id="password" value="<?php echo $customer['password']; ?>" required />
                                <div style="display:flex; flex-direction: row; font-size:11px; color:#fff;">
                                <input type="checkbox" onclick="showPassword()">Show Password
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="column-35">
                                <label for="confirmpassword">Confirm Password:</label>
                            </div>
                            <div class="column-65">
                                <input type="password" id="confirmpassword" name="confirmpassword" value="<?php echo $customer['confirmpassword']; ?>" required />
                                <div style="display:flex; flex-direction: row; font-size:11px; color:#fff;">
                                <input type="checkbox" onclick="showConfirmPassword()">Show Password
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <input type="reset" name="editprofilebtnCancel" class="editprofilebtn cancel" value="Cancel" />
                            <input type="submit" name="editprofilebtn" class="editprofilebtn" value="Save Changes" />
                        </fieldset>

                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="js/adminjs.js"></script>
<script>
function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function showConfirmPassword() {
  var x = document.getElementById("confirmpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>

</html>
