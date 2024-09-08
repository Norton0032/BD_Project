<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}
elseif ($_SESSION['user']['role'] === 'user'){
    header('Location: index.php');
    exit();
}
include_once '../connect_bd.php';
$id = $_GET['id'];
$humen = mysqli_query($conn, "SELECT * FROM lesson WHERE id_lesson='$id'");
$row = mysqli_fetch_assoc($humen);
$pieces = explode(" ", $row['lesson_time']);
$data = $pieces[0];
$time = $pieces[1];
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
        <h2>Обновить информацию об уроке</h2>
        <input type="hidden" name="id_lesson" value="<?php echo $id?>">
        <input type="text" id="lesson_name" name="lesson_name" placeholder="Ввод названия урока" value="<?php echo $row['lesson_name']?>">
        <input type="text" id="lesson_place" name="lesson_place" placeholder="Ввод места урока" value="<?php echo $row['lesson_place']?>">
        <label for="bday">Ввод даты урока:</label>
    <input type="date" id="bday" name="data" value="<?php echo $data?>" />
    <label for="time">Ввод времени урока: </label>
  <input id="time" type="time" name="time" step="2" value="<?php echo $time?>"/>
        <input type="text" id="id_creator_course" name="id_creator_course" placeholder="Ввод id создателя курса" value="<?php echo $row['id_creator_course']?>">
        <input type="submit" value="Сохранить">
    </form>
</body>
</html>