<!-- pageheader
================================================== -->
<div class="s-pageheader">

    <header class="header">
        <div class="header__content row">

            <div class="header__logo">
                <a class="logo" href="index.html">
                    <img src="images/logo.svg" alt="Homepage">
                </a>
            </div> <!-- end header__logo -->

            <ul class="header__social">
                <li>
                    <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <!--<li>
                    <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </li>-->
                <li>
                    <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
                <!--<li>
                    <a href="#0"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                </li>-->
            </ul> <!-- end header__social -->

            <a class="header__search-trigger" href="#0"></a>

            <div class="header__search">

                <form role="search" method="get" class="header__search-form" action="#">
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
                    <li><a href="/" title="">Home</a></li>
                    <li class="has-children">
                        <a href="#0" title="">Categories</a>
                        <ul class="sub-menu">
                            <?php
                            $query = "SELECT * FROM categories LIMIT 3";
                            $select_all_categories_query = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                                $cat_title = $row['cat_title'];
                                $cat_id = $row['cat_id'];

                                echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="has-children current">
                        <a href="#0" title="">Authors</a>
                        <ul class="sub-menu">
                            <li><a>Coming Soon</a></li>
                        </ul>
                    </li>
                    <li><a href="style-guide.html" title="">Styles</a></li>
                    <li><a href="/about" title="">About</a></li>
                    <li><a href="/contact" title="">Contact</a></li>
                    <?php if (isLoggedIn()) : ?>
                        <li><a href="/admin">Admin</a></li>
                        <li><a href="/includes/logout.php">Logout</a></li>
                    <?php else : ?>
                        <li><a href="/login.php">Login</a></li>
                    <?php endif; ?>
                </ul> <!-- end header__nav -->

                <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

            </nav> <!-- end header__nav-wrap -->

        </div> <!-- header-content -->
    </header> <!-- header -->

</div> <!-- end s-pageheader -->