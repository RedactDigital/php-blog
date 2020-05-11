<?php session_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "admin/functions.php"; ?>
<!DOCTYPE html >
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name=”robots” content="index, follow">
    <meta name="description" content="Millennial and GenZ blogs on topics that help other generations understand how invaluable we are to the future. ">
    <meta name="author" content="Patrick Rizzardi">

    <title>Understanding Millennials and GenZ | Millennial Blog Topics</title> 

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <link href="css/styles.css" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-165444854-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-165444854-1');
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-N9CV5B2');
    </script>
    <!-- End Google Tag Manager -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N9CV5B2" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
       <div class="container">


           <!-- Brand and toggle get grouped for better mobile display -->
           <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                   <span class="sr-only">Toggle navigation</span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="/">Millennial Topics</a>
           </div>


           <!-- Collect the nav links, forms, and other content for toggling -->
           <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav">

                   <li class="dropdown">
                       <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Categories <span class="caret"></span>
                       </a>
                       <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
               </ul>

               <ul class="nav navbar-nav navbar-right">

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





                   <li>
                       <a href="/registration">Registration</a>
                   </li>

                   <li><a href="/contact">Contact</a></li>




                   <?php

                    if (isset($_SESSION['user_role'])) {

                        if (isset($_GET['p_id'])) {

                            $the_post_id = $_GET['p_id'];

                            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                        }
                    }

                    ?>

                   <form action="search.php" method="post" class="navbar-form navbar-left">
                       <div class="form-group">
                           <input name="search" type="text" class="form-control" placeholder="Search">
                       </div>
                       <button name="submit" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                   </form>

               </ul>





           </div>
           <!-- /.navbar-collapse -->
       </div>
       <!-- /.container -->
   </nav>