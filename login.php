<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>

<?php

if($_SERVER['REQUEST_METHOD']==='POST'){





        if(isset($_POST['login'])){

//            login_user($_POST['username'], $_POST['password']);


            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $username = mysqli_real_escape_string($connection, $username);
            $password = mysqli_real_escape_string($connection, $password);


            $query = "SELECT * FROM users WHERE username = '$username' ";
            $select_user_query = mysqli_query($connection, $query);

            confirmQuery($select_user_query);


            while ($row = mysqli_fetch_array($select_user_query)) {

                $db_user_id = $row['id'];
                $db_username = $row['username'];
                $db_user_password = $row['password'];
                $db_user_firstname = $row['firstName'];
                $db_user_lastname = $row['lastName'];
                $db_user_role = $row['role'];


                if (password_verify($password,$db_user_password)) {


                    $_SESSION['username'] = $db_username;
                    $_SESSION['firstname'] = $db_user_firstname;
                    $_SESSION['lastname'] = $db_user_lastname;
                    $_SESSION['user_role'] = $db_user_role;



                }



            }



        }else {


            header('Location:/blog/index.php');
        }




}
//header('Location:/blog/index.php');
//echo $_SESSION['user_role'];



if ($_SESSION['user_role']==='admin'){
    header("Location:/blog/admin/index.php");}
else {
    header("Location:" . $_SERVER['HTTP_REFERER']);
}