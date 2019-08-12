<?php

    if (isset($_POST['add_post'])){
        $post_title = escape($_POST['post_title']);
        $post_category_id = escape($_POST['post_category']);
        $post_author = escape($_POST['post_author']);

        $post_image = escape($_FILES['image']['name']);
        $post_image_temp = escape($_FILES['image']['tmp_name']);

        $post_content = escape($_POST['post_content']);
        $post_date = escape(date('d-m-y'));










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














        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date,post_image,post_content) ";

        $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}', '{$post_date}','{$post_image}','{$post_content}') ";

        $add_post_query=mysqli_query($connection,$query);
        confirmQuery($add_post_query);

        $the_post_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";

    }


?>


<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" id="post_title" name="post_title">
    </div>
    
    
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="post_category" id="post_category">
            <?php

            $query="SELECT * FROM categories";
            $categories_query=mysqli_query($connection,$query);
            confirmQuery($categories_query);

            while ($row=mysqli_fetch_assoc($categories_query)){
                $cat_id=$row['category_id'];
                $cat_title=$row['category_title'];

                echo "<option value='$cat_id'>$cat_title</option>";
            }
            ?>
        </select>
    </div>


    <div class="form-group">
        <label for="post_author">Post Author</label>
        <select name="post_author" id="post_author">
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
        <label for="post_image">Post Image</label>
        <input type="file"  name="image" id="post_image">
    </div>


    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="post_content" style="resize: none;" rows="10" class="form-control">

        </textarea>
    </div>


    <div class="form-group">
        <input type="submit" value="Add Post" name="add_post" class="btn btn-primary btn-block">
    </div>


</form>
