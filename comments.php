<?php
include "connection_config.php";

session_start();
$temp = $_SESSION['temp']
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
<section class="main">

    <div class="weather">
        <h3>Weather in Your Citi </h3>
        <p>Please write your citi name for see temperature in your citi also you can choose celsius or fahrenheit</p>
        <form action="cURL.php" method="post">
            <div class="input_citi">
                <span>Citi Name</span><input type="text" placeholder="Yerevan" name="citi_name">
            </div>
            <div class="temp_citi">
                <div class="celsius">
                    <input type="radio" id ="celsius" name="tempType" value="metric" checked>
                    <label for="celsius">Celsius</label>
                </div>
                <div class="fahrenheit">
                    <input type="radio" id ="fahrenheit" name="tempType" value="imperial">
                    <label for="fahrenheit">Fahrenheit</label>
                </div>
            </div>
            <button type="submit">See Result</button>
            <form/>
            <div class="number_for_temp">
                <p>Temperature</p>
                <span class="temp"><?= $temp ?></span>
                <span style="color: red"></span>
            </div>
    </div>
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