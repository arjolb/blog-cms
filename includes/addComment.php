<?php include "db.php"; ?>
<?php session_start(); ?>
<?php
/**
 * Created by PhpStorm.
 * User: arjol
 * Date: 7/7/2019
 * Time: 10:33 PM
 */

$msg='';
$data='';

if (isset($_POST['add_comment']) && isset($_POST['post_id'])){
    $comment=$_POST['add_comment'];
    $post_id=$_POST['post_id'];
    $firstname=$_SESSION['firstname'];
    $lastname=$_SESSION['lastname'];
    $name=$firstname.' '.$lastname;

    $comment = preg_replace('/\s+/', ' ', $comment);




    if (empty($comment) || strlen($comment)===1){
        $msg='Please fill out!';
    }else{

        $sql="INSERT INTO comments(comment_date,post_comment_id,user_username,comment_name,comment_content) VALUES(now(),?,?,?,?)";

        $query_comment=mysqli_prepare($connection,$sql);

        mysqli_stmt_bind_param($query_comment,'isss',$post_id,$_SESSION['username'],$name,$comment);
        mysqli_stmt_execute($query_comment);


        $msg='Hooray';



        $sql_id="SELECT id FROM comments WHERE comment_content='$comment' ORDER BY id DESC";
        $query_id=mysqli_query($connection,$sql_id);
        while ($row=mysqli_fetch_assoc($query_id)){
            $id=$row['id'];
        }
        $comment_date=date('F j, Y');
        $data="
        
        <div class='border-bottom'> 
          <div class='row mb-3'>
             <div class=\"col-sm-9 comment-prepend\">
                <div class=\"mt-4\">
                    <img class=\"mr-4 pull-left\" src=\"http://placehold.it/64x64\" alt=\"\">
                    <h4 class=\"text-capitalize\"> $name
                                        <small>$comment_date</small>
                     </h4>
                     <p class=\"lead\">$comment</p>
                </div>
             </div>   
             
             
             <div class=\"col-sm-3\">
                <div class=\"mt-4 pull-right\">
                    <a class=\"btn btn-warning edit\" href='post.php?edit=$id'><i class=\"fa fa-pencil\"></i></a>
                    
                    <a class=\"btn btn-danger delete\" href='post.php?edit=$id'><i class=\"fa fa-remove\"></i></a>
                </div>
             </div>
             
             
          </div>
        </div>
        ";



     }

    $arr=['msg'=>$msg,'data'=>$data];
    echo json_encode($arr);

}
?>











