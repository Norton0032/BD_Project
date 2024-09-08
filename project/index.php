<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Изменено на вертикальное расположение элементов */
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        /* Стили для информации о пользователе */
        .user-info {
            text-align: center;
            margin-bottom: 20px; /* Добавлен отступ снизу */
            background-color: #f9f9f9;
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            font-family: 'Open Sans', sans-serif; /* Используем шрифт Open Sans */
        }

        .user-info p {
            margin: 5px 0;
            font-size: 18px;
        }

        .user-info a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        .block-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .block-link {
            width: 200px;
            height: 200px;
            background-color: #3498db;
            margin: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 10px;
            transition: transform 0.2s;
        }

        .block-link:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<div class="user-info">
    <p>Имя: <?php echo $_SESSION['user']['first_name'] ?></p>
    <p>Фамилия: <?php echo $_SESSION['user']['last_name'] ?></p>
    <p>Отчество: <?php echo $_SESSION['user']['middle_name'] ?></p>
    <p>Логин: <?php echo $_SESSION['user']['login'] ?></p>
    <p>Почта: <?php echo $_SESSION['user']['email'] ?></p>
    <p>Телефон: <?php echo $_SESSION['user']['phone'] ?></p>
    <p>Роль: <?php echo $_SESSION['user']['role'] ?></p>
    <a href="auth/logout.php">Выйти</a>
</div>
<div class="block-links">
    <?php
    if ($_SESSION['user']['role'] === 'admin'){
        echo "<a href = 'creator_course' class='block-link' > Создатель курса </a >";
    }
    ?>
    <a href="candidate_course" class="block-link">Кандидат в учителя</a>
    <a href="lesson" class="block-link">Урок</a>
    <a href="attendance" class="block-link">Посещаемость</a>
    <?php
    if ($_SESSION['user']['role'] === 'admin'){
        echo "<a href='job_application' class='block-link'>Заявка на работу</a>";
        echo "<a href='renter' class='block-link'>Арендодатель</a>";
        echo "<a href='сlassroom' class='block-link'>Помещение</a>";
        echo "<a href='provider' class='block-link'>Поставщик</a>";
        echo "<a href='equipment' class='block-link'>Оборудование</a>";
        echo "<a href='expert' class='block-link'>Эксперт</a>";
        echo "<a href='question' class='block-link'>Вопрос</a>";
    }
    ?>

</div>
</body>
</html>