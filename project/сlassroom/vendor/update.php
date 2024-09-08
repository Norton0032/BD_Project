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
$id = $_POST['id_classroom'];
$address = $_POST['address'];
$id_creator_course = $_POST['id_creator_course'];
$id_renter = $_POST['id_renter'];
mysqli_query($conn, "UPDATE classroom SET address='$address', id_creator_course='$id_creator_course', id_renter='$id_renter' WHERE id_classroom='$id'");
mysqli_close($conn);
header('Location: ../index.php');
