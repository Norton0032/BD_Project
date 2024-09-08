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
$id = $_POST['id_question'];
$text_of_question = $_POST['text_of_question'];
$id_creator_course = $_POST['id_creator_course'];
$id_expert = $_POST['id_expert'];
mysqli_query($conn, "UPDATE question SET text_of_question='$text_of_question', id_creator_course='$id_creator_course', id_expert='$id_expert' WHERE id_question='$id'");
mysqli_close($conn);
header('Location: ../index.php');
