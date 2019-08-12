<?php




if (isset($_GET['edit_user'])) {
    $user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE id='$user_id'";
    $get_user_query = mysqli_query($connection, $query);

    confirmQuery($get_user_query);
//    $firstName='';
//    $lastName='';
//    $email='';
//    $username='';
//    $role='';
    while ($row = mysqli_fetch_assoc($get_user_query)) {
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $email = $row['email'];
        $username = $row['username'];
        $role = $row['role'];
        $password=$row['password'];
    }


    if (isset($_POST['update_user'])){
        $firstName = escape($_POST['firstName']);
        $lastName = escape($_POST['lastName']);
        $email = escape($_POST['email']);
        $username = escape($_POST['username']);
        $role = escape($_POST['role']);

        $password = escape($_POST['password']);


        if (!empty($password)){

            $query="SELECT password FROM users WHERE id=$user_id";
            $pw_query=mysqli_query($connection,$query);
            confirmQuery($pw_query);

            $row=mysqli_fetch_array($pw_query);
            $db_user_pw=$row['password'];

            if ($db_user_pw!=$password){
                $hashed_pw = password_hash($password,PASSWORD_BCRYPT);
            }

            $query="UPDATE users SET";
            $query.=" firstName='$firstName',";
            $query.="lastName='$lastName',";
            $query.="username='$username',";
            $query.="email='$email',";
            $query.="role='$role',";
            $query.="password='$hashed_pw'";
            $query.=" WHERE id=$user_id";


            $update_user_query=mysqli_query($connection,$query);
            confirmQuery($update_user_query);

            echo "User Updated" ." " ."<a href='users.php'>View Users</a>";
        }
    }

} else {
    header('Location: index.php');
}

?>






<form action="" method="post">

    <div class="form-group">
        <label for="firstName">Firstname</label>
        <input type="text" id="firstName" class="form-control" name="firstName" value="<?php echo $firstName; ?>">
    </div>


    <div class="form-group">
        <label for="lastName">Lastname</label>
        <input type="text" id="lastName" class="form-control" name="lastName" value="<?php echo $lastName; ?>">
    </div>


    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" class="form-control" name="username" value="<?php echo $username?>">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" class="form-control" name="email" value="<?php echo $email; ?>">
    </div>


    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" class="form-control" name="password">
    </div>


    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="role">
            <option value="<?php echo $role; ?>"> <?php echo $role; ?> </option>
            <?php
                if ($role=='admin'){
                    echo "<option value='subscriber'>Subscriber</option>";
                }
                else{
                    echo "<option value='admin'>Admin</option>";
                }
            
            ?>
        </select>
    </div>


    <div class="form-group">
        <input type="submit" value="Update User" name="update_user" class="btn btn-block btn-primary">
    </div>


</form>