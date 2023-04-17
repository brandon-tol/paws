<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Paws | Contact Us</title>
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
                    <h1>Contact Us</h1>
                    <h2>Find us on social media!</h2>
                    <p><span class="small">(These buttons are not currently mapped to any social accounts, just the platforms they represent.)</span></p>
                    <button onclick="goTo('https://facebook.com/')">Facebook</button>
                    <button onclick="goTo('https://twitter.com/')">Twitter</button>
                    <button onclick="goTo('https://instagram.com/')">Instagram</button>
                    <br><br>
                    <h2>Website Developer</h2>
                    <p>
                        Name: Brandon Toledano<br>
                        Student ID: 40244896<br>
                        Email: <a href="mailto:brandon.toledano@mail.concordia.ca">brandon.toledano@mail.concordia.ca</a><br>
                    </p>
                </div>
                <div>
                    <img src="./assets/sunglasses-dog.jpg" alt="Dog with Sunglasses" class="h70 rightalign">
                </div>
            </div>
        </div>
    </body>
</html>