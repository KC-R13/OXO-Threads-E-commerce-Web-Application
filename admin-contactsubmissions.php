<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ Management | OXO Threads</title>
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
    <div class="admin-contentcolumn existingUserColumn">
        <h1>Contact Submissions</h1>
        <table class="existingusers">
            <tr>
                <th>Submission-ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
            </tr>

            <?php

                $connection = mysqli_connect("localhost", "root", "", "oxothreads", "3306");

                if (!$connection) {
                die("Connection failed");
                }

                $sql = "SELECT * FROM `contact_submissions`";
                $result = mysqli_query($connection, $sql);



                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
            ?>

            <tr>
                <td><?php echo $row['submission_id'] ?></td>
                <td><?php echo $row['first_name'] ?></td>
                <td><?php echo $row['last_name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['subject'] ?></td>
                <td>
                    <p><?php echo $row['message'] ?></p>
                </td>
                <td><?php echo $row['submission_date'] ?></td>
                
            </tr>

            <?php
                    }
                }
            // mysqli_close(($conn));
            ?>
            
        </table>
    </div>
    
</div>



<script src="js/adminjs.js"></script>
</body>

</html>