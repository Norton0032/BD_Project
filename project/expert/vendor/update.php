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
$id = $_POST['id_expert'];
$name = $_POST['first_name'];
$surname = $_POST['last_name'];
$patronymic = $_POST['patronymic'];
$phone = $_POST['phone'];
$email = $_POST['email'];
mysqli_query($conn, "UPDATE expert SET first_name='$name', last_name='$surname', patronymic='$patronymic', phone='$phone', email='$email' WHERE id_expert='$id'");
mysqli_close($conn);
header('Location: ../index.php');
