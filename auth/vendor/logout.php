<?php
session_start();
unset($_SESSION['user']);
setcookie('login_user', '', time() - 3600, '/');
setcookie('email', '', time() - 3600, '/');
setcookie('password', '', time() - 3600, '/');

header('Location: ../index.php');