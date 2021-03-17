<?php
session_start();
if(!isset($_SESSION["email"])){
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
    <title>My first Task</title>
</head>
<body>
<?php
echo '<h1> Welcome - ' .$_SESSION["email"].' </h1>';
echo '<a href="logout.php">Logout</a>';
?>
<form action="create_comment.php" method="POST">
    <div class="form-group">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Name</span>
            </div>
            <input
                type="text"
                class="form-control"
                placeholder="Username"
                aria-label="Username"
                aria-describedby="basic-addon1"
                name="username"
            >
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Comment</span>
            </div>
            <textarea class="form-control" aria-label="With textarea" name="comment"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>



