<?php include "includes/admin_header.php"; ?>
<div id="wrapper">



    <!-- Navigation -->

    <?php include "includes/admin_navigation.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">


                    <h1 class="page-header">
                        Welcome to admin


                        <small> <?php

                                if (isset($_SESSION['username'])) {

                                    echo $_SESSION['username'];
                                }


                                // if(is_admin($_SESSION['username'])){

                                //     echo " -- is admin too";

                                // } else {

                                //     echo " ---is not";

                                // }





                                ?></small>
                    </h1>



                </div>
            </div>

            <!-- /.row -->


            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <div class='huge'><?php echo $post_count = querySelect('posts'); ?> </div> <!-- searches posts table -->

                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <div class='huge'><?php echo $comment_count = querySelect('comments'); ?> </div>

                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <div class='huge'><?php echo $user_count = querySelect('users') ?></div>

                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <div class='huge'><?php echo $category_count = querySelect('categories'); ?> </div>

                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->


            <?php

            $post_published_count = querySelectWherePostPublished('posts', 'post_status', 'published');

            $post_draft_count = querySelectWherePostDraft('posts', 'post_status', 'draft');

            //$unapproved_comment_count = querySelectWhere('comments', 'comment_status', 'unapproved');

            // $subscriber_count = querySelectWhere('users', 'user_role', 'subscriber');



            //$query = "SELECT * FROM posts WHERE post_status = 'draft' ";
            //$select_all_draft_posts = mysqli_query($connection, $query);
            //$post_draft_count = mysqli_num_rows($select_all_draft_posts);


            $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
            $unapproved_comments_query = mysqli_query($connection, $query);
            $unapproved_comment_count = mysqli_num_rows($unapproved_comments_query);


            $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
            $select_all_subscribers = mysqli_query($connection, $query);
            $subscriber_count = mysqli_num_rows($select_all_subscribers);

            ?>






            <div class="row">

                <script type="text/javascript">
                    google.load("visualization", "1.1", {
                        packages: ["bar"]
                    });
                    google.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],

                            <?php

                            $element_text = ['All Posts', 'Published Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                            $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $unapproved_comment_count, $user_count, $subscriber_count, $category_count];


                            for ($i = 0; $i < 8; $i++) {

                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            }

                            ?>


                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, options);
                    }
                </script>


                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>





            </div>



        </div>
        <!-- /.container-fluid -->

    </div>


    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>



    <script>
        $(document).ready(function() {


            var pusher = new Pusher('a202fba63a209863ab62', {

                cluster: 'us2',
                encrypted: true
            });


            var notificationChannel = pusher.subscribe('notifications');


            notificationChannel.bind('new_user', function(notification) {

                var message = notification.message;

                toastr.success(`${message} just registered`);

            });



        });
    </script>