<?php
require_once('../../config/connect.php');
session_start();

$login = $_POST['login'];
$password = md5($_POST['password']);




$result = mysqli_query($connect, "SELECT full_name,login, password, role FROM employee where login = '$login'");
$result = mysqli_fetch_assoc($result);

$_SESSION['employee'] = [
    'login' => $result['login'],
    'full_name' => $result['full_name'],
    'role' => $result['role']
];

if($login == $result['login'] and $password == $result['password']){
    if (isset($_POST['rememberme']) and $_POST['rememberme'] == 'on') {
        setcookie('login', $result['login'], time() + 60*60*24*30, '/');
        setcookie('role', $result['role'], time() + 60*60*24*30, '/');
        setcookie('name', $result['full_name'], time() + 60*60*24*30, '/');

    }
        setcookie('login', $result['login'], time() + 86000, '/');
        setcookie('role', $result['role'], time() + 86000, '/');
    setcookie('name', $result['full_name'], time() + 86000, '/');

}

    if($result['role'] == 'admin'){
        header('Location: ../index.php');
    }
    elseif($result['role'] == 'manager'){
        header('Location: ../orders.php');
}else {
    header('Location: ../login.php');
    $_SESSION['faillogin'] = 'Невірний логін або пароль';
}





