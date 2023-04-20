<?php
session_start();
unset($_SESSION['employee']);
setcookie('login','', time() -60*60*24*30, '/');
setcookie('role','', time() -60*60*24*30, '/');
setcookie('name','', time() -60*60*24*30, '/');
header('Location: ../login.php');