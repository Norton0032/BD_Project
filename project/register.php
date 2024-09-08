<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 3px;
        }

        label {
            font-weight: bold;
            display: block;
        }

        input[type="text"],
        input[type="password"],
        input[type="tel"],
        input[type="email"],
        select {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        select {
            width: 100%;
        }

        .btn {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .login-link {
            text-align: center;
        }
        h2{
            margin: 10px 0 10px 0;
        }
        .msg{
            font-size: medium;
            color: crimson;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Регистрация</h2>
    <form action="auth/signup.php" method="post">
        <div class="form-group">
            <label for="first-name">Имя</label>
            <input type="text" id="first-name" name="first-name" required>
        </div>

        <div class="form-group">
            <label for="last-name">Фамилия</label>
            <input type="text" id="last-name" name="last-name" required>
        </div>

        <div class="form-group">
            <label for="middle-name">Отчество</label>
            <input type="text" id="middle-name" name="middle-name">
        </div>

        <div class="form-group">
            <label for="username">Логин</label>
            <input type="text" id="username" name="username" required>
        </div>
        <?php
        if (isset($_SESSION['message'])) {
            if ($_SESSION['message'] === 'Логин должен быть уникальным') {
                echo "<div class='msg'>" . $_SESSION['message'] . "</div>";
                unset($_SESSION['message']);
            }
        }
        ?>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirm">Подтвердите пароль</label>
            <input type="password" id="password" name="password_confirm" required>
        </div>
        <?php
        if (isset($_SESSION['message'])) {
            if ($_SESSION['message'] === 'Пароли не совпадают') {
                echo "<div class='msg'>" . $_SESSION['message'] . "</div>";
                unset($_SESSION['message']);
            }
        }
        ?>
        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="email">Почта</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="role">Роль</label>
            <select id="role" name="role">
                <option value="creator">Создатель курса</option>
                <option value="candidate">Кандидат в учителя</option>
            </select>
        </div>

        <div class="form-group">
            <input type="submit" class="btn" value="Зарегистрироваться">
        </div>
    </form>

    <div class="login-link">
        <a href="login.php">Уже есть аккаунт</a>
    </div>
</div>
</body>
</html>