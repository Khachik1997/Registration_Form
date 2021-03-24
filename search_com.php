<?php
include "open_connection.php";

if (isset($_POST['txt'])) {
    $txt = $_POST['txt'];
    $query = "SELECT * From comments WHERE comment LIKE '%$txt%'";
    $result = mysqli_query($connection, $query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $user_id = $row['user_id'];
            $comment = $row['comment'];
            $created_at = $row['created_at'];
            $return_arr[] = array("id" => $id, "user_id" => $user_id, "comment" => $comment, "created_at" => $created_at);
        }
        echo json_encode($return_arr);
    } else {
        echo "Error";
    }
}





