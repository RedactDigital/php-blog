<?php


if (ifItIsMethod('post')) {


    if (isset($_POST['login'])) {


        if (isset($_POST['username']) && isset($_POST['password'])) {

            login_user($_POST['username'], $_POST['password']);
        } else {


            redirect('/');
        }
    }
}

?>

<!-- Blog Categories Well -->
<div class="well">



    <?php
    $query = "SELECT * FROM categories";
    $select_categories_sidebar = mysqli_query($connection, $query);
    ?>
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">

                <?php

                while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];

                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                }

                ?>

            </ul>
        </div>

    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php //include "widget.php"; 
?>

</div>