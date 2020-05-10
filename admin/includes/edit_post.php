<?php

if (isset($_GET['p_id'])) {

    $the_post_id =  escape($_GET['p_id']);
}


$query = "SELECT * FROM posts WHERE post_id = $the_post_id  ";
$select_posts_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id            = $row['post_id'];
    $post_user          = $row['post_user'];
    $post_title         = $row['post_title'];
    $post_category_id   = $row['post_category_id'];
    $post_status        = $row['post_status'];
    $post_image         = $row['post_image'];
    $post_content       = $row['post_content'];
    $post_tags          = $row['post_tags_id'];
    $post_comment_count = $row['post_comment_count'];
    $post_date          = $row['post_date'];
    $posts_featured      = $row['posts_featured'];
}


if (isset($_POST['update_post'])) {


    $post_user           =  escape($_POST['post_user']);
    $post_title          =  escape($_POST['post_title']);
    $post_category_id    =  escape($_POST['post_category']);
    $post_status         =  escape($_POST['post_status']);
    $post_image          =  $_FILES['image']['name'];
    $post_image_temp     =  $_FILES['image']['tmp_name'];
    $post_content        =  escape($_POST['post_content']);
    $post_tags           =  escape($_POST['post_tags']);
    $posts_featured       =  $_POST['posts_featured'];

    move_uploaded_file($post_image_temp, "../images/{$post_image}");

    //$post_image = imageUpload($post_image_temp);

    if (empty($post_image)) {

        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)) {

            $post_image = $row['post_image'];
        }
    }
    $post_title = mysqli_real_escape_string($connection, $post_title);


    $query = "UPDATE posts SET ";
    $query .= "post_title  = '{$post_title}', ";
    $query .= "posts_featured = '{$posts_featured}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date   =  now(), ";
    $query .= "post_user = '{$post_user}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags_id   = '{$post_tags}', ";
    $query .= "post_content= '{$post_content}', ";
    $query .= "post_image  = '{$post_image}' ";
    $query .= "WHERE post_id = {$the_post_id} ";

    $update_post = mysqli_query($connection, $query);

    confirmQuery($update_post);

    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";
}



?>






<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo htmlspecialchars(stripslashes($post_title)); ?>" type="text" class="form-control" name="post_title">
    </div>
    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') { ?>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="posts_featured" value="main">
        <label class="form-check-label" for="featured">
            Main
        </label>
        <input class="form-check-input" type="radio" name="posts_featured" value="featured">
        <label class="form-check-label" for="featured">
            Featured
        </label>
    </div>
     <?php }?>
    <div class="form-group">
        <label for="categories">Categories</label>
        <select name="post_category" id="">

            <?php

            $query = "SELECT * FROM categories ";
            $select_categories = mysqli_query($connection, $query);

            confirmQuery($select_categories);


            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];


                if ($cat_id == $post_category_id) {


                    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                } else {

                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            }

            ?>


        </select>

    </div>

    <div class="form-group">
        <label for="users">Users</label>
        <select name="post_user" id="">


            <?php echo "<option value='{$post_user}'>{$post_user}</option>"; ?>

            <?php

            $users_query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $users_query);

            confirmQuery($select_users);


            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];


                echo "<option value='{$username}'>{$username}</option>";
            }

            ?>


        </select>

    </div>

    <div class="form-group">
        <select name="post_status" id="">

            <option value='<?php echo $post_status ?>'><?php echo $post_status; ?></option>

            <?php

            if ($post_status == 'published') {


                echo "<option value='draft'>Draft</option>";
            } else {


                echo "<option value='published'>Publish</option>";
            }



            ?>


        </select>
    </div>






    <div class="form-group">

        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="1" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $post_content; ?></textarea>


    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>


</form>