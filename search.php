<?php include "includes/db.php";?>
<?php include "includes/header.php"; ?>



<?php include "includes/navigation.php"; ?>


<div class="container">
    <div class="row mt-3">



        <div class="col-md-8">


            <?php

            if (isset($_POST['submit'])) {
                $search = $_POST['search'];

                $sql = "SELECT * FROM posts WHERE post_title LIKE '%$search%'";
                $result = mysqli_query($connection, $sql);


                $count = mysqli_num_rows($result);

                if ($count == 0) {

                    echo "<h1> NO RESULT</h1>";

                } else {


                    while ($row = mysqli_fetch_assoc($result)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0, 400);
                        //        $post_status = $row['post_status'];
                        $post_category_id = $row['post_category_id'];

                        $category_query = "SELECT * FROM categories WHERE category_id=$post_category_id";
                        $select_category_query = mysqli_query($connection, $category_query);

                        while ($category_row = mysqli_fetch_assoc($select_category_query)) {
                            $post_category = $category_row['category_title'];

                        }

                        $comment_query = "SELECT * FROM comments WHERE post_comment_id=$post_id";
                        $select_comments_query = mysqli_query($connection, $comment_query);
                        $comment_count = mysqli_num_rows($select_comments_query);


                        ?>


                        <!--    <div class="mt-3">-->
                        <img src="images/<?php echo $post_image; ?>" alt="Image" class="img-fluid d-block">
                        <h1 class="text-uppercase mt-3"><?php echo $post_title; ?></h1>

                        <ul class="clearfix">
                            <li class="float-left mr-5 text-capitalize"
                                style="list-style: none; color: #5cb85c;"><?php echo $post_category; ?></li>
                            <li class="float-left mr-5"><i class="fa fa-clock-o"></i> <?php echo $post_date; ?></li>
                            <li class="float-left"><?php echo $comment_count . ' Comments'; ?></li>
                        </ul>

                        <p class="mt-4"><?php echo $post_content; ?></p>

                        <div class="clearfix">
                            <!--            <a href="post/--><?php //echo $post_id;
                            ?><!--" class="btn btn-outline-success mt-3 text-uppercase pull-left">read more</a>-->
                            <a href="post.php?p_id=<?php echo $post_id; ?>"
                               class="btn btn-outline-success mt-3 text-uppercase pull-left">read more</a>
                            <h4 class="pull-right mt-3">by <span class="text-uppercase"><?php echo $post_author; ?></span></h4>
                        </div>

                        <div class="border border-dark my-5"></div>
                        <?php
                    }
                }
            }

            ?>

        </div>
</div>



<?php include 'includes/sidebar.php' ;?>



</div>


<?php include 'includes/footer.php'; ?>