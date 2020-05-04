<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>



<!-- Page Content -->
<div class="container-fluid">
    <div class="jumbotron">
        <div class="container">
            <div class="page-header">
                <h1 class="text-center">A Blog for Millennials</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="jumbotron">
                <?php
                $query = "SELECT * FROM categories";
                $select_categories_sidebar = mysqli_query($connection, $query);
                ?>
                <h3>Blog Categories</h3>
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
        </div>
        <div class="col-md-6">
            <div class="jumbotron">
                <h3>Authors</h3>
                <p>...</p>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- Blog Entries Column -->

        <div class="col-md-12">
            <?php

            $per_page = 10;


            if (isset($_GET['page'])) {


                $page = $_GET['page'];
            } else {


                $page = "";
            }


            if ($page == "" || $page == 1) {

                $page_1 = 0;
            } else {

                $page_1 = ($page * $per_page) - $per_page;
            }


            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {


                $post_query_count = "SELECT * FROM posts";
            } else {

                $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
            }

            $find_count = mysqli_query($connection, $post_query_count);
            $count = mysqli_num_rows($find_count);

            if ($count < 1) {


                echo "<h1 class='text-center'>No posts available</h1>";
            } else {


                $count  = ceil($count / $per_page);

                $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
                $select_all_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 400);
                    $post_status = $row['post_status'];

            ?>

                    <!-- First Blog Post -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="jumbotron">
                                <a href="post.php?p_id=<?php echo $post_id; ?>">
                                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                                </a>
                                <h2>
                                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                                </h2>
                                <p class="lead">
                                    by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                                <hr>
                                <p><?php echo $post_content ?></p>
                                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                                <hr>
                            </div>
                        </div><?php }
                        } ?>

                    </div>
        </div>



        <!-- Blog Sidebar Widgets Column -->


        <?php include "includes/sidebar.php"; ?>


    </div>
    <!-- /.row -->

    <hr>


    <ul class="pager">

        <?php

        $number_list = array();


        for ($i = 1; $i <= $count; $i++) {


            if ($i == $page) {

                echo "<li '><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            } else {

                echo "<li '><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }






        ?>





    </ul>



    <?php include "includes/footer.php"; ?>