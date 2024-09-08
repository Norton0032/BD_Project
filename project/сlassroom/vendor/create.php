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
$address = $_POST['address'];
$id_creator_course = $_POST['id_creator_course'];
$id_renter = $_POST['id_renter'];
mysqli_query($conn, "INSERT INTO classroom (address, id_creator_course, id_renter) VALUES ('$address', '$id_creator_course', '$id_renter')");
mysqli_close($conn);
header('Location: ../index.php');