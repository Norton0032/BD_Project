<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../../login.php');
    exit();
}
elseif ($_SESSION['user']['role'] === 'user'){
    header('Location: ../index.php');
    exit();
}
include_once '../../connect_bd.php';
$name = $_POST['first_name'];
$surname = $_POST['last_name'];
$patronymic = $_POST['patronymic'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];
$check_user = mysqli_query($conn, "SELECT * FROM `creator_course` WHERE `login` = '$login'");
$check_admin = mysqli_query($conn, "SELECT * FROM `candidate_course` WHERE `login` = '$login'");
if (mysqli_num_rows($check_user) === 0 and mysqli_num_rows($check_admin) === 0 and $login!=="" and $password!=="") {
    mysqli_query($conn, "INSERT INTO candidate_course (first_name, last_name, patronymic, phone, email, login, password) VALUES ('$name', '$surname', '$patronymic', '$phone', '$email', '$login', '$password')");
}
else{
    $_SESSION['message'] = 'Логин должен быть уникальным';
    header('Location: ../index.php');
}
mysqli_close($conn);
header('Location: ../index.php');