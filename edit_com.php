<?php
include "connection_config.php";
session_start();

if (!isset($_SESSION["id"])) {
    header("location:comments.php");

}
if (!isset( $_POST['edit_com'])){
    header("location:comments.php");

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit_com = $_POST['edit_com'];

    if (empty($edit_com)) {
        echo "comment is empty";
        return false;
    }
    $comment_id = $_SESSION['edit_comm_id'];
    $sql_edit = mysqli_query($connection, "UPDATE comments SET comment='$edit_com' WHERE comments.id = '$comment_id' ");
    header("location:comments.php");


} else {
    $comment_id = (int)$_GET['id'];
    $_SESSION['edit_comm_id'] = $comment_id;
    $comment = mysqli_query($connection, "SELECT comment FROM comments WHERE comments.id ='$comment_id' ");
    $row = mysqli_fetch_assoc($comment);
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="Assets/stylesheet/index.css">
    <title>My first Task</title>
</head>
<body>


<div class="welcome">
    <?php
    echo '<h1>' . $_SESSION["name"] . '-Change your comment and click Edit button to edit your comment</h1>';
    echo '<a class="btn btn-primary" href="logout.php">Logout</a>';
    ?>
</div>

<form action="edit_com.php" method="POST">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Comment</span>
            </div>
            <textarea class="form-control" aria-label="With textarea"
                      name="edit_com"><?php echo $row['comment'] ?></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Edit</button>
</form>
</body>
</html>




