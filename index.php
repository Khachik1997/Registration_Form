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
    <link rel="stylesheet" href="Assets/stylesheet/index.css">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>My first Task</title>
</head>
<body>

<div class="welcome">
    <h1> Welcome - <?= $_SESSION["name"] ?></h1>
    <a class="btn btn-primary" href="logout.php">Logout</a>

</div>

<form action="create_comment.php" method="POST">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Comment</span>
            </div>
            <textarea   aria-label="With textarea" name="comment"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>



