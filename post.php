<?php

include('includes/head.php');
include('includes/header.php');

if (isset($_GET['p_id'])) {

    $the_post_id = $_GET['p_id'];



    $update_statement = mysqli_prepare($connection, "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = ?");

    mysqli_stmt_bind_param($update_statement, "i", $the_post_id);

    mysqli_stmt_execute($update_statement);

    // mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);



    if (!$update_statement) {

        die("query failed");
    }


    if (isset($_SESSION['username']) && is_admin($_SESSION['username'])) {


        $stmt1 = mysqli_prepare($connection, "SELECT post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_id = ?");
    } else {
        $stmt2 = mysqli_prepare($connection, "SELECT post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_id = ? AND post_status = ? ");

        $published = 'published';
    }



    if (isset($stmt1)) {

        mysqli_stmt_bind_param($stmt1, "i", $the_post_id);

        mysqli_stmt_execute($stmt1);

        mysqli_stmt_bind_result($stmt1, $post_title, $post_author, $post_date, $post_image, $post_content);

        $stmt = $stmt1;
    } else {


        mysqli_stmt_bind_param($stmt2, "is", $the_post_id, $published);

        mysqli_stmt_execute($stmt2);

        mysqli_stmt_bind_result($stmt2, $post_title, $post_author, $post_date, $post_image, $post_content);

        $stmt = $stmt2;
    }
    while (mysqli_stmt_fetch($stmt)) {
?>
        <!-- s-content
    ================================================== -->
        <section class="s-content s-content--narrow s-content--no-padding-bottom">

            <article class="row format-standard">

                <div class="s-content__header col-full">
                    <h1 class="s-content__header-title">
                        <?php echo $post_title ?>
                    </h1>
                    <ul class="s-content__header-meta">
                        <li class="date"><?php echo $post_date ?></li>
                        <li class="cat">
                            In
                            <a href="#0">Lifestyle</a>
                            <a href="#0">Travel</a>
                        </li>
                    </ul>
                </div> <!-- end s-content__header -->

                <div class="s-content__media col-full">
                    <div class="s-content__post-thumb">
                        <img src="images/<?php echo $post_image ?>" srcset="images/<?php echo $post_image ?> 2000w, 
                         images/<?php echo $post_image ?> 1000w, 
                         images/<?php echo $post_image ?> 500w" sizes="(max-width: 2000px) 100vw, 2000px" alt="">
                    </div>
                </div> <!-- end s-content__media -->

                <div class="col-full s-content__main">
                    <p><?php echo $post_content ?></p>

                    <p class="s-content__tags">
                        <span>Post Tags</span>

                        <span class="s-content__tag-list">
                            <?php

                            $query = "SELECT * FROM tags WHERE tag_id = '$post_id' ";
                            $select_all_posts_query = mysqli_query($connection, $query);

                            $row = mysqli_fetch_assoc($select_all_posts_query);
                            $post_tags = $row['tag_title'];

                            echo "<a href='#0'><?php echo $post_tags ?></a>"
                            ?>
                        </span>
                    </p> <!-- end s-content__tags -->

                    <div class="s-content__author">
                        <img src="images/avatars/user-03.jpg" alt="">

                        <div class="s-content__author-about">
                            <h4 class="s-content__author-name">
                                <a href="#0"><?php echo $post_author ?></a>
                            </h4>

                            <p>
                                About the author Coming Soon!
                            </p>

                            <ul class="s-content__author-social">
                                <li><a href="#0">Facebook</a></li>
                                <li><a href="#0">Twitter</a></li>
                                <li><a href="#0">GooglePlus</a></li>
                                <li><a href="#0">Instagram</a></li>
                            </ul>
                        </div>
                    </div>

                    <!--<div class="s-content__pagenav">
                        <div class="s-content__nav">
                            <div class="s-content__prev">
                                <a href="#0" rel="prev">
                                    <span>Previous Post</span>
                                    Tips on Minimalist Design
                                </a>
                            </div>
                            <div class="s-content__next">
                                <a href="#0" rel="next">
                                    <span>Next Post</span>
                                    Less Is More
                                </a>
                            </div>
                        </div>
                    </div> <!-- end s-content__pagenav -->

                </div> <!-- end s-content__main -->

            </article>
        <?php } ?>

        <!-- comments
        ================================================== -->

        <div class="comments-wrap">

            <div id="comments" class="row">
                <div class="col-full">

                    <h3 class="h2"><?php

                                    $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                                    $query .= "AND comment_status = 'approved' ";
                                    $comment_count = mysqli_query($connection, $query);
                                    $comment_count = mysqli_num_rows($comment_count);

                                    echo $comment_count; ?> Comments</h3>

                    <!-- commentlist -->
                    <ol class="commentlist">
                        <?php


                        $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                        $query .= "AND comment_status = 'approved' ";
                        $query .= "ORDER BY comment_id DESC ";
                        $select_comment_query = mysqli_query($connection, $query);
                        if (!$select_comment_query) {

                            die('Query Failed' . mysqli_error($connection));
                        }
                        while ($row = mysqli_fetch_array($select_comment_query)) {
                            $comment_date   = $row['comment_date'];
                            $comment_content = $row['comment_content'];
                            $comment_author = $row['comment_author'];

                        ?>

                            <li class="depth-1 comment">

                                <div class="comment__avatar">
                                    <img width="50" height="50" class="avatar" src="images/avatars/user-01.jpg" alt="">
                                </div>

                                <div class="comment__content">

                                    <div class="comment__info">
                                        <cite><?php echo $comment_author ?></cite>

                                        <div class="comment__meta">
                                            <time class="comment__time">Dec 16, 2017 @ 23:05</time>
                                            <a class="reply" href="#0">Reply</a>
                                        </div>
                                    </div>

                                    <div class="comment__text">
                                        <p><?php echo $comment_content ?></p>
                                    </div>

                                </div>

                            </li> <!-- end comment level 1 -->

                            <!--<li class="thread-alt depth-1 comment">

                                <div class="comment__avatar">
                                    <img width="50" height="50" class="avatar" src="images/avatars/user-04.jpg" alt="">
                                </div>

                                <div class="comment__content">

                                <div class="comment__info">
                                <cite>John Doe</cite>

                                <div class="comment__meta">
                                    <time class="comment__time">Dec 16, 2017 @ 24:05</time>
                                    <a class="reply" href="#0">Reply</a>
                                </div>
                                </div>

                                <div class="comment__text">
                                <p>Sumo euismod dissentiunt ne sit, ad eos iudico qualisque adversarium, tota falli et mei. Esse euismod
                                urbanitas ut sed, et duo scaevola pericula splendide. Primis veritus contentiones nec ad, nec et
                                tantas semper delicatissimi.</p>
                                </div>

                            </div>

                            <ul class="children">

                                <li class="depth-2 comment">

                                    <div class="comment__avatar">
                                        <img width="50" height="50" class="avatar" src="images/avatars/user-03.jpg" alt="">
                                    </div>

                                    <div class="comment__content">

                                        <div class="comment__info">
                                            <cite>Kakashi Hatake</cite>

                                            <div class="comment__meta">
                                                <time class="comment__time">Dec 16, 2017 @ 25:05</time>
                                                <a class="reply" href="#0">Reply</a>
                                            </div>
                                        </div>

                                        <div class="comment__text">
                                            <p>Duis sed odio sit amet nibh vulputate
                                            cursus a sit amet mauris. Morbi accumsan ipsum velit. Duis sed odio sit amet nibh vulputate
                                            cursus a sit amet mauris</p>
                                        </div>

                                    </div>

                                    <ul class="children">

                                        <li class="depth-3 comment">

                                            <div class="comment__avatar">
                                                <img width="50" height="50" class="avatar" src="images/avatars/user-04.jpg" alt="">
                                            </div>

                                            <div class="comment__content">

                                                <div class="comment__info">
                                                <cite>John Doe</cite>

                                                <div class="comment__meta">
                                                    <time class="comment__time">Dec 16, 2017 @ 25:15</time>
                                                    <a class="reply" href="#0">Reply</a>
                                                </div>
                                                </div>

                                                <div class="comment__text">
                                                <p>Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est
                                                etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.</p>
                                                </div>

                                            </div>

                                        </li>

                                    </ul>

                                </li>

                            </ul>

                        </li> -->
                            <!-- end comment level 1 -->
                        <?php } ?>
                    </ol> <!-- end commentlist -->




                    <!-- respond
                    ================================================== -->
                    <?php

                    if (isset($_POST['create_comment'])) {

                        $the_post_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {


                            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status,comment_date)";

                            $query .= "VALUES ($the_post_id ,'{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved',now())";

                            $create_comment_query = mysqli_query($connection, $query);

                            if (!$create_comment_query) {
                                die('QUERY FAILED' . mysqli_error($connection));
                            }
                        }
                    }
                    ?>
                    <div class="respond">

                        <h3 class="h2">Add Comment</h3>

                        <form id="contactForm" method="post" action="#" role="form">
                            <fieldset>

                                <div class="form-field">
                                    <input name="comment_author" type="text" id="cName" class="full-width" placeholder="Your Name" value="">
                                </div>

                                <div class="form-field">
                                    <input name="comment_email" type="text" id="cEmail" class="full-width" placeholder="Your Email" value="">
                                </div>

                                <div class="form-field">
                                    <input name="cWebsite" type="text" id="cWebsite" class="full-width" placeholder="Website" value="">
                                </div>

                                <div class="message form-field">
                                    <textarea name="comment_content" id="cMessage" class="full-width" placeholder="Your Message"></textarea>
                                </div>

                                <button type="submit" name="create_comment" class="submit btn--primary btn--large full-width">Submit</button>

                            </fieldset>
                        </form> <!-- end form -->

                    </div> <!-- end respond -->

                </div> <!-- end col-full -->

            </div> <!-- end row comments -->
        </div> <!-- end comments-wrap -->

        </section> <!-- s-content -->
    <?php } else {

    header("Location: index.php");
} ?>
    <?php include('includes/footer.php'); ?>