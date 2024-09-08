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
    <title>Поставщик</title>
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
    </style>
</head>
<body>
<h1>Поставщик</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Отчество</th>
        <th>Телефон</th>
        <th>Список оборудования</th>
        <th>Просмотр</th>
        <th>Обновить</th>
        <th>Удалить</th>
    </tr>
    <?php
    include_once '../connect_bd.php';
    if (empty($_GET)) {
        $query = "SELECT * FROM provider;";
    } else {
        $query = "SELECT * FROM provider WHERE ";
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
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>{$row['id_provider']}</td><td>{$row['first_name']}</td><td>{$row['last_name']}</td><td>{$row['patronymic']}</td><td>{$row['phone']}</td><td>{$row['list_of_equipment']}</td><td><a href='vendor/read.php?id={$row['id_provider']}'>Просмотр</a></td><td><a href='update.php?id={$row['id_provider']}'}>Обновить</a></td><td><a href='vendor/delete.php?id={$row['id_provider']}'>Удалить</a></td></tr>";
    }
    mysqli_close($conn);
    ?>
</table>
<form action="vendor/create.php" method="post">
    <h2>Добавить нового поставщика</h2>
    <input type="text" id="first_name" name="first_name" placeholder="Ввод имени">
    <input type="text" id="last_name" name="last_name" placeholder="Ввод фамилии">
    <input type="text" id="patronymic" name="patronymic" placeholder="Ввод отчества">
    <input type="text" id="phone" name="phone" placeholder="Ввод телефона">
    <textarea id="list_of_equipment" name="list_of_equipment" placeholder="Ввод списка оборудования"></textarea>
    <input type="submit" value="Создать">
</form>
<form action="../index.php" method="get">
    <input type="submit" value="Назад">
</form>
</body>
</html>