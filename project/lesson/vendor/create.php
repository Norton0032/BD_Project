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
$lesson_name = $_POST['lesson_name'];
$lesson_place = $_POST['lesson_place'];
$data = $_POST['data'];
$time = $_POST['time'];
$lesson_time = $data." ".$time;
$id_creator_course = $_POST['id_creator_course'];
mysqli_query($conn, "INSERT INTO lesson (lesson_name, lesson_place, lesson_time, id_creator_course) VALUES ('$lesson_name', '$lesson_place', '$lesson_time','$id_creator_course')");
mysqli_close($conn);
header('Location: ../index.php');