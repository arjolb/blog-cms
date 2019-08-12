<table class="table table-bordered table-hover">

    <thead>

        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th colspan="2"><i class="fa fa-edit"></i> User Role</th>
        </tr>

    </thead>


    <tbody>

        <tr>

            <?php

                $query="SELECT * FROM users";
                $users_query=mysqli_query($connection,$query);

                confirmQuery($users_query);


                while ($row=mysqli_fetch_assoc($users_query)){
                    $user_id=$row['id'];
                    $user_firstName=$row['firstName'];
                    $user_lastName=$row['lastName'];
                    $user_email=$row['email'];
                    $user_username=$row['username'];
                    $user_role=$row['role'];
                ?>

                    <td><?php echo $user_id?></td>
                    <td><?php echo $user_username ?></td>
                    <td><?php echo $user_firstName ?></td>
                    <td><?php echo $user_lastName ?></td>
                    <td><?php echo $user_email ?></td>
                    <td><?php echo $user_role ?></td>

                    <?php
                    echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                    echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
                    echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                    echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
                    ?>
        </tr>
               <?php } ?>








    </tbody>


</table>





<?php

if(isset($_GET['change_to_admin'])) {

    $the_user_id = escape($_GET['change_to_admin']);

    $query = "UPDATE users SET role = 'admin' WHERE id = $the_user_id   ";
    $change_to_admin_query = mysqli_query($connection, $query);
    header("Location: users.php");


}





if(isset($_GET['change_to_sub'])){

    $the_user_id = escape($_GET['change_to_sub']);


    $query = "UPDATE users SET role = 'subscriber' WHERE id = $the_user_id   ";
    $change_to_sub_query = mysqli_query($connection, $query);
    header("Location: users.php");



}




if(isset($_GET['delete'])){

    if(isset($_SESSION['user_role'])) {

        if($_SESSION['user_role'] == 'admin') {

            $the_user_id = escape($_GET['delete']);

            $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
            $delete_user_query = mysqli_query($connection, $query);
            header("Location: users.php");

        }


    }

}



?>
