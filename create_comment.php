<?php
require "db_config.php";
session_start();
if(!isset($_SESSION["id"])){
    header("location:register.php?action=login");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = $_POST['comment'];
    if(empty($comment)){
        echo "comment is empty";
        return false;
    }
    $connection =  mysqli_connect($hostname, $db_username, $db_password, $db_name);
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());

    }
    $user_id = $_SESSION['id'];
    $query = "INSERT INTO comments (comment ,user_id) VALUES ('$comment', '$user_id')";

    if (mysqli_query($connection, $query)) {
        mysqli_close($connection);
        header("Location: comments.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }


}
