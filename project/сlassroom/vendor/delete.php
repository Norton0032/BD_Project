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
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM classroom WHERE id_classroom = $id");
mysqli_close($conn);
header('Location: ../index.php');