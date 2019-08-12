<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>



<?php include "includes/navigation.php"; ?>





<?php // if (isset($_SERVER['HTTP_REFERER'])) echo $_SERVER['HTTP_REFERER']; ?>





<div class="container">

    <div class="row mt-3">


        <div class="col-md-8">
            <?php

                if (isset($_GET['p_id'])){

                    $post_id = $_GET['p_id'];


                    $query = "SELECT * FROM posts WHERE post_id=$post_id";


                    $result=mysqli_query($connection,$query);
                    while ($row=mysqli_fetch_assoc($result)){

                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,400);

                        $post_status = $row['post_status'];

                        $post_category_id = $row['post_category_id'];

                        $category_query = "SELECT * FROM categories WHERE category_id=$post_category_id";
                        $select_category_query = mysqli_query($connection,$category_query);


                        if ($post_status!=='published' && $_SESSION['user_role']!=='admin'){
                            header('Location: index.php');
                        }



                        while ($category_row=mysqli_fetch_assoc($select_category_query)){
                            $post_category = $category_row['category_title'];

                        }

                        $comment_query = "SELECT * FROM comments WHERE post_comment_id=$post_id";
                        $select_comments_query=mysqli_query($connection,$comment_query);
                        $comment_count = mysqli_num_rows($select_comments_query);

                        ?>


                        <!--    <div class="mt-3">-->
                        <img src="images/<?php echo $post_image; ?>" alt="Image" class="img-fluid d-block">
                        <h1 class="text-uppercase mt-3"><?php echo $post_title; ?></h1>

                        <ul class="clearfix">
                            <li class="float-left mr-5 text-capitalize" style="list-style: none; color: #5cb85c;"><?php echo $post_category; ?></li>
                            <li class="float-left mr-5"> <i class="fa fa-clock-o"></i> <?php echo $post_date; ?></li>
                            <li class="float-left"><?php echo $comment_count.' Comments' ;?></li>
                        </ul>

                        <p class="mt-4"><?php echo $post_content; ?></p>

                        <div class="clearfix">

                            <h4 class="pull-right mt-3">by <span class="text-uppercase"><?php echo $post_author;?></span></h4>
                        </div>





            <div class="border border-dark my-5"></div>








            <!-- ADD AND EDIT  -->


            <?php

//            if (isset($_POST['submit'])){
//                $comment=$_POST['comment'];
//                $firstname=mysqli_real_escape_string($connection,$_POST['firstname']);
//                $lastname=mysqli_real_escape_string($connection,$_POST['lastname']);
//                $name=$firstname.' '.$lastname;
//
//
//                $comment = preg_replace('/\s+/', ' ', $comment);
//
//
//
//                if (empty($comment) || strlen($comment)===1){
//                    echo "<script>alert('Please fill out!');</script>";
//                }else{
//                    $sql="INSERT INTO comments(comment_date,post_comment_id,user_username,comment_name,comment_content) VALUES(now(),?,?,?,?)";
//
//                    $query_comment=mysqli_prepare($connection,$sql);
//
//                    mysqli_stmt_bind_param($query_comment,'isss',$post_id,$_SESSION['username'],$name,$comment);
//                    mysqli_stmt_execute($query_comment);
//                }
//
//
//
//            }


//            if (isset($_POST['update'])){
//                $updated_comment=mysqli_real_escape_string($connection,$_POST['update_comment']);
//                $comment_id=mysqli_real_escape_string($connection,$_POST['comment_id']);
//
//               $a = trim(preg_replace('/[\t\n\r\s]+/', '', $updated_comment));
//
//                if (empty($updated_comment) || $updated_comment==='' || $updated_comment!==$a){
//                    echo "<script>alert('Please fill out!');</script>";
//                }else{
//                    $update_comment_query="UPDATE comments SET comment_content='$updated_comment',comment_date=now() WHERE id=$comment_id";
//                    mysqli_query($connection,$update_comment_query);
//                }
//            }

            ?>

                    <?php }} ?>



         <!-- COMMENTS -->


            <div class="row">
                <div class="col-sm-12">



                    <?php



                    if(isset($_SESSION['user_role'])){
                        echo "



                    <form action=\"\" method=\"post\" class='add-comment' id='add-comment'>
                        <div class=\"card card-body mt-4 bg-light\">
                            <h3>Leave a Comment</h3>
                        <div class=\"form-group\">
                         <label for=\"add_comment\">Your Comment</label>
                            <textarea name=\"comment\" id=\"add_comment\" cols=\"10\" rows=\"4\" class=\"form-control\"></textarea>
                            <input type='hidden' value='$post_id' id='post_id'>
                            <input type='hidden' name='comment_username' value='{$_SESSION['username']}' id='comment_username'>
                            <input type='hidden' name='firstname' value='{$_SESSION['firstname']}'>
                            <input type='hidden' name='lastname' value='{$_SESSION['lastname']}'>
                                        
                            <button type=\"submit\" class=\"btn btn-secondary mt-3 add-comment-btn\" name='submit'>Submit</button>
                        </div>
                         </div>
                    </form>
            


            
            
                    <form action=\"\" method=\"post\" class='edit-comment' id='edit-comment'>
                        <div class=\"card card-body mt-4 bg-light\">
                        <h3 class='pull-left'>Update Your Comment</h3>
                        <div class='pull-right'><button class='btn btn-secondary btn-sm pull-right close'>X</button></div>
                            <div class=\"form-group\">
                                <label for=\"update_comment\">Your Comment</label>
                                <textarea name=\"update_comment\" id=\"update_comment\" cols=\"10\" rows=\"4\" class=\"form-control\"></textarea>
                                <input type='hidden' name='firstname' value='{$_SESSION['firstname']}'>
                                <input type='hidden' name='lastname' value='{$_SESSION['lastname']}'>
                                <input type='hidden' name='comment_id' id='comment_update_id'>
                                <button type=\"submit\" class=\"btn btn-secondary mt-3 edit-comment-btn\" name=\"update\">Update Comment</button>
                            </div>
                        </div>
                    </form>
            
            
                    ";





                    }else{
                        echo "
                        <div class=\"card card-body mt-4 bg-light\">
                        <h3><i class=\"fa fa-lock\"></i> You need to be logged-in order to comment.</h3>
                        </div>
                    ";
                    }


                    ?>



                </div>
            </div>















            <?php

                $query="SELECT * FROM comments WHERE post_comment_id=$post_id ORDER BY id DESC";
                $result=mysqli_query($connection,$query);
                confirmQuery($result);

                while ($row=mysqli_fetch_assoc($result)){
                    $comment_id = $row['id'];
                    $comment_date   = $row['comment_date'];
                    $comment_content= $row['comment_content'];
                    $comment_name = $row['comment_name'];

                    $user_username=$row['user_username'];
                ?>
<div id="output"></div>
                    <div class="border-bottom comment-<?php echo $comment_id;?>" id="comment-<?php echo $comment_id?>">

                        <div class="row mb-3">
                            <div class="col-sm-9">
                                <div class="mt-4">

<!--                                    <a class="pull-left comment-image" href="#">-->
                                        <img class="mr-4 pull-left" src="http://placehold.it/64x64" alt="">
<!--                                    </a>-->

                                    <h4 class="text-capitalize"><?php echo $comment_name;   ?>
                                        <small><?php echo date('F j, Y',strtotime($comment_date))  ?></small>
                                    </h4>

                                    <p class="lead"> <?php echo $comment_content;  ?> </p>


                                </div>
                            </div>


                            <?php

                                if (isset($_SESSION['username']) && $_SESSION['username']===$user_username){
                                    echo "
                            <div class=\"col-sm-3\">
                                <div class=\"mt-4 pull-right\">


                                    <a class=\"btn btn-warning edit\" href='post.php?edit=$comment_id'><i class=\"fa fa-pencil\"></i></a>
                                    <a class=\"btn btn-danger delete\" href='post.php?edit=$comment_id'><i class=\"fa fa-remove\"></i></a>


                                </div>
                            </div>
                                    ";
                                }

                            ?>


                        </div>
                    </div>

            <?php }    ?>




        </div>


            <?php include "includes/sidebar.php";?>




    </div>

</div>





<?php include "includes/footer.php"; ?>