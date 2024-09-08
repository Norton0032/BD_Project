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
$id = $_POST['id_candidate_course'];
$name = $_POST['first_name'];
$surname = $_POST['last_name'];
$patronymic = $_POST['patronymic'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];
$check_admin = mysqli_query($conn, "SELECT * FROM `creator_course` WHERE `login` = '$login'");
$check_user = mysqli_query($conn, "SELECT * FROM `candidate_course` WHERE `login` = '$login'");
$row = mysqli_fetch_array($check_user);
$flag = True;
if (isset($row)){
    if ($row['id_candidate_course'] !== $id){
        $flag = false;
    }
}
if ($flag and mysqli_num_rows($check_admin) === 0 and $login!=="" and $password!=="") {
    mysqli_query($conn, "UPDATE candidate_course SET first_name='$name', last_name='$surname', patronymic='$patronymic', phone='$phone', email='$email', login='$login', password='$password' WHERE id_candidate_course='$id'");
    header('Location: ../index.php');
} else {
    $_SESSION['message'] = 'Логин должен быть уникальным';
    header('Location: ../update.php?id=' . $id);
}
mysqli_close($conn);

