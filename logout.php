<?php
$username = isset($_SESSION['login_status']) ? $_SESSION['login_status'] : "";
session_start();
setcookie('last-username', $username);
session_unset();
session_destroy();
setcookie('error_message', "You have successfully logged out.");
header("Location: ./login.php");
exit();
?>