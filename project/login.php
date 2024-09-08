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

        h2 {
            margin: 10px 0px 10px 0px;
        }
        .msg{
            font-size: medium;
            color: crimson;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Вход</h2>
    <form action="auth/signin.php" method="post">
        <div class="form-group">
            <label for="username">Логин</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <input type="submit" class="btn" value="Войти">
        </div>
    </form>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='msg'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>
    <div class="login-link">
        <a href="register.php">Нет аккаунта? Зарегестрироваться</a>
    </div>
</div>
</body>
</html>