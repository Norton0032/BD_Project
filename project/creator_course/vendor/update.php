<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../../login.php');
    exit();
}
elseif ($_SESSION['user']['role'] === 'user'){
    header('Location: ../../index.php');
    exit();
}
include_once '../../connect_bd.php';
$id = $_POST['id_creator_course'];
$name = $_POST['first_name'];
$surname = $_POST['last_name'];
$patronymic = $_POST['patronymic'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];
$check_admin = mysqli_query($conn, "SELECT * FROM `creator_course` WHERE `login` = '$login'");
$check_user = mysqli_query($conn, "SELECT * FROM `candidate_course` WHERE `login` = '$login'");
$row = mysqli_fetch_array($check_admin);
$flag = True;
if (isset($row)){
    if ($row['id_creator_course'] !== $id){
        $flag = false;
    }
}
if (mysqli_num_rows($check_user) === 0 and $flag and $login!=="" and $password!=="") {
    mysqli_query($conn, "UPDATE creator_course SET first_name='$name', last_name='$surname', patronymic='$patronymic', phone='$phone', email='$email', login='$login', password='$password' WHERE id_creator_course='$id'");
    header('Location: ../index.php');
} else {
    $_SESSION['message'] = 'Логин должен быть уникальным';
    header('Location: ../update.php?id=' . $id);
}
mysqli_close($conn);