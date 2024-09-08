<?php
    session_start();
    require_once '../connect_bd.php';

    $login = $_POST['username'];
    $password = $_POST['password'];

    $check_admin = mysqli_query($conn, "SELECT * FROM `creator_course` WHERE `login` = '$login' AND `password` = '$password'");
    $check_user = mysqli_query($conn, "SELECT * FROM `candidate_course` WHERE `login` = '$login' AND `password` = '$password'");
    if (mysqli_num_rows($check_user) > 0) {

        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user'] = [
            "id" => $user['id'],
            "first_name" => $user['first_name'],
            "middle_name" => $user['middle_name'],
            "last_name" => $user['last_name'],
            "login" => $user['login'],
            "phone" => $user['phone'],
            "role" => 'user',
            "email" => $user['email']
        ];

        header('Location: ../index.php');

    } elseif (mysqli_num_rows($check_admin) > 0){
        $user = mysqli_fetch_assoc($check_admin);
        $_SESSION['user'] = [
            "id" => $user['id'],
            "first_name" => $user['first_name'],
            "middle_name" => $user['middle_name'],
            "last_name" => $user['last_name'],
            "login" => $user['login'],
            "phone" => $user['phone'],
            "role" => 'admin',
            "email" => $user['email']
        ];

        header('Location: ../index.php');
    } else {
        $_SESSION['message'] = 'Неверный логин или пароль';
        header('Location: ../login.php');
    }

