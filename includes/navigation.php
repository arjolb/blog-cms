<header>
    <div class="container">
        <h1>WEB DEVELOPMENT TIPS <small>A Personal blog about web development</small></h1>
    </div>
</header>


<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
        <a href="index.php" class="navbar-brand">HOME</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar"><span class="navbar-toggler-icon"></span></button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">

                <li class="nav-item dropdown px-2">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                    <div class="dropdown-menu bg-dark">
                        <?php
                          $query="SELECT * FROM categories";
                          $select_categories=mysqli_query($connection,$query);

                          confirmQuery($select_categories);

                          while ($row=mysqli_fetch_assoc($select_categories)){
                              $category_id = $row['category_id'];
                              $category_title = $row['category_title'];


                        echo "<a href='category.php?category=$category_id' class='dropdown-item text-white'>$category_title</a>"; }?>
                    </div>
                </li>

                <li class="nav-item px-2"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item px-2"><a href="contact.php" class="nav-link">Contact</a></li>
                <?php
                if (!isset($_SESSION['user_role']))
                    echo "<li class='nav-item px-2'><a href='registration.php' class='nav-link'>Registration</a></li>";

                 if (isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin')
                    echo "<li class='nav-item px-2'><a href='./admin/index.php' class='nav-link'>Admin</a></li>";

                 ?>

            </ul>


            <ul class="navbar-nav ml-auto">
                <form action="search.php" method="post">
                    <div class="input-group">
                         <input type="search" name="search" id="" class="form-control" placeholder="Search.." required minlength="3">
                         <button type="submit" name="submit" class="btn btn-primary input-group-append"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                <?php if (isset($_SESSION['user_role'])) echo "<li class='nav-item px-2'><a href='#' class='nav-link'>{$_SESSION['username']}</a></li>"; ?>
                <?php if (isset($_SESSION['user_role'])) echo "<li class='nav-item px-2'><a href='logout.php' class='nav-link'>LOGOUT</a></li>"; ?>
            </ul>

        </div>
    </div>
</nav>