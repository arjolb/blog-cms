<?php


    if (isset($_POST['add_user'])){

        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $email=$_POST['email'];
        $username=$_POST['username'];
        $role=$_POST['role'];

        $password=$_POST['password'];


        $password=password_hash($password,PASSWORD_BCRYPT);



        $query="INSERT INTO users(firstName,lastName,email,username,password,role)";
        $query.="VALUES('$firstName', '$lastName', '$email', '$username', '$password', '$role')";

        $create_user_query = mysqli_query($connection, $query);

        confirmQuery($create_user_query);

        echo "User Created: " . " " . "<a href='users.php'>View Users</a> ";

    }


?>


<form action="" method="post">


    <div class="form-group">
        <label for="firstName">FirstName</label>
        <input type="text" id="firstName" class="form-control" name="firstName">
    </div>


    <div class="form-group">
        <label for="lastName">LastName</label>
        <input type="text" id="lastName" class="form-control" name="lastName">
    </div>


    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>


    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control">
    </div>


    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>


    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="role" class="form-control">
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>


    <div class="form-group">
        <input type="submit" value="Add User" name="add_user" class="btn btn-block btn-primary">
    </div>


</form>