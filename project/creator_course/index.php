<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
} elseif ($_SESSION['user']['role'] === 'user') {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создатель курса</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
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

        .msg {
            font-size: medium;
            color: crimson;
        }
    </style>
</head>
<body>
<h1>Создатель курса</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Отчество</th>
        <th>Телефон</th>
        <th>Почта</th>
        <th>Логин</th>
        <th>Пароль</th>
        <th>Просмотр</th>
        <th>Обновить</th>
        <th>Удалить</th>
    </tr>
    <?php
    include_once '../connect_bd.php';
    if (empty($_GET)) {
        $query = "SELECT * FROM creator_course;";
    } else {
        $query = "SELECT * FROM creator_course WHERE ";
    }
    $f1 = true;
    foreach ($_GET as $key => $value) {
        if ($f1) {
            $query = $query . $key . "=" . $value;
            $f1 = false;
        } else {
            $query = $query . " AND " . $key . "=" . $value;
        }
    }
    $result = mysqli_query($conn, $query);
    print_r($result);
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>{$row['id_creator_course']}</td><td>{$row['first_name']}</td><td>{$row['last_name']}</td><td>{$row['patronymic']}</td><td>{$row['phone']}</td><td>{$row['email']}</td><td>{$row['login']}</td><td>{$row['password']}</td><td><a href='vendor/read.php?id={$row['id_creator_course']}'>Просмотр</a></td><td><a href='update.php?id={$row['id_creator_course']}'}>Обновить</a></td><td><a href='vendor/delete.php?id={$row['id_creator_course']}'>Удалить</a></td></tr>";
    }
    mysqli_close($conn);
    ?>
</table>
<form action="vendor/create.php" method="post">
    <h2>Добавить нового создателя курса</h2>
    <input type="text" id="first_name" name="first_name" placeholder="Ввод имени">
    <input type="text" id="last_name" name="last_name" placeholder="Ввод фамилии">
    <input type="text" id="patronymic" name="patronymic" placeholder="Ввод отчества">
    <input type="text" id="phone" name="phone" placeholder="Ввод телефона">
    <input type="text" id="email" name="email" placeholder="Ввод почты">
    <input type="text" id="login" name="login" placeholder="Ввод логина">
    <?php
    if (isset($_SESSION['message'])) {
        if ($_SESSION['message'] === 'Логин должен быть уникальным') {
            echo "<div class='msg'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
    }
    ?>
    <input type="text" id="password" name="password" placeholder="Ввод пароля">
    <input type="submit" value="Создать">
</form>
<form action="../index.php" method="get">
    <input type="submit" value="Назад">
</form>
</body>
</html>