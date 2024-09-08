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
$resume = $_POST['resume'];
$id_candidate_course = $_POST['id_candidate_course'];
mysqli_query($conn, "INSERT INTO job_application (resume, id_candidate_course) VALUES ('$resume', '$id_candidate_course')");
mysqli_close($conn);
header('Location: ../index.php');