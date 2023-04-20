<?php
session_start();
require_once ('../config/connect.php');
//переадресація якщо юзер залогінився
if(isset($_COOKIE['login_user'])){
    header('Location: profile.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authorization and registration</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <style>
        .redirect{
            margin-top:-300px;
            min-height:40px;
        }
    </style>
</head>
<body>
<header>
    <div class="redirect"><a href="../index.php">To Catalogue</a></div>
</header>
<a href="profile.php"></a>

    <form action="./vendor/signin.php" method="post">
        <label>Login</label>
        <input type="text" name="login" placeholder="Press your login">
        <label>Password</label>
        <input type="password" name="password" placeholder="Press your password">
        <label><input type="checkbox" name="rememberme">Stay Logged in</label>
        <button type="submit">Login</button>
        <p>
            Have not account? - <a href="register.php">Register</a>!
        </p>
         <?php
        if (isset($_SESSION['success']))
        {
            echo '<p class="msg">'. $_SESSION['success'] . '</p>';
        }
        unset($_SESSION['success']);

         if (isset($_SESSION['loginfail']))
         {
             echo '<p class="msg">'. $_SESSION['loginfail'] . '</p>';
         }
         unset($_SESSION['loginfail']);
        ?>

    </form>

</body>
</html>