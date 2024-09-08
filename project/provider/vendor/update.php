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
$id = $_POST['id_provider'];
$name = $_POST['first_name'];
$surname = $_POST['last_name'];
$patronymic = $_POST['patronymic'];
$phone = $_POST['phone'];
$list_of_equipment = $_POST['list_of_equipment'];
mysqli_query($conn, "UPDATE provider SET first_name='$name', last_name='$surname', patronymic='$patronymic', phone='$phone', list_of_equipment='$list_of_equipment' WHERE id_provider='$id'");
mysqli_close($conn);
header('Location: ../index.php');
