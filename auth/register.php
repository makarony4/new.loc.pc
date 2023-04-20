<?php
require_once('../config/connect.php');
session_start();
if(isset($_SESSION['user'])){
    header('Location: profile.php');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authorization and registration</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>


    <form action="vendor/signup.php" method="post" enctype="multipart/form-data">
        <label>Full Name</label>
        <input type="text" name="full_name" placeholder="Press your name" required>
        <label>Login</label>
        <input type="text" name="login" placeholder="Press your login" required>
        <label>Email</label>
        <input type="email" name="email" placeholder="Press your email" required>
        <label>Your avatar</label>
        <input type="file" name="avatar">
        <label>Password</label>
        <input type="password" name="password" placeholder="Press your password" required>
        <label>COnfirm password</label>
        <input type="password" name="confirm_password" placeholder="Confirm your password" required>
        <button type="submit">Register</button>
        <p>
           Already have account? - <a href="index.php">authorization</a>!
        </p>
        <?php //
        if (isset($_SESSION['message']))
        {
            echo '<p class="msg">'. $_SESSION['message'] . '</p>';
        }
        unset($_SESSION['message']);

        if (isset($_SESSION['duplicate']))
        {
            echo '<p class="msg">'. $_SESSION['duplicate'] . '</p>';
        }
        unset($_SESSION['duplicate']);

 ?>
    </form>


</body>
</html>