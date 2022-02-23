<?php


if (!isset($_SESSION)) {
    session_start();
}

?>

<nav id="menu">
    <div class="header_logo"><a href="index.php"><img src="images/common/logo_vinyl_full_gold.png"
                alt="vinyl online logo"></a></div>
    <ul>
        <div id="header_links" class="header_main_nav_links">
            <li class="mobile_home_link"><a href="index.php">Home</a></li>
            <li><a>Latest</a></li>
            <li><a>Trending</a></li>
            <li><a>Albums</a></li>
            <li><a>Singles</a></li>
        </div>
        <div class="header_login_register_box">

            <?php

            if (!isset($_SESSION['username'])) {
            ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>

            <?php

            } else {

            ?>

            <li><a href="my_account.php">My Account</a></li>
            <li><a href="logout.php">Log Out</a></li>

            <?php
            }
            ?>


        </div>
    </ul>
</nav>

<div class="mobile_btn">
    <div class="button_line_1"></div>
    <div class="button_line_2"></div>
    <div class="button_line_3"></div>
</div>

<div class="error_link_message">
    <p>Feature not available in this demo.</p>
</div>

<script src="js/header_script.js"></script>