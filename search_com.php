<?php
include "open_connection.php";

if (isset($_POST['txt'])) {
    $txt = $_POST['txt'];
    $query = "SELECT users.name,comments.comment,comments.created_at ,comments.user_id,comments.id FROM users INNER JOIN comments ON users.id = comments.user_id WHERE comment LIKE '%$txt%'";
    $result = mysqli_query($connection, $query);
    $return_arr = [];
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            $return_arr[] = array($row);
        }
        echo json_encode(["error"=>false, "message"=> $return_arr]);
    } else {
        echo json_encode(["error"=>true, "message"=>"NO RESULT"]) ;
    }
}





