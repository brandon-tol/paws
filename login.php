<?php
session_start();
// Check if user is already logged in
if (isset($_SESSION['login_status'])) {
    // Check if the user came from this website
    header("Location: ./");
    exit();
}

// If user is not logged in, display the login form
$error_message = "";
if (isset($_POST['username']) && isset($_POST['password'])) {

    setcookie('last-username', $_POST['username']);
    setcookie('login_status', false);

    $file = fopen("user_data.txt", "r") or die("There is an error accessing the server. Please try again later.");
    while (!feof($file)) {
        if (trim(fgets($file)) == $_POST['username'] . ":" . $_POST['password']) {
            $_SESSION['login_status'] = $_POST['username'];

            setcookie('failed_attempts', 1);

            $location = isset($_COOKIE['toGo']) ? $_COOKIE['toGo'] : "./";
            if(isset($_COOKIE['toGo'])) unset($_COOKIE['toGo']);
            header("Location: $location");
            exit();
        }
    }

    if (!isset($_COOKIE['login_status']) || !$_COOKIE['login_status']) {
        setcookie('failed_attempts', isset($_COOKIE['failed_attempts']) ? $_COOKIE['failed_attempts'] + 1 : 1);
    }
    if (isset($_COOKIE['failed_attempts']) && (!isset($_COOKIE['login_status'])) || !$_COOKIE['login_status']) {
        setcookie('error_message',"Incorrect username or password. You have attempted to login with incorrect passwords " . $_COOKIE['failed_attempts'] . " times.");
    }

}
if(isset($_COOKIE['error_message'])) {
    $error_message = $_COOKIE['error_message'];

    setcookie('error_message', null, time()-3600);
    unset($_COOKIE['error_message']);

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Paws | Login</title>
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
        <h1>Login to your Account</h1>
        <form action="#" method="post" onsubmit="return validateLoginForm();">
            <label for="username">Username: <input name="username" id="username" type="text" value="<?php echo isset($_COOKIE['last-username']) ? $_COOKIE['last-username'] : ""?>"></label><br><br>
            <label for="password">Password: <input name="password" id="password" type="password"></label><br><br>
            <input type="submit" value="Login">
            <input type="button" value="Register" onclick="goTo(&quot;create-an-account.php&quot);">
        </form>
        <p>
            <?php echo $error_message ?>
        </p>
    </div>
</div>


</body>
</html>