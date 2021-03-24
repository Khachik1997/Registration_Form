<?php
include "connection_config.php";
include "func_flash.php";
session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Assets/stylesheet/comments.css">
    <title>My first Task</title>
</head>
<body style="background-color: #e5ece4">
<div class="weather">
    <p> Temperature in Yerevan <?= getWeather(); ?>  </p>
</div>
<section class="main">


    <div class="comment_area">
        <h3> There You can see comments</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Comment</th>
                <th scope="col">Created At</th>
                <th scope="col">Edit</th>

            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($comments)) {
                ?>
                <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['comment'] ?></td>
                <td><?= $row['created_at'] ?></td>
                <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row['user_id']) { ?>
                    <td><a class='btn btn btn-primary' href='edit_com.php?id=<?= $row['id'] ?>'>Edit</a></td>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div>

</section>

</body>
</html>