<?php include "includes/admin_header.php" ?>
<?php

if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}' ";

    $select_user_profile_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_user_profile_query)) {

        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}
?>


<?php

if (isset($_POST['edit_user'])) {

    $user_firstname   = escape($_POST['user_firstname']);
    $user_lastname    = escape($_POST['user_lastname']);
    $user_role        = escape($_POST['user_role']);

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];


    $username      = escape($_POST['username']);
    $user_email    = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);

    if (empty($user_password)) {

        $query_password = "SELECT user_password FROM users WHERE user_id =  $user_id";
        $get_user_query = mysqli_query($connection, $query_password);
        confirmQuery($get_user_query);

        $row = mysqli_fetch_array($get_user_query);

        $user_password = $row['user_password'];
    } else {

        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

    }
        $query = "UPDATE users SET ";
        $query .= "user_firstname  = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role   =  '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password   = '{$user_password}' ";
        $query .= "WHERE user_id = '{$user_id}' ";

        $edit_user_query = mysqli_query($connection, $query);

        confirmQuery($edit_user_query);

        session_unset();

        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_query = mysqli_query($connection, $query);
        confirmQuery($select_user_query);


        while ($row = mysqli_fetch_array($select_user_query)) {

            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];

            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
        }
    }

?>

<div id="wrapper">

    <!-- Navigation -->

    <?php include "includes/admin_navigation.php" ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Firstname</label>
            <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
        </div>
        <div class="form-group">
            <label for="post_status">Lastname</label>
            <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
        </div>
        <div class="form-group">
            <select name="user_role" id="">
                <option value="subscriber"><?php echo $user_role; ?></option>
                <?php

                if ($user_role == 'admin') {

                    echo "<option value='subscriber'>subscriber</option>";
                }

                ?>

            </select>
        </div>

        <!--
      <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>
-->

        <div class="form-group">
            <label for="post_tags">Username</label>
            <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
        </div>

        <div class="form-group">
            <label for="post_content">Email</label>
            <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
        </div>

        <div class="form-group">
            <label for="post_content">Password</label>
            <input type="password" value="" class="form-control" name="user_password">
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
        </div>
    </form>

</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>

<!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>