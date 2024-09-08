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
$id = $_POST['id_equipment'];
$technical_specifications = $_POST['technical_specifications'];
$quantity = $_POST['quantity'];
$id_creator_course = $_POST['id_creator_course'];
$id_provider = $_POST['id_provider'];
mysqli_query($conn, "UPDATE equipment SET technical_specifications='$technical_specifications', id_creator_course='$id_creator_course', quantity='$quantity', id_provider='$id_provider' WHERE id_equipment='$id'");
mysqli_close($conn);
header('Location: ../index.php');
