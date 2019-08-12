<div class="col-md-8"">
    <?php



    $per_page = 5;


    if(isset($_GET['page'])) {


        $page = $_GET['page'];

    } else {


        $page = 1;
    }


    if($page == "" || $page == 1) {

        $page_1 = 0;

    } else {

        $page_1 = ($page * $per_page) - $per_page;

    }


    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'){


    $post_query_count = "SELECT * FROM posts";


    } else {

        $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";

    }

    $find_count = mysqli_query($connection,$post_query_count);
    $count = mysqli_num_rows($find_count);

    if($count < 1) {


        echo "<h1 class='text-center'>No posts available</h1>";




    } else {


    $count  = ceil($count /$per_page);
//        echo "<script>alert($count);</script>";






        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'){


            $query = "SELECT * FROM posts LIMIT $page_1, $per_page";


        } else {

            $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page";

        }


    $select_posts_query = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_posts_query)) {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = substr($row['post_content'],0,400);
    //        $post_status = $row['post_status'];
    $post_category_id = $row['post_category_id'];

    $category_query = "SELECT * FROM categories WHERE category_id=$post_category_id";
    $select_category_query = mysqli_query($connection,$category_query);

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
            <li class="float-left"><?php echo $comment_count.' Comments'; ?></li>
        </ul>

        <p class="mt-4"><?php echo $post_content; ?></p>

        <div class="clearfix">
<!--            <a href="post/--><?php //echo $post_id; ?><!--" class="btn btn-outline-success mt-3 text-uppercase pull-left">read more</a>-->
            <a href="post.php?p_id=<?php echo $post_id; ?>" class="btn btn-outline-success mt-3 text-uppercase pull-left">read more</a>
            <h4 class="pull-right mt-3">by <span class="text-uppercase"><?php echo $post_author;?></span></h4>
        </div>

        <div class="border border-dark my-5"></div>

        <?php }} ?>
<!--    </div>-->




</div>