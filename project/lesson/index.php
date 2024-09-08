<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Уроки</title>
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
<h1>Уроки</h1>
<table>
    <tr>
        <?php
        if ($_SESSION['user']['role'] === 'admin') {
            echo "<th>Id</th>";
        }
        ?>
        <th>Название урока</th>
        <th>Место проведения</th>
        <th>Время проведения</th>
        <?php
        if ($_SESSION['user']['role'] === 'admin') {
            echo "<th>Id создателя курса</th>";
        }
        ?>
        <th>Просмотр</th>
        <?php
        if ($_SESSION['user']['role'] === 'admin') {
            echo "
                <th>Обновить</th>
                <th>Удалить</th>
                ";
        }
        ?>
    </tr>
    <?php
    include_once '../connect_bd.php';
    if (empty($_GET)) {
        $query = "SELECT * FROM lesson;";
    } else {
        $query = "SELECT * FROM lesson WHERE ";
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
        if ($_SESSION['user']['role'] === 'admin') {
            echo "<tr><td>{$row['id_lesson']}</td><td>{$row['lesson_name']}</td><td>{$row['lesson_place']}</td><td>{$row['lesson_time']}</td><td>{$row['id_creator_course']}</td><td><a href='vendor/read.php?id={$row['id_lesson']}'>Просмотр</a></td><td><a href='update.php?id={$row['id_lesson']}'}>Обновить</a></td><td><a href='vendor/delete.php?id={$row['id_lesson']}'>Удалить</a></td></tr>";
        } else {
            echo "<tr><td>{$row['lesson_name']}</td><td>{$row['lesson_place']}</td><td>{$row['lesson_time']}</td><td><a href='vendor/read.php?id={$row['id_lesson']}'>Просмотр</a></td></tr>";

        }
    }
    mysqli_close($conn);
    ?>
</table>
<?php
if ($_SESSION['user']['role'] === 'admin') {
    echo "
    <form action='vendor/create.php' method='post'>
        <h2>Добавить новый урок</h2>
        <input type='text' id='lesson_name' name='lesson_name' placeholder='Ввод названия урока'>
        <input type='text' id='lesson_place' name='lesson_place' placeholder='Ввод места урока'>
        <label for='bday''>Ввод даты урока:</label>
        <input type='date' id='bday' name='data' />
        <label for='time'>Ввод времени урока: </label>
        <input id='time' type='time' name='time' step='2' />
        <input type='text' id='id_creator_course' name='id_creator_course' placeholder='Ввод id создателя курса'>
        <input type='submit' value='Создать'>
    </form>
    ";
}
?>
<form action="../index.php" method="get">
    <input type="submit" value="Назад">
</form>
</body>
</html>