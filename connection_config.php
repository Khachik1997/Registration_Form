<?php
require "open_connection.php";
$query = "SELECT users.name,comments.comment,comments.created_at ,comments.user_id,comments.id FROM users INNER JOIN comments ON users.id = comments.user_id ";
$comments = mysqli_query($connection, $query);
if (!$comments) {
    die("Error: " . $query . "<br>" . mysqli_error($connection));
}
