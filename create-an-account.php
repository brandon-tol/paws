<?php session_start();

// Check if user is already logged in
if (isset($_SESSION['username'])) {
    if (isset($_COOKIE['toGo'])) {
        // Redirect back to the last page the user was on
        $location = $_COOKIE['toGo'];

        setcookie('toGo', null, time()-3600);
        unset($_COOKIE['toGo']);

        header("Location: $location");
    } else {
        // Redirect to home page if user came from another website
        header("Location: ./");
    }
    exit();
}

// If user is not logged in, display the login form

if (isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    // Check if the passwords match
    if ($password != $confirm_password) {
        die("Error: Passwords do not match.");
    }

    // Regular expression for username: only digits and letters, no special chars
    $username_regex = "/^[a-zA-Z0-9]+$/";

    // Regular expression for password: only digits and letters, minimum length of 4
    $password_regex = "/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9]{4,}$/";

    // Check if the username is valid
    if (!preg_match($username_regex, $username)) {
        die("Error: Username must contain only letters and digits (no special chars).");
    }

    // Check if the password is valid
    if (!preg_match($password_regex, $password)) {
        die("Error: Password must contain only letters and digits, and be at least 4 characters long.");
    }

    // Check if the username already exists in the user_data.txt file
    $file = fopen("user_data.txt", "r") or die("Error: Unable to open file!");
    while (!feof($file)) {
        $line = trim(fgets($file));
        $line_parts = explode(":", $line);
        if ($line_parts[0] == $username) {

            setcookie("error_message", "That username already exists, please choose a different username.");

        }
    }
    fclose($file);
    if(!isset($_COOKIE['error_message'])) {
        // Open the file for writing, and append the new account info
        $file = fopen("user_data.txt", "a") or die("Error: Unable to open file!");
        fwrite($file, "$username:$password\n");
        fclose($file);

        // Start session and store username
        $_SESSION['login_status'] = $username;

        $location = isset($_COOKIE['toGo']) ? $_COOKIE['toGo'] : "./";
        if(isset($_COOKIE['toGo'])){

            setcookie('toGo', null, time()-3600);
            unset($_COOKIE['toGo']);

        }
        header("Location: ./login.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Paws | Register</title>
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
        <h1>Create an account</h1>
        <form method="post" onsubmit="return validateRegisterForm();">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required><br><br>

            <input type="submit" name="submit" value="Create Account">
            <input type="button" value="Already have an account?" onclick="goTo(&quot;login.php&quot;)">
        </form>
        <?php
        if(isset($_COOKIE['error_message'])) {
            echo "<p>".$_COOKIE['error_message']."</p>";
            
            setcookie('error_message', null, time()-3600);
            unset($_COOKIE['error_message']);
            
        }
        ?>
    </div>
</div>
</body>
</html>