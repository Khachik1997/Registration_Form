<?php
session_start();

if(!isset($_SESSION["id"])){
        header("location:register.php?action=login");
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
    echo '<h1> Welcome - ' .$_SESSION["name"].' </h1>';
    echo '<a class="btn btn-primary" href="logout.php">Logout</a>';
    ?>
</div>

<form action="create_comment.php" method="POST">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Comment</span>
            </div>
            <textarea  class="form-control" aria-label="With textarea" name="comment"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>



