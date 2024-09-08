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
$id = $_POST['id_job_application'];
$resume = $_POST['resume'];
$id_candidate_course = $_POST['id_candidate_course'];
mysqli_query($conn, "UPDATE job_application SET resume='$resume', id_candidate_course='$id_candidate_course' WHERE id_job_application='$id'");
mysqli_close($conn);
header('Location: ../index.php');
