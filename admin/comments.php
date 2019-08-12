<?php include "includes/admin_header.php" ?>

<div id="wrapper">



    <!-- Navigation -->

    <?php include "includes/admin_navigation.php" ?>







    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>


                    <table class="table-bordered table-hover table-striped table-responsive" width="100%">

                    <thead>
                    <tr>
                        <!--            <th><input id="selectAllBoxes" type="checkbox"></th>-->
                        <th>Id</th>
                        <th>Post</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                    </thead>



<?php


             $query = "SELECT * FROM comments";
             $select_comments=mysqli_query($connection,$query);

             while ($row=mysqli_fetch_assoc($select_comments)){
                 $id=$row['id'];
                 $post_comment_id=$row['post_comment_id'];
                 $user_username=$row['user_username'];
                 $comment_name=$row['comment_name'];
                 $comment_content=$row['comment_content'];
                 $comment_status=$row['comment_status'];
                 $comment_date=$row['comment_date'];

?>


       <tbody>

       <tr>
            <td><?php echo $id; ?></td>
            <td><?php
                $query="SELECT post_title from posts WHERE post_id=$post_comment_id";
                $select_post_title=mysqli_query($connection,$query);

                while($row=mysqli_fetch_assoc($select_post_title)){
                    $post_title=$row['post_title'];
                }
                echo $post_title;
                ?>
            </td>
            <td><?php echo $user_username; ?></td>
            <td><?php echo $comment_name; ?></td>
            <td><?php echo $comment_content; ?></td>
            <td><?php echo $comment_status; ?></td>
            <td><?php echo $comment_date; ?></td>
       </tr>

<?php } ?>

       </tbody>



        </table>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>


    <!-- /#page-wrapper -->






<?php include 'includes/admin_footer.php';