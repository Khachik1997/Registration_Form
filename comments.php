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
<body>
<section class="header">
    <div class="weather">
        <p> Temperature in Yerevan <?= getWeather(); ?> C </p>
    </div>
    <div class="search">
        <label for="search_input">Comment</label>
        <input type="text" id="search_input">
        <button id="search_btn"> Search</button>

    </div>
</section>

<section id="main">


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
            <tbody id="tbody">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>

    function myFunction(data) {
        $('#tbody').empty();
        if(data == "Error"){
            $('#tbody').append("Not Result");
            return;
        }
        let response = JSON.parse(data);
        console.log(response);
        for (let i = 0; i < response.length; ++i) {
            let user_id = response[i].user_id;
            let comment = response[i].comment
            let created_at = response[i].created_at


            let result = "<tr class='tr'>" +
                "<td class='td'>" + user_id + "</td>" +
                "<td class='td'>" + comment + "</td>" +
                "<td class='td'>" + created_at + "</td>" +
                "</tr>";
            $('#tbody').append(result);
        }
    }

    $(document).ready(function () {
        $('#search_btn').click(function () {
            let searching_txt = $("#search_input").val();
            if(searching_txt.length >= 3){

                $.ajax({
                    url: 'search_com.php',
                    type: 'POST',
                    data: {txt: searching_txt},
                    datatype: 'JSON',
                    success: myFunction
                });
            }else{
                $('#tbody').empty();
                $('#tbody').append("You must search 3 or more symbol");

            }
        });

    });


</script>
</body>
</html>