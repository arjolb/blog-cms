<?php
//
//    if (isset($_POST['checkBoxArray'])){
//
//        foreach ($_POST['checkBoxArray'] as $postValueId){
//
//        }
//
//
//    }
//
//
//?>


<form action="" method="post">


    <table class="table-bordered table-hover table-striped table-responsive" width="100%">

<!--        <div  class="col-xs-4">-->
<!--            <label for="options">Options</label>-->
<!--            <select class="form-control" name="bulk_options" id="options">-->
<!--                <option value="">Select Options</option>-->
<!--                <option value="approved">Approve</option>-->
<!--                <option value="unapproved">Unapprove</option>-->
<!--                <option value="delete">Delete</option>-->
<!--            </select>-->
<!---->
<!--        </div>-->


<!--        <div class="col-xs-4">-->
<!---->
<!--            <input type="submit" name="submit" class="btn btn-success" value="Apply">-->
<!--            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>-->
<!---->
<!--        </div>-->





        <thead>
        <tr>
<!--            <th><input id="selectAllBoxes" type="checkbox"></th>-->
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
<!--            <th>Status</th>-->
            <th>Image</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Status</th>
            <th>View Post</th>
            <th>Edit</th>
            <th>Delete</th>

<!--            <th>Views</th>-->
        </tr>
        </thead>


            <tbody>


        <?php

        $query = "SELECT * FROM posts ORDER BY post_id DESC ";
        $select_posts = mysqli_query($connection,$query);


        while($row = mysqli_fetch_assoc($select_posts )) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_category_id = $row['post_category_id'];
            $post_image = $row['post_image'];
            $post_date = $row['post_date'];
            $post_status = $row['post_status'];

        ?>

            <tr>
<!--                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray' value='--><?php //echo $post_id; ?><!--'></td>-->
                <td><?php echo $post_id; ?></td>
                <td><?php echo $post_author; ?></td>
                <td><?php echo $post_title; ?></td>
                <td>
                <?php

                    $query = "SELECT * FROM categories WHERE category_id = {$post_category_id} ";
                    $select_categories_id = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($select_categories_id)) {
                        $cat_id = $row['category_id'];
                        $cat_title = $row['category_title'];


                        echo $cat_title;
                    }

                ?>
                </td>
                <td><?php echo "<img src='../images/$post_image' width='100' alt='image'>"; ?></td>
                <td><?php echo "&nbsp;"?></td>
                <td><?php echo $post_date; ?></td><td><?php echo $post_status; ?></td>
                <td><a href="../post.php?p_id=<?php echo $post_id; ?>" class="btn btn-primary">View Post</a></td>
                <td><a href="posts.php?source=edit_post&p_id=<?php echo $post_id;?>" class="btn btn-info">Edit</a></td>


                <form action="" method="post">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <td>  <input type="submit" value="Delete" class="btn btn-danger" name="delete">  </td>
                </form>

            </tr>
        <?php
        }
        ?>



            </tbody>


    </table>

</form>





<?php

    if (isset($_POST['delete'])){
        $post_id = $_POST['post_id'];

        $query="DELETE FROM posts WHERE post_id=$post_id";
        $delete_query=mysqli_query($connection,$query);

        confirmQuery($delete_query);

        header('Location:posts.php');
    }

?>