<?php include 'db.php' ?>


<?php

if (isset($_POST['id'])){
    $comment_id = $_POST['id'];

    $sql="DELETE FROM comments WHERE id=$comment_id";
    mysqli_query($connection,$sql);
}


