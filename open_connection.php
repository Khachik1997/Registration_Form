<?php
require "db_config.php";
$connection = mysqli_connect($hostname, $db_username, $db_password, $db_name);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}