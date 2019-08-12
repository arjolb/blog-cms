<div class="col-md-4"">


   <?php if (!isset($_SESSION['user_role']))
    echo "
    <div class=\"card card-body bg-light\">
       <form action='login.php' method='post'>
        <h3 class='text-capitalize'>login</h3>
        <div class='form-group'>
            <input type='text' class='form-control' placeholder='Enter username' name='username'>
        </div>

        <div class='form-group'>
            <input type='password' class='form-control' placeholder='Enter password' name='password'>
        </div>
        <input type='submit' value='Login' class='btn btn-secondary' name='login'>

       </form> 
    </div>
    ";
    ?>



<div class="card card-body bg-light mt-3">

        <h3 class="text-capitalize">Categories</h3>
        <?php
        $query = "SELECT * FROM categories";
        $result = mysqli_query($connection,$query);

        while ($row=mysqli_fetch_assoc($result)){
            $id=$row['category_id'];
            $category=$row['category_title'];
            echo "<a href='category.php?category=$id'>$category</a>";
        }
        ?>
</div>

</div>