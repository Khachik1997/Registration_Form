<?php
include "connection_config.php";
session_start();

if (!isset($_SESSION["id"])) {
    header("location:comments.php");

}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit_com = $_POST['edit_com'];

    if (empty($edit_com)) {
        echo "comment is empty";
        return false;
    }
    $comment_id = (int)$_GET['id'];
    if (!isset($_GET['id'])){
        header("location:comments.php");
    }
    $sessionID = $_SESSION["id"];
    $sql_edit = mysqli_query($connection, "UPDATE comments SET comment='$edit_com' WHERE id = '$comment_id' AND user_id = '$sessionID' ");

    header("location:comments.php");


} else {
    if (!isset($_GET['id'])){
        header("location:comments.php");
    }
    $comment_id = (int)$_GET['id'];
    $sessionID = $_SESSION["id"];
    $comment = mysqli_query($connection, "SELECT comment FROM comments WHERE comments.id ='$comment_id' AND user_id = '$sessionID' ");
    $row = mysqli_fetch_assoc($comment);
    if(!$row){
        header("location:comments.php");
    }
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="Assets/stylesheet/index.css">
    <title>My first Task</title>
</head>
<body>


<div class="welcome">
 <h1><?= $_SESSION["name"] ?>-Change your comment and click Edit button to edit your comment</h1>
    <a class="btn btn-primary" href="logout.php">Logout</a>

</div>

<form  method="POST">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Comment</span>
            </div>
            <textarea class="form-control" aria-label="With textarea"
                      name="edit_com"><?= $row['comment'] ?></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Edit</button>
</form>
</body>
</html>




