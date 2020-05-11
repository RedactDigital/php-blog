<?php
include('includes/head.php');
include('includes/header.php');
?>


<!-- s-content
    ================================================== -->
<section class="s-content">

    <div class="row masonry-wrap">
        <div class="masonry">
            <div class="grid-sizer"></div>

            <?php

            $per_page = 12;


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
                    $post_content = substr($row['post_content'], 0, 75);
                    $post_status = $row['post_status'];
                    $post_tags_id = $row['post_tags_id'];

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
                                    <?php
                                    $query = "SELECT * FROM tags WHERE tag_id = '$post_tags_id' ";
                                    $query_categories = mysqli_query($connection, $query);

                                    while ($row = mysqli_fetch_assoc($query_categories)) {

                                        $the_post_tags = $row['tag_title'];

                                    
                                    ?>
                                    <a href="category.html"><?php echo $the_post_tags; }?></a>
                                </span>
                            </div>
                        </div>

                    </article> <!-- end article --><?php }
                                            } ?>
        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->

    <div class="row">
        <div class="col-full">
            <nav class="pgn">
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
            </nav>
        </div>
    </div>

</section> <!-- s-content -->


<!-- s-extra
    ================================================== -->
<section class="s-extra">

    <div class="row top">

        <?php /*<div class="col-eight md-six tab-full popular">
            <h3>Popular Posts</h3>

            <div class="block-1-2 block-m-full popular__posts">
                <article class="col-block popular__post">
                    <a href="#0" class="popular__thumb">
                        <img src="images/thumbs/small/wheel-150.jpg" alt="">
                    </a>
                    <h5><a href="#0">Visiting Theme Parks Improves Your Health.</a></h5>
                    <section class="popular__meta">
                        <span class="popular__author"><span>By</span> <a href="#0"> John Doe</a></span>
                        <span class="popular__date"><span>on</span> <time datetime="2017-12-19">Dec 19, 2017</time></span>
                    </section>
                </article>
                <article class="col-block popular__post">
                    <a href="#0" class="popular__thumb">
                        <img src="images/thumbs/small/shutterbug-150.jpg" alt="">
                    </a>
                    <h5><a href="#0">Key Benefits Of Family Photography.</a></h5>
                    <section class="popular__meta">
                        <span class="popular__author"><span>By</span> <a href="#0"> John Doe</a></span>
                        <span class="popular__date"><span>on</span> <time datetime="2017-12-18">Dec 18, 2017</time></span>
                    </section>
                </article>
                <article class="col-block popular__post">
                    <a href="#0" class="popular__thumb">
                        <img src="images/thumbs/small/cookies-150.jpg" alt="">
                    </a>
                    <h5><a href="#0">Absolutely No Sugar Oatmeal Cookies.</a></h5>
                    <section class="popular__meta">
                        <span class="popular__author"><span>By</span> <a href="#0"> John Doe</a></span>
                        <span class="popular__date"><span>on</span> <time datetime="2017-12-16">Dec 16, 2017</time></span>
                    </section>
                </article>
                <article class="col-block popular__post">
                    <a href="#0" class="popular__thumb">
                        <img src="images/thumbs/small/beetle-150.jpg" alt="">
                    </a>
                    <h5><a href="#0">Throwback To The Good Old Days.</a></h5>
                    <section class="popular__meta">
                        <span class="popular__author"><span>By</span> <a href="#0"> John Doe</a></span>
                        <span class="popular__date"><span>on</span> <time datetime="2017-12-16">Dec 16, 2017</time></span>
                    </section>
                </article>
                <article class="col-block popular__post">
                    <a href="#0" class="popular__thumb">
                        <img src="images/thumbs/small/tulips-150.jpg" alt="">
                    </a>
                    <h5><a href="#0">10 Interesting Facts About Caffeine.</a></h5>
                    <section class="popular__meta">
                        <span class="popular__author"><span>By</span> <a href="#0"> John Doe</a></span>
                        <span class="popular__date"><span>on</span> <time datetime="2017-12-14">Dec 14, 2017</time></span>
                    </section>
                </article>
                <article class="col-block popular__post">
                    <a href="#0" class="popular__thumb">
                        <img src="images/thumbs/small/salad-150.jpg" alt="">
                    </a>
                    <h5><a href="#0">Healthy Mediterranean Salad Recipes</a></h5>
                    <section class="popular__meta">
                        <span class="popular__author"><span>By</span> <a href="#0"> John Doe</a></span>
                        <span class="popular__date"><span>on</span> <time datetime="2017-12-12">Dec 12, 2017</time></span>
                    </section>
                </article>
            </div> <!-- end popular_posts -->
        </div> <!-- end popular --> */ ?>

        <!-- <div class="col-four md-six tab-full about"> Old if you include popular posts -->
        <div class="col-full text-center">
            <h3>About <?php $page_title ?></h3>

            <p>
                Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat. Pellentesque in ipsum id orci porta dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada.
            </p>

            <ul class="about__social">
                <li>
                    <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                </li>
            </ul> <!-- end header__social -->
        </div> <!-- end about -->

    </div> <!-- end row -->

    <div class="row bottom tags-wrap">
        <div class="col-full tags">
            <h3>Tags</h3>

            <div class="tagcloud">
                <?php

                $query = "SELECT * FROM tags";
                $select_all_posts_query = mysqli_query($connection, $query);

                $row = mysqli_fetch_assoc($select_all_posts_query);
                $post_tags = $row['tag_title'];
                ?>
                <a href="#0"><?php echo $post_tags ?></a>

            </div> <!-- end tagcloud -->
        </div> <!-- end tags -->
    </div> <!-- end tags-wrap -->

</section> <!-- end s-extra -->

<?php include('includes/footer.php'); ?>