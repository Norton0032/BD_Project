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
    <title>Оборудование</title>
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
<h1>Оборудование</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Технические характеристики</th>
        <th>Количество</th>
        <th>Id создателя курса</th>
        <th>Id поставщика</th>
        <th>Просмотр</th>
        <th>Обновить</th>
        <th>Удалить</th>
    </tr>
    <?php
    include_once '../connect_bd.php';
    if (empty($_GET)) {
        $query = "SELECT * FROM equipment;";
    } else {
        $query = "SELECT * FROM equipment WHERE ";
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
    if (isset($result)){
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr><td>{$row['id_equipment']}</td><td>{$row['technical_specifications']}</td><td>{$row['quantity']}</td><td>{$row['id_creator_course']}</td><td>{$row['id_provider']}</td><td><a href='vendor/read.php?id={$row['id_equipment']}'>Просмотр</a></td><td><a href='update.php?id={$row['id_equipment']}'}>Обновить</a></td><td><a href='vendor/delete.php?id={$row['id_equipment']}'>Удалить</a></td></tr>";
        }
    }
    mysqli_close($conn);
    ?>
</table>
<form action="vendor/create.php" method="post">
    <h2>Добавить новое оборудование</h2>
    <input type="text" id="technical_specifications" name="technical_specifications"
           placeholder="Ввод технических характеристик">
    <input type="text" id="quantity" name="quantity" placeholder="Ввод количества оборудования">
    <input type="text" id="id_creator_course" name="id_creator_course" placeholder="Ввод id создателя курса">
    <input type="text" id="id_provider" name="id_provider" placeholder="Ввод id поставщика">
    <input type="submit" value="Создать">
</form>
<form action="../index.php" method="get">
    <input type="submit" value="Назад">
</form>
</body>
</html>