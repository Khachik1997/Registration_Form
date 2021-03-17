<?php
$connect = mysqli_connect("localhost", "root", "", "registration",);
session_start();
if (isset($_SESSION["email"])) {
    header("location:index.php");
}
if (isset($_POST["register"])) {
    if (empty($_POST["user_name"]) || empty($_POST["user_email"]) || empty($_POST["user_password"])) {
        echo '<script>alert("All fields are required")</script>';
    } else {
        $user_name = mysqli_real_escape_string($connect, $_POST["user_name"]);
        $user_email = mysqli_real_escape_string($connect, $_POST["user_email"]);
        $user_password = mysqli_real_escape_string($connect, $_POST["user_password"]);
        $user_password = md5($user_password);
        $query = "SELECT * FROM users where email='$user_email'";
        $duplicate = mysqli_query($connect, $query);
        if (mysqli_num_rows($duplicate) > 0) {
            echo '<script>alert("that email address already has been used ")</script>';
        } else {

            $query = "INSERT INTO users (name,email,pass ) VALUES('$user_name','$user_email','$user_password') ";
            if (mysqli_query($connect, $query)) {

                header("location:register.php?action=login");
                echo '<script>alert("REGISTRATION DONE")</script>';
            }
        }
    }
}
if (isset($_POST["login"])) {
    if (empty($_POST["user_email"]) || empty($_POST["user_password"])) {
        echo '<script>alert("All fields are required")</script>';
    } else {
        $user_email = mysqli_real_escape_string($connect, $_POST["user_email"]);
        $user_password = mysqli_real_escape_string($connect, $_POST["user_password"]);
        $user_password = md5($user_password);
        $query = "SELECT * FROM users WHERE email = '$user_email' AND pass ='$user_password'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['email'] = $user_email;
            header("location:index.php");
        } else {
            echo '<script>alert("Wrong USer Details")</script>';

        }
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body style="background-color:#e5ece4">
<?php
if (isset($_GET["action"]) == "login") {
    ?>
    <h2 style="text-align:center">Login</h2>
    <form style="width: 50%; transform: translateX(50%)" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="Enter email" name="user_email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                   name="user_password">
        </div>

        <button type="submit" class="btn btn-primary" value="Login" name="login">Login</button>
        <p style="text-align:center"><a href="register.php">Register</a></p>
    </form>
    <?php
} else {
    ?>
    <h2 style="text-align: center">Registration</h2>
    <form style="width: 50%; transform: translate(50%,0) " method="post">
        <div class="form-group">
            <label for="username">Enter Name</label>
            <input type="text" class="form-control" id="username" aria-describedby="username"
                   placeholder="Enter email" name="user_name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1"> Enter Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="Enter email" name="user_email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"> Create Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                   name="user_password">
        </div>

        <button type="submit" class="btn btn-primary" value="Register" name="register">Register</button>
        <p style="text-align:center"><a href="register.php?action=login">Login</a></p>
    </form>
    <?php
}
?>
<h4 style="text-align:center">If you want to add comment,first you mast login </h4>

<div class="comment_area" style="width: 50%;margin: auto">
    <?php
    require "comments.php";
    while ($row = mysqli_fetch_array($comments)) {
        echo "<tr>";
        echo "<th>" . $row['id'] . "</th>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['comment'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "</tr>";
    }
    ?>

</div>
<table class="table" style="width: 50%">


</table>
</body>
</html>
