<?php
require "db_config.php";
$connection = mysqli_connect($hostname, $db_username, $db_password, $db_name);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$query = "SELECT users.name,comments.comment,comments.created_at ,comments.user_id,comments.id FROM users INNER JOIN comments ON users.id = comments.user_id ";
$comments = mysqli_query($connection, $query);
if (!$comments) {
    die("Error: " . $query . "<br>" . mysqli_error($connection));
}
