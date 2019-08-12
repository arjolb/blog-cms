<?php include "includes/admin_header.php" ?>

<?php




?>

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


                    <div class="col-xs-6">

<!--                        --><?php //insert_categories();  ?>



                        <?php

                            if (isset($_POST['submit'])){

                                $category_title = $_POST['cat_title'];

                                        if ($category_title=='' && empty($category_title)){
                                            echo "This field should not be empty";
                                        }
                                        else{
                                            $stmt=mysqli_prepare($connection,"INSERT INTO categories(category_title) VALUES (?)");
                                            mysqli_stmt_bind_param($stmt,'s',$category_title);
                                            mysqli_stmt_execute($stmt);


                                            if(!$stmt) {
                                                die('QUERY FAILED'. mysqli_error($connection));

                                            }

                                        }

                                        mysqli_stmt_close($stmt);



                            }

                        ?>


                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input value="<?php if (isset($_GET['edit'])){
                                    $cat_id = $_GET['edit'];

                                $query="SELECT * FROM categories WHERE category_id=$cat_id";
                                $result=mysqli_query($connection,$query);
                                while($row=mysqli_fetch_assoc($result)){
                                    $category_title=$row['category_title'];
                                }
                                echo $category_title;}
                                ?>"
                                       type="text" class="form-control" id="cat-title" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>

                        </form>

                        <?php // UPDATE AND INCLUDE QUERY

//                        if(isset($_GET['edit'])) {
//
//                            $cat_id = $_GET['edit'];
//
////                            include "includes/update_categories.php";
//
//                            $query="SELECT * FROM categories WHERE category_id=$cat_id";
//                            $result=mysqli_query($connection,$query);
//                            while($row=mysqli_fetch_assoc($result)){
//                                $category_title=$row['category_title'];
//                            }
//
//                        }




                        if (isset($_GET['edit'])){


                            if (isset($_POST['submit'])){

                                $category_title=escape($_POST['cat_title']);
                                $cat_id=escape($_GET['edit']);


                                $query="SELECT * FROM categories WHERE category_id=$cat_id";
                                $result=mysqli_query($connection,$query);
                                while ($row=mysqli_fetch_assoc($result)){
                                    $a=$row['category_title'];
                                        $stmt=mysqli_prepare($connection,"UPDATE categories SET category_title=? WHERE category_id=?");
                                        mysqli_stmt_bind_param($stmt,'si',$category_title,$cat_id);
                                        mysqli_stmt_execute($stmt);

                                        if(!$stmt){

                                            die("QUERY FAILED" . mysqli_error($connection));

                                        }

//                                            mysqli_stmt_close($stmt);
                                        header('Location:categories.php');


                                }

                            }


                        }

                        ?>


                    </div><!--Add Category Form-->

                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">


                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                                <th><i class="fa fa-pencil"></i></th>
                                <th><i class="fa fa-remove"></i></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php


                            $query = "SELECT * FROM categories";
                            $select_categories = mysqli_query($connection,$query);

                            while($row = mysqli_fetch_assoc($select_categories)) {
                                $cat_id = $row['category_id'];
                                $cat_title = $row['category_title'];

                                echo "<tr>";

                                echo "<td>{$cat_id}</td>";
                                echo "<td>{$cat_title}</td>";
                                echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                echo "</tr>";

                            }


                            ?>


                            </tbody>
                        </table>




                    </div>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>



    <?php

        if (isset($_GET['delete'])){
            $cat_id=$_GET['delete'];
            $query="DELETE FROM categories WHERE category_id=$cat_id";
            mysqli_query($connection,$query);
            header('Location: categories.php');
        }

    ?>





    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>
