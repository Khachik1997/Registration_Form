<?php
require "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $comment = $_POST['comment'];

    if(empty($username)){
        echo "username is empty <br />";
        return false;
    }

    if(empty($comment)){
        echo "comment is empty";
        return false;
    }

    $connection =  mysqli_connect($hostname, $db_username, $db_password, $db_name);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "INSERT INTO comments (username, comment) VALUES ('$username', '$comment')";

    if (mysqli_query($connection, $query)) {
        mysqli_close($connection);
        header("Location: comments.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }

    mysqli_close($connection);

}
