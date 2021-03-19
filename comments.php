<?php
include "connection_config.php";

session_start();

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
<body style="background-color: #e5ece4">

<table class="table">
    <thead>
    <tr>
        <th scope="col">Username</th>
        <th scope="col">Comment</th>
        <th scope="col">Created At</th>
        <?php
        if(isset($_SESSION['id'])){
          ' <th scope="col">Edit</th>';
        }
        ?>

    </tr>
    </thead>
    <tbody>
    <?php
        while($row = mysqli_fetch_assoc($comments)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['comment'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            if(isset($_SESSION['id']) && $_SESSION['id'] == $row['user_id']){
                echo "<td><a  class='btn btn btn-primary' href='edit_com.php?id=". $row['id'] ."'  >Edit</a> </td>";
            }
            echo "</tr>";
        }
    ?>
    </tbody>
</table>
</body>
</html>