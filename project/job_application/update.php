<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}
elseif ($_SESSION['user']['role'] === 'user'){
    header('Location: ../index.php');
    exit();
}
include_once '../connect_bd.php';
$id = $_GET['id'];
$humen = mysqli_query($conn, "SELECT * FROM job_application WHERE id_job_application='$id'");
$row = mysqli_fetch_assoc($humen);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        a {
            text-decoration: none;
        }
        form {
            width: 80%;
            margin: 20px auto;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<form action="vendor/update.php" method="post">
        <h2>Обновить информацию о заявке на работу</h2>
        <input type="hidden" name="id_job_application" value="<?php echo $id?>">
        <textarea id="resume" name="resume" placeholder="Ввод резюме"><?php echo $row['resume']?></textarea>
        <input type="text" id="id_candidate_course" name="id_candidate_course" placeholder="Ввод id кандидата на работу" value="<?php echo $row['id_candidate_course']?>">
        <input type="submit" value="Сохранить">
    </form>
</body>
</html>