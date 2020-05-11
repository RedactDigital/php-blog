<!-- pageheader
    ================================================== -->
<section class="s-pageheader s-pageheader--home">

    <header class="header">
        <div class="header__content row">

            <div class="header__logo">
                <a class="logo" href="index.html">
                    <img src="images/logo.png" alt="Homepage">
                </a>
            </div> <!-- end header__logo -->

            <ul class="header__social">
                <li>
                    <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <!--<li>
                    <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </li> -->
                <li>
                    <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
                <!-- <li>
                    <a href="#0"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                </li> -->
            </ul> <!-- end header__social -->

            <a class="header__search-trigger" href="#0"></a>

            <div class="header__search">

                <form role="search" method="post" class="header__search-form" action="search.php">
                    <label>
                        <span class="hide-content">Search for:</span>
                        <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" autocomplete="off">
                    </label>
                    <input type="submit" class="search-submit" value="Search">
                </form>

                <a href="#0" title="Close Search" class="header__overlay-close">Close</a>

            </div> <!-- end header__search -->


            <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

            <nav class="header__nav-wrap">

                <h2 class="header__nav-heading h6">Site Navigation</h2>

                <ul class="header__nav">
                    <li class="current"><a href="/" title="">Home</a></li>
                    <li class="has-children">
                        <a href="#0" title="">Categories</a>
                        <ul class="sub-menu">
                            <?php
                            $query = "SELECT * FROM categories";
                            $select_all_categories_query = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                                $cat_title = $row['cat_title'];
                                $cat_id = $row['cat_id'];

                                echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="#0" title="">Authors</a>
                        <ul class="sub-menu">
                            <?php

                            $query = "SELECT * FROM users";
                            $select_all_authors_query = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($select_all_authors_query)) {

                                $username = $row['username'];
                            ?>

                                <li><a href='author.php?author=<?php echo $username ?>'><?php echo $username ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="/about" title="">About</a></li>
                    <li><a href="/contact" title="">Contact</a></li>
                    <?php if (isLoggedIn()) : ?>


                        <li>
                            <a href="/admin">Admin</a>
                        </li>

                        <li>
                            <a href="/includes/logout.php">Logout</a>
                        </li>


                    <?php else : ?>


                        <li>
                            <a href="/login.php">Login</a>
                        </li>


                    <?php endif; ?>
                </ul> <!-- end header__nav -->

                <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

            </nav> <!-- end header__nav-wrap -->

        </div> <!-- header-content -->
    </header> <!-- header -->
    <div class="pageheader-content row">
        <div class="col-full">

            <div class="featured">

                <div class="featured__column featured__column--big">

                    <?php

                    $query = "SELECT * FROM posts WHERE posts_featured = 'main' ";
                    $select_all_main = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_all_main)) {
                        $post_title         = $row['post_title'];
                        $post_user          = $row['post_user'];
                        $post_image         = $row['post_image'];
                        $post_date          = $row['post_date'];
                        $post_category_id   = $row['post_category_id'];

                        $query = "SELECT * FROM categories WHERE cat_id = '$post_category_id' ";
                        $select_all_categories = mysqli_query($connection, $query);
                        $row = mysqli_fetch_assoc($select_all_categories);
                        $post_category  = $row['cat_title'];


                    ?>

                        <div class="entry" style="background-image:url('images/<?php echo $post_image ?>');">

                            <div class="entry__content">
                                <span class="entry__category"><a href="#0"><?php echo $post_category ?></a></span>

                                <h1><a href="#0" title=""><?php echo $post_title ?></a></h1>

                                <div class="entry__info">
                                    <a href="#0" class="entry__profile-pic">
                                        <img class="avatar" src="images/avatars/user-03.jpg" alt="">
                                    </a>

                                    <ul class="entry__meta">
                                        <li><a href="#0"><?php echo $post_user ?></a></li>
                                        <li><?php echo $post_date ?></li>
                                    </ul>
                                </div>
                            </div> <!-- end entry__content -->

                        </div> <!-- end entry -->
                    <?php } ?>
                </div> <!-- end featured__big -->


                <div class="featured__column featured__column--small">

                    <?php
                    $query = "SELECT * FROM posts WHERE posts_featured = 'featured' ";
                    $select_all_featured = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_all_featured)) {
                        $post_title         = $row['post_title'];
                        $post_user          = $row['post_user'];
                        $post_image         = $row['post_image'];
                        $post_date          = $row['post_date'];
                        $post_category_id   = $row['post_category_id'];

                        $query = "SELECT * FROM categories WHERE cat_id = '$post_category_id' ";
                        $select_all_categories = mysqli_query($connection, $query);
                        $row = mysqli_fetch_assoc($select_all_categories);
                        $post_category  = $row['cat_title'];
                    ?>

                        <div class="entry" style="background-image:url('images/<?php echo $post_image ?>');">

                            <div class="entry__content">
                                <span class="entry__category"><a href="#0"><?php echo $post_category ?></a></span>

                                <h1><a href="#0" title=""><?php echo $post_title ?></a></h1>

                                <div class="entry__info">
                                    <a href="#0" class="entry__profile-pic">
                                        <img class="avatar" src="images/avatars/user-03.jpg" alt="">
                                    </a>

                                    <ul class="entry__meta">
                                        <li><a href="#0"><?php echo $post_user ?></a></li>
                                        <li><?php echo $post_date ?></li>
                                    </ul>
                                </div>
                            </div> <!-- end entry__content -->

                        </div> <!-- end entry -->

                    <?php } ?>

                </div> <!-- end featured__small -->

            </div> <!-- end featured -->

        </div> <!-- end col-full -->
    </div> <!-- end pageheader-content row -->

</section> <!-- end s-pageheader section tag in header.php-->