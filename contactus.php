<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us | OXO Threads</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.png">
  <!--  CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>

<!-- NAVBAR -->
<?php include 'navbar.php';?>
<!-- NAVBAR END -->


<!-- Fashion without Labels, Wear Your Freedom -->
<div class="contactuscontainer-main">
        <div class="header-name">
            <img class="separator" src="img/headingline.png">
            <h3>Let's Get In Touch!</h3>
            <img class="separator" src="img/headingline.png">
        </div>
    <div class="contactuscontainer">
        <div class="contactuscontainer-column1">
            <img src="img/contactimg2.jpg">
        </div>
        <div class="contactuscontainer-column2">
            <h3>Send us a message!</h3>
            
            <form class="contactform" id="contactForm" onsubmit="submitForm(event)" action="contact_form_handler.php" method="post">
                <div>
                    <label class="contactlabel" for="firstName">First Name:</label>
                    <input class="contactinput" type="text" id="firstName" name="firstName">
                </div>
                <div>
                    <label class="contactlabel" for="lastName">Last Name:</label>
                    <input class="contactinput" type="text" id="lastName" name="lastName">
                </div>
                <div>
                    <label class="contactlabel" for="email">Email:</label>
                    <input class="contactinput" type="text" id="email" name="email">
                </div>
                <div>
                    <label class="contactlabel" for="subject">Subject:</label>
                    <input class="contactinput" type="text" id="subject" name="subject">
                </div>
                <div>
                    <label class="contactlabel" for="message">Message:</label>
                    <textarea class="contacttextarea" id="message" name="message"></textarea>
                </div>
                <div>
                    <input class="contactbutton" type="submit">
                    <input class="contactbutton" type="reset" onclick="resetForm()">
                </div>
            </form>
        </div>
    </div>

    <div class="header-name">
        <img class="separator" src="img/headingline.png">
        <h3>Frequently Asked Questions</h3>
        <img class="separator" src="img/headingline.png">
    </div>
    

    <div class="faqcontainer">
        <button class="faqaccordion">Are your sizes standardized or do they follow traditional gender-specific measurements?</button>
        <div class="panel">
        <p>
        Our sizes are based on standardized measurements, providing a more inclusive and comfortable fit for everyone. 
        We offer a detailed size guide to help you find the perfect fit.
        </p>
        </div>

        <button class="faqaccordion">Do you ship internationally?</button>
        <div class="panel">
        <p>
        Yes, we offer international shipping to many countries. 
        At the checkout, you can select your location, and shipping costs will be calculated accordingly.
        </p>
        </div>

        <button class="faqaccordion">Do you use sustainable materials in your clothing?</button>
        <div class="panel"><p>
        Yes, we are committed to sustainability. 
        Many of our products are crafted from eco-friendly and sustainable materials. 
        Look for specific details in the product descriptions.</p>
        </div>

        <button class="faqaccordion">What is your return policy?</button>
        <div class="panel">
        <p>We offer a hassle-free return policy. If the item doesn’t meet your expectations, 
            you can return it within 30 days for a full refund or exchange. 
            Please check <a style="color:#000; text-decoration:none;" href="contactus.php">Contact Us</a></p>
        </div>

        <button class="faqaccordion">Are your prices the same for all items, regardless of style or size?</button>
        <div class="panel">
        <p>
        Yes, our prices are uniform across the board, irrespective of style or size. We believe in fair pricing for all our customers.
        </p>
        </div>
    </div>    
        

</div>


 




<footer>
    <?php include 'footer.php';?>
</footer>

<script>

    /** Contact Us Form **/
    
    function submitForm(event) {
    event.preventDefault(); 

    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;
    const subject = document.getElementById('subject').value;
    const message = document.getElementById('message').value;

    if (firstName.trim() === '') {
        alert('Please enter your first name.');
        return;
    }

    if (lastName.trim() === '') {
        alert('Please enter your last name.');
        return;
    }

    if (email.trim() === '') {
        alert('Please enter your email.');
        return;
    }

    if (subject.trim() === '') {
        alert('Please enter a subject.');
        return;
    }

    if (message.trim() === '') {
        alert('Please enter the message.');
        return;
    }

    if (!validateEmail(email)) {
        alert('Please enter a valid email address.');
        return;
    }
    
    //submit the form
    document.getElementById('contactForm').submit();
    }

    function resetForm() {
        document.getElementById('contactForm').reset();
    }

    function validateEmail(email) {
        const emailRegex = /\S+@\S+\.\S+/;
        return emailRegex.test(email);
    }




    /** FAQ - CONTACT US **/

    var acc = document.getElementsByClassName("faqaccordion");
    var i;
        
    for (i = 0; i < acc.length; i++) {

        acc[i].addEventListener("click", function() {

        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
        } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
        } 
        
        });

    }




//     var acc = document.getElementsByClassName("faqaccordion");
//     var panels = document.getElementsByClassName("panel");
//     var i;

//     for (i = 0; i < acc.length; i++) {
//         acc[i].addEventListener("click", function() {

//             if (this === acc[0]) 
//             {
//                 var firstPanelHeight = panels[0].scrollHeight + "px";
//                 for (var x = 0; x < panels.length; x++) 
//                 {
//                     panels[x].style.maxHeight = firstPanelHeight;
//                 }
//             } 
            
//             else 
//             {
//                 this.classList.toggle("active");
//                 var panel = this.nextElementSibling;
//                 if (panel.style.maxHeight) 
//                 {
//                     panel.style.maxHeight = null;
//                 } else 
//                 {
//                     panel.style.maxHeight = panel.scrollHeight + "px";
//                 }
//             }
//         });
// }

    

</script>

    <script src="js/script.js"></script>
</body>

</html>
