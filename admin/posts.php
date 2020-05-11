<?php include "includes/admin_header.php" ?>

<div id="wrapper">



    <!-- Navigation -->

    <?php include "includes/admin_navigation.php" ?>

    <?php

    if (isset($_GET['source'])) {

        $source = $_GET['source'];
    } else {

        $source = '';
    }

    switch ($source) {

        case 'add_post';

            include "includes/add_post.php";

            break;


        case 'edit_post';

            include "includes/edit_post.php";
            break;

        case '200';
            echo "NICE 200";
            break;

        default:

            include "includes/view_all_posts.php";

            break;
    }
    ?>

</div>
</div>
<!-- /.row -->

</div><!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>