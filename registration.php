<?php include "includes/db.php"; ?>
<?php include "includes/header.php" ;?>

<?php include "includes/navigation.php"; ?>


<?php

if ($_SERVER['REQUEST_METHOD']=='POST') {

    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);




    $errors = [
        'firstName' => '',
        'lastName' => '',
        'username' => '',
        'email' => '',
        'password' => '',
     ];


//Firstname validation
    if (strlen($firstName) < 4) {
        $errors['firstName'] = 'Firstname needs to be longer';
    }

    if (empty($firstName)) {
        $errors['firstName'] = "Firstname should not be empty";
    }


//Lastname validation
    if (strlen($lastName) < 4) {
        $errors['lastName'] = 'Lastname needs to be longer';
    }

    if (empty($lastName)) {
        $errors['lastName'] = "lastName should not be empty";
    }


//Username validation
    if (strlen($username) < 4) {
        $errors['username'] = 'Username needs to be longer';
    }

    if (empty($username)) {
        $errors['username'] = "Username should not be empty";
    }

    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0)

        $error['username'] = 'Username already exists, chose another username';



//Email validation

    if (empty($email)) {
        $errors['email'] = "Email should not be empty";
    }



    $query = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0)

        $error['email'] = 'Email already exists, <a href="index.php">Please login</a>';





//Password validation
    if (empty($password) || empty($confirmPassword)) {
        $errors['password'] = "Password should not be empty";
    }

    if ($password !== $confirmPassword) {
        $errors['password'] = "Passwords do not match!";
    }


    foreach ($errors as $key => $value) {

        if (empty($value)) {

            unset($errors[$key]);

        }

    }


    if (empty($errors)) {


//        global $connection;






        $firstName = mysqli_real_escape_string($connection, $firstName);
        $lastName = mysqli_real_escape_string($connection, $lastName);
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));


        $query = "INSERT INTO users (firstName, lastName, username, email, password, role) ";
        $query .= "VALUES('$firstName', '$lastName', '$username','$email', '$password', 'subscriber' )";
        $register_user_query = mysqli_query($connection, $query);

        confirmQuery($register_user_query);


        echo "<div class='container'>
            <div class='row'>
                <div class='col-lg-6 offset-lg-3'>
        "
         ."<p class='text-success'>"
            ."You are succesfully registred!"." You can login back to the homepage <a href='index.php'>Home</a></p>"
         ."</div>
            </div>
        </div>";
    }







}
?>


<form action="" method="POST" autocomplete="off">


   <div class="container">
       <div class="row py-4">
           <div class="col-lg-6 offset-lg-3">
              <h1 class="text-center">Register</h1>
                  <div class="form-group">
                      <label for="firstName">Firstname</label>
                      <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Enter your firstname"
                      value="<?php echo isset($firstName) ? $firstName: ''; ?>">

                      <p class="text-danger mt-1"><?php echo isset($errors['firstName']) ? $errors['firstName'] : '' ?></p>
                  </div>


                  <div class="form-group">
                      <label for="lastName">Lastname</label>
                      <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Enter your lastname"
                      value="<?php echo isset($lastName) ? $lastName: ''; ?>">

                      <p class="text-danger mt-1"><?php echo isset($errors['lastName']) ? $errors['lastName'] : '' ?></p>
                  </div>


                  <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username"
                      value="<?php echo isset($username) ? $username: ''; ?>">

                      <p class="text-danger mt-1"><?php echo isset($errors['username']) ? $errors['username'] : '' ?></p>
                  </div>


                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email"
                      value="<?php echo isset($email) ? $email: ''; ?>">

                      <p class="text-danger mt-1"><?php echo isset($errors['email']) ? $errors['email'] : '' ?></p>
                  </div>


                  <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">

                      <p class="text-danger mt-1"><?php echo isset($errors['password']) ? $errors['password'] : '' ?></p>
                  </div>


                  <div class="form-group">
                      <label for="confirmpassword">Confirm Password</label>
                      <input type="password" name="confirmPassword" id="confirmpassword" class="form-control" placeholder="Confirm your password">
                  </div>


                  <input type="submit" value="Register" class="btn btn-block btn-primary">


           </div>
       </div>
   </div>
    


</form>



<?php include "includes/footer.php"; ?>