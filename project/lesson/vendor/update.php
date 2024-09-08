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
$id = $_POST['id_lesson'];
$lesson_name = $_POST['lesson_name'];
$lesson_place = $_POST['lesson_place'];
$data = $_POST['data'];
$time = $_POST['time'];
$lesson_time = $data." ".$time;
$id_creator_course = $_POST['id_creator_course'];
mysqli_query($conn, "UPDATE lesson SET lesson_name='$lesson_name', lesson_place='$lesson_place', lesson_time='$lesson_time', id_creator_course='$id_creator_course' WHERE id_lesson='$id'");
mysqli_close($conn);
header('Location: ../index.php');
