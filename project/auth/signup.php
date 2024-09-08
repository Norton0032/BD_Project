<?php
session_start();
require_once '../connect_bd.php';
$first_name = $_POST['first-name'];
$middle_name = $_POST['middle-name'];
$last_name = $_POST['last-name'];
$login = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$phone = $_POST['phone'];
$role = $_POST['role'];
$check_user = mysqli_query($conn, "SELECT * FROM `creator_course` WHERE `login` = '$login'");
$check_admin = mysqli_query($conn, "SELECT * FROM `candidate_course` WHERE `login` = '$login'");

if ($password === $password_confirm) {
    if (mysqli_num_rows($check_user) === 0 and mysqli_num_rows($check_admin) === 0) {
        if ($role === 'creator') {
            mysqli_query($conn, "INSERT INTO creator_course (first_name, last_name, patronymic, phone, email, login, password) VALUES ('$first_name', '$last_name', '$middle_name', '$phone', '$email', '$login', '$password')");

        } else {
            mysqli_query($conn, "INSERT INTO candidate_course (first_name, last_name, patronymic, phone, email, login, password) VALUES ('$first_name', '$last_name', '$middle_name', '$phone', '$email', '$login', '$password')");

        }

        header('Location: ../login.php');
    } else {
        $_SESSION['message'] = 'Логин должен быть уникальным';
        header('Location: ../register.php');
    }


} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../register.php');
}

