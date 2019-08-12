<?php

if (isset($_GET['p_id'])) {
    $post_id = $_GET['p_id'];
}

    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $select_post = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_post)) {
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_category_id = $row['post_category_id'];
        $post_content = $row['post_content'];
        $post_image = $row['post_image'];
        $post_date = $row['post_date'];
    }

    if (isset($_POST['update_post'])) {


        $post_title = escape($_POST['post_title']);
        $post_author = escape($_POST['post_author']);
        $post_category_id = escape($_POST['post_category']);
//        $post_status         =  escape($_POST['post_status']);
        $post_image = escape($_FILES['image']['name']);
        $post_image_temp = escape($_FILES['image']['tmp_name']);
        $post_content = escape($_POST['post_content']);
        $post_status = escape($_POST['post_status']);
//        move_uploaded_file($post_image_temp, "../images/$post_image");


//        if (move_uploaded_file($post_image_temp, "..images/$post_image")) {
//            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
//        } else {
//            print_r($_FILES);
//            echo "Sorry, there was an error uploading your file.";
//        }


        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
//        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
//        }
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }











        if (empty($post_image)) {

            $query = "SELECT * FROM posts WHERE post_id = $post_id ";
            $select_image = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($select_image)) {

                $post_image = $row['post_image'];

            }


        }



        $post_title = mysqli_real_escape_string($connection, $post_title);


        $query = "UPDATE posts SET ";
        $query .="post_title  = '{$post_title}', ";
        $query .="post_category_id = '{$post_category_id}', ";
        $query .="post_date   =  now(), ";
        $query .="post_author = '{$post_author}', ";
//        $query .="post_status = '{$post_status}', ";
        $query .="post_content= '{$post_content}', ";
        $query .="post_image  = '{$post_image}', ";
        $query .="post_status = '{$post_status}' ";
        $query .= "WHERE post_id = {$post_id} ";

        $update_post = mysqli_query($connection,$query);

        confirmQuery($update_post);

        echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";


    }



?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" value="<?php echo $post_title;?>" id="post_title" name="post_title">
    </div>



    <div class="form-group">
        <label for="post_author">Post Author</label>
        <select class="form-control" id="post_author" name="post_author">
            <?php
            $query="SELECT * FROM users";
            $users_query=mysqli_query($connection,$query);
            confirmQuery($users_query);

            while ($row=mysqli_fetch_assoc($users_query)){
                $user_id=$row['id'];
                $user_firstName=$row['firstName'];
                $user_lastName=$row['lastName'];

                echo "<option value='$user_firstName $user_lastName'>$user_firstName $user_lastName</option>";
            }
            ?>
        </select>
    </div>



    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="post_category" id="post_category" class="form-control">
            <?php
                $query="SELECT * FROM categories";
                $result=mysqli_query($connection,$query);

                while ($row=mysqli_fetch_assoc($result)){
                    $cat_id=$row['category_id'];
                    $cat_title=$row['category_title'];

                    if ($cat_id==$post_category_id){
                        echo "<option value='$cat_id'>$cat_title</option>";
                    }else {

                        echo "<option value='{$cat_id}'>{$cat_title}</option>";


                    }
                }
            ?>
        </select>
    </div>


    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status" class="form-control">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>


    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input  type="file" name="image">
    </div>


    
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="post_content" cols="30" rows="10" class="form-control"><?php echo $post_content;?></textarea>
    </div>




<!--    <div class="form-group"></div>-->
    <div class="form-group">
        <input type="submit" value="Update Post" name="update_post" class="btn btn-block btn-primary">
    </div>

</form>
