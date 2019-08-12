<?php

include 'db.php';


if (isset($_POST['update_comment']) && isset($_POST['comment_id'])){
    $update_comment=$_POST['update_comment'];
    $comment_id=$_POST['comment_id'];

    $update_query=mysqli_prepare($connection,"UPDATE comments SET comment_content='$update_comment',comment_date=now() WHERE id=?");
    mysqli_stmt_bind_param($update_query,'i',$comment_id);
    mysqli_stmt_execute($update_query);

    if (!$update_query)
        die('Query Failed');




    $sql="SELECT comment_content,comment_date FROM comments WHERE id=$comment_id";
    $result=mysqli_query($connection,$sql);

    while ($row=mysqli_fetch_assoc($result)){
        $comment_content=$row['comment_content'];
        $comment_date=$row['comment_date'];

        $data=['comment_content'=>$comment_content,'comment_date'=>$comment_date,'comment_id'=>$comment_id];
        echo json_encode($data);
    }

}