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
$name = $_POST['first_name'];
$surname = $_POST['last_name'];
$patronymic = $_POST['patronymic'];
$phone = $_POST['phone'];
$list_of_equipment = $_POST['list_of_equipment'];
mysqli_query($conn, "INSERT INTO provider (first_name, last_name, patronymic, phone, list_of_equipment) VALUES ('$name', '$surname', '$patronymic', '$phone', '$list_of_equipment')");
mysqli_close($conn);
header('Location: ../index.php');