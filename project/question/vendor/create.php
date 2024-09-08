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
$text_of_question = $_POST['text_of_question'];
$id_creator_course = $_POST['id_creator_course'];
$id_expert = $_POST['id_expert'];
mysqli_query($conn, "INSERT INTO question (text_of_question, id_creator_course, id_expert) VALUES ('$text_of_question', '$id_creator_course', '$id_expert')");
mysqli_close($conn);
header('Location: ../index.php');