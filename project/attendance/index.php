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
    <title>Посещения</title>
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
<h1>Посещения</h1>
<table>
    <tr>
        <?php
        if ($_SESSION['user']['role'] === 'admin') {
            echo "<th>Id</th>";
        }
        ?>
        <th>Id урока</th>
        <th>Id кандидата</th>
        <?php
        if ($_SESSION['user']['role'] === 'admin') {
            echo "
            <th>Просмотр</th>
            <th>Обновить</th>
            <th>Удалить</th>
            ";
        }
        ?>
    </tr>
    <?php
    include_once '../connect_bd.php';
    if (empty($_GET)) {
        $query = "SELECT * FROM attendance;";
    } else {
        $query = "SELECT * FROM attendance WHERE ";
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
            echo "<tr><td>{$row['id_attendance']}</td><td>{$row['id_lesson']}</td><td>{$row['id_candidate_course']}</td><td><a href='vendor/read.php?id={$row['id_attendance']}'>Просмотр</a></td><td><a href='update.php?id={$row['id_attendance']}'}>Обновить</a></td><td><a href='vendor/delete.php?id={$row['id_attendance']}'>Удалить</a></td></tr>";
        } else {
            echo "<tr><td>{$row['id_lesson']}</td><td>{$row['id_candidate_course']}</td></tr>";

        }
    }
    mysqli_close($conn);
    ?>
</table>
<?php
if ($_SESSION['user']['role'] === 'admin') {
    echo "
        <form action='vendor/create.php' method='post'>
            <h2>Добавить новое посещение</h2>
            <input type='text' id='id_lesson' name='id_lesson' placeholder='Ввод id урока'>
            <input type='text' id='id_candidate_course' name='id_candidate_course' placeholder='Ввод id кандидата'>
            <input type='submit' value='Создать'>
        </form>
        ";
}
?>
<form action='../index.php' method='get'>
    <input type="submit" value="Назад">
</form>
</body>
</html>