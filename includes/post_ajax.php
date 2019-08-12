<?php include "db.php"; ?>
<?php session_start(); ?>


<?php

$comment_id_query = (isset($_POST['id']) ? $_POST['id'] : '') ;

$query="SELECT * FROM comments where id=$comment_id_query";
$result=mysqli_query($connection,$query);

while ($row=mysqli_fetch_assoc($result)) {
    $comment_id = $row['id'];
    $post_comment_id = $row['post_comment_id'];
    $user_username = $row['user_username'];
    $comment_name = $row['comment_name'];
    $comment_content = $row['comment_content'];
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];


    $array = ['comment_id' => $comment_id, 'post_comment_id' => $post_comment_id, 'user_username' => $user_username, 'comment_name' => $comment_name
        , 'comment_content' => $comment_content, 'comment_status' => $comment_status, 'comment_date' => $comment_date];

echo json_encode($array);


}