<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Paws | Home</title>
        <link rel="icon" type="image/png" href="assets/icon.png?v=<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="./stylesheet.css">
        <script src="./script.js"></script>
    </head>
    <body>
    <?php
    include '.template.php';
    ?>
        <div id="content">
            <div class="wrapper">
                <div class="float-left">
                    <h1>Welcome to Paws!</h1>
                    <p>Here at Paws, we make pet adoption as seamless as possible by giving potential pet owners all the necessary tools to begin their journeys with their new friends.</p>
                    <p>We try to match the perfect pets with their perfect homes. Our various forms allows our users to filter the potential candidates by factors such as breed, gender and whether they are gentle with children.</p>
                    <p>You can use the toolbar on the left of all pages to navigate through the website easily.</p>
                    <p>Additionally, our website contains linked articles about proper pet care as well as other links to help users find the information they need.</p>
                    <p>Finally, if you have any additional questions or want to send us any other message, you can reach us through our <a href="contact-us.php">Contact Us webpage</a>.</p>
                </div>
                <figure>
                    <img src="./assets/snow-dog.jpg" class="right-align h70" alt="Dog in the Snow">
                </figure>
            </div>
        </div>
    </body>
</html>