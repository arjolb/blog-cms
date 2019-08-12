<?php include "includes/db.php";?>
<?php include "includes/header.php"; ?>



<?php include "includes/navigation.php"; ?>



<div class="container">


   <div class="row mt-3">

        <?php include "includes/posts.php"; ?>


       <?php include "includes/sidebar.php"; ?>




       <ul class="pagination">

           <?php




           for($i =1; $i <= $count; $i++) {


               if($i == $page) {

                   echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";


               }  else {

                   echo "<li class='page-item '><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";



               }



           }


           ?>


       </ul>




















   </div>










</div><!-- ./container-->
<?php include "includes/footer.php"; ?>