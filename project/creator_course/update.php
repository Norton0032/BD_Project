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
$humen = mysqli_query($conn, "SELECT * FROM creator_course WHERE id_creator_course='$id'");
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
        .msg{
            font-size: medium;
            color: crimson;
        }
    </style>
</head>
<body>
<form action="vendor/update.php" method="post">
        <h2>Обновить информацию о создателе курса</h2>
        <input type="hidden" name="id_creator_course" value="<?php echo $id?>">
        <input type="text" id="first_name" name="first_name" placeholder="Ввод имени" value="<?php echo $row['first_name']?>">
        <input type="text" id="last_name" name="last_name" placeholder="Ввод фамилии" value="<?php echo $row['last_name']?>">
        <input type="text" id="patronymic" name="patronymic" placeholder="Ввод отчества" value="<?php echo $row['patronymic']?>">
        <input type="text" id="phone" name="phone" placeholder="Ввод телефона" value="<?php echo $row['phone']?>">
        <input type="text" id="email" name="email" placeholder="Ввод почты" value="<?php echo $row['email']?>">
        <input type="text" id="login" name="login" placeholder="Ввод логина" value="<?php echo $row['login']?>">
    <?php
    if (isset($_SESSION['message'])) {
        if ($_SESSION['message'] === 'Логин должен быть уникальным') {
            echo "<div class='msg'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
    }
    ?>
        <input type="text" id="password" name="password" placeholder="Ввод пароля" value="<?php echo $row['password']?>">
        <input type="submit" value="Сохранить">
    </form>
</body>
</html>