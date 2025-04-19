<?php
// home.php
include 'header.php';
include 'includes/db_connect.php';
include 'includes/functions.php';
check_login();
include 'home_content.php';
include 'footer.php';
?>