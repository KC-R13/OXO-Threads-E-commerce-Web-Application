<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // validate
    if (empty($firstName) || empty($lastName) || empty($email) || empty($subject) || empty($message)) {
        echo "Please fill in all fields.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    $to = "klenidychathurarya@gmail.com";

    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    $emailMessage = "You have received a new contact form submission:\n\n";
    $emailMessage .= "Name: $firstName $lastName\n";
    $emailMessage .= "Email: $email\n";
    $emailMessage .= "Subject: $subject\n";
    $emailMessage .= "Message:\n$message";

    // Send email
    if (mail($to, $subject, $emailMessage, $headers)) {
        echo "Your message has been sent successfully.";
    } else {
        echo "Failed to send the message. Please try again later.";
    }


    $connection = mysqli_connect("localhost", "root", "", "oxothreads", 3306);

    if (!$connection) {
        die("Connection failed");
    }

    $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
    $message = mysqli_real_escape_string($connection, $_POST['message']);

    
    $sql = "INSERT INTO contact_submissions (first_name, last_name, email, subject, message) VALUES ('$firstName', '$lastName', '$email', '$subject', '$message')";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        echo "Form submitted successfully!";
        
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    mysqli_close($connection);
} else {
    echo "Invalid request method.";
}

?>
