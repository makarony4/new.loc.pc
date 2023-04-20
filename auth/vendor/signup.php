<?php
session_start();
require_once ('../../config/connect.php');
$full_name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$check = mysqli_query($connect, "SELECT email, login FROM users");
$check = mysqli_fetch_all($check);



//якщо паролі співпадають , загружаю фото в потрібну папку
if($password === $confirm_password){
    if(!$path = 'uploads/' . time() . $_FILES['avatar']['name']) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path);

    }
    //хешую пасс
    $password = md5($password);

    foreach ($check as $item) {
        if($_POST['login'] ==  $item[1]){
            $_SESSION['duplicate'] = 'Користувач з такимм логіном вже існує';
            header('Location: ../register.php');
        }
        if ($_POST['email'] == $item[0]){
            $_SESSION['duplicate'] = 'Користувач з такою електронною поштою вже існує';
            header('Location: ../register.php');
        }
    }

    if(!isset($_SESSION['duplicate'])){
        $_SESSION['success'] = 'Реєстрація пройшла успішно';
        $sql = "INSERT INTO users (full_name, login, email, password,avatar) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $full_name, $login, $email, $password, $path);
        mysqli_stmt_execute($stmt);
        header('Location: ../index.php');

    }

    mysqli_close($connect);


}//повідомлення при неспівпаданні паролів
else{
    $_SESSION['message'] = 'Паролі не співпадають';
    header('Location: ../index.php');
}



?>
