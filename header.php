<?php
// header.php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>DayOut</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js" defer></script>
</head>
<body>
    <header>
        <div style="float: left; font-size: 1.8rem; font-weight: bold;">
            DayOut
        </div>
        <nav>
            <ul class="nav-list">
                <li><a href="home.php">Home</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="past_itineraries.php">Past Itineraries</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
