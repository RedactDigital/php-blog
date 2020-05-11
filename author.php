<?php include "includes/head.php"; ?>
<?php include "includes/header.php"; ?>

<?php

$per_page = 12;

if (isset($_GET['author'])) {

    $the_post_author = $_GET['author'];


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


        $post_query_count = "SELECT * FROM posts WHERE post_user = '$the_post_author' ";
    } else {

        $post_query_count = "SELECT * FROM posts WHERE post_user = '$the_post_author' AND post_status = 'published' ";
    }

?>

        <!-- s-content
    ================================================== -->
        <section class="s-content">

            <div class="row narrow">
                <div class="col-full s-content__header" data-aos="fade-up">
                    <h1>Posts By: <?php echo ucfirst($the_post_author); ?></h1>

                    <p class="lead"><?php 

                    $query = "SELECT * FROM users WHERE username = '$the_post_author' ";
                    $query_user = mysqli_query($connection, $query);
                    confirmQuery($query_user);
                    
                    $row = mysqli_fetch_assoc($query_user);
                    $user_about = $row['user_about'];

                    echo $user_about; 
                    ?>
                    </p>
                </div>
            </div>
            <div class="row masonry-wrap">
                <div class="masonry">
                    <div class="grid-sizer"></div>

                    <?php
                    $find_count = mysqli_query($connection, $post_query_count);
                    $count = mysqli_num_rows($find_count);

                    if ($count < 1) {


                        echo "<h1 class='text-center' style='position: relative; top: -50px;'>No posts available</h1>";
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
                            //$post_content = substr($row['post_content'], 0, 75);
                            $post_status = $row['post_status'];

                    ?>

                            <article class="masonry__brick entry format-standard" data-aos="fade-up">
                                <div class="entry__thumb">
                                    <a href="post.php?p_id=<?php echo $post_id; ?>" class="entry__thumb-link">
                                        <img src="images/<?php echo $post_image; ?>" srcset="images/<?php echo $post_image; ?> 1x, images/<?php echo $post_image; ?> 2x" alt="">
                                    </a>
                                </div>
                                <div class="entry__text">
                                    <div class="entry__header">

                                        <div class="entry__date">
                                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_date ?></a>
                                        </div>
                                        <h1 class="entry__title"><a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a></h1>

                                    </div>
                                    <!-- <div class="entry__excerpt">
                                        <p>
                                            <?php echo $post_content ?>
                                        </p>
                                    </div> -->
                                    <div class="entry__meta">
                                        <span class="entry__meta-links">
                                            <a href="category.html">Design</a>
                                            <a href="category.html">Photography</a>
                                        </span>
                                    </div>
                                </div>
                            </article>


                <?php
                        }
                    }
    }
                ?>
                </div>
            </div>
            <div class="row">
                <div class="col-full">
                    <nav class="pgn">
                        <ul class="pager">

                            <?php

                            // $number_list = array();

                            // for ($i = 1; $i <= $count; $i++) {

                            //     if ($i == $page) {

                            //         echo "<li '><a class='active_link' href='category.php?page={$i}'>{$i}</a></li>";
                            //     } else {

                            //         echo "<li '><a href='category.php?page={$i}'>{$i}</a></li>";
                            //     }
                            // }
                            ?>

                        </ul>
                    </nav>
                </div>
            </div>

        </section>

        <?php include "includes/footer.php"; ?>