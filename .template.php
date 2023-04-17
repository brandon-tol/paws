<?php
$current_url = basename($_SERVER['REQUEST_URI']);
$login_status = isset($_SESSION['login_status']) ? $_SESSION['login_status'] : false;
?>
<body>
<nav>
    <ul>
        <li><a href="./"><div class="<?php if(strstr($current_url, "index.php") || strstr($current_url, "SOEN287_FinalWebsite")) echo "active "?>link">Home</div></a></li>
        <li><a href="./find-a-pet.php"><div class="<?php if(strstr($current_url, "find-a-pet.php")) echo "active "?>link">Find a dog/cat</div></a></li>
        <li><a href="./dog-care.php"><div class="<?php if(strstr($current_url, "dog-care.php")) echo "active "?>link">Dog Care</div></a></li>
        <li><a href="./cat-care.php"><div class="<?php if(strstr($current_url, "cat-care.php")) echo "active "?>link">Cat Care</div></a></li>
        <li><a href="./have-a-pet-to-give-away.php"><div class="<?php if(strstr($current_url, "have-a-pet-to-give-away.php")) echo "active "?>link">Have a pet to give away</div></a></li>
        <li><a href="./contact-us.php"><div class="<?php if(strstr($current_url, "contact-us.php")) echo "active "?>link">Contact Us</div></a></li>
        <li><a href="<?php echo $login_status ? "./logout.php" : "./login.php" ?>"><div class="<?php if(strstr($current_url, "login.php")) echo "active "?>link"><?php echo $login_status ? "Logout (".$login_status.")" : "Login / Register"?></div></a></li>
    </ul>
    <div class="background"></div>
</nav>
<header>
    <a href="./"><img id="logo" src="assets/logo.png" alt="Paws Logo"></a>
    <div class="date-time"></div>
    <script>setDateAndTime();</script>
    <div class="background"></div>
</header>
<footer>
    <div class="wrapper centered">Your&nbsp;information&nbsp;is&nbsp;safe&nbsp;with&nbsp;us. <span class="dark-link"><a onclick="privacyAlert()" href="javascript:">Click&nbsp;here&nbsp;to&nbsp;view&nbsp;our&nbsp;privacy&nbsp;policy</a></span>.<br>Copyright&nbsp;&copy;&nbsp;Brandon&nbsp;Toledano&nbsp;2023</div>
    <div class="background"></div>
</footer>
