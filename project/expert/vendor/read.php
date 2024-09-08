<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../../login.php');
    exit();
}
elseif ($_SESSION['user']['role'] === 'user'){
    header('Location: ../../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #333; /* Цвет фона страницы */
            color: #fff; /* Цвет текста */
            font-family: Arial, sans-serif; /* Шрифт текста */
        }
        
        #info-container {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            background-color: #222; /* Цвет фона блока информации */
            border-radius: 10px;
            text-align: center;
        }
        
        #name {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        #links {
            margin-top: 20px;
        }
        
        #links a {
            text-decoration: none;
            color: #fff; /* Цвет ссылок */
            background-color: #444; /* Цвет фона ссылок */
            padding: 5px 10px;
            margin-right: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<?php
include_once '../../connect_bd.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM expert WHERE id_expert='$id';");
$row = mysqli_fetch_array($result);
$name = $row['first_name'];
$surname = $row['last_name'];
$patronymic = $row['patronymic'];
$phone = $row['phone'];
$email = $row['email'];
?>
    <div id="info-container">
        <div id="id">ID: <?php echo $id?></div>
        <div id="name">Имя: <?php echo $row['first_name']?></div>
        <div id="last_name">Фамилия: <?php echo $row['last_name']?></div>
        <div id="patronymic">Отчество: <?php echo $row['patronymic']?></div>
        <div id="phone">Телефон: <?php echo $row['phone']?></div>
        <div id="email">Почта: <?php echo $row['email']?></div>
        <div id="links">
            <a href="..">Назад</a>
            <?php echo'<a href=../update.php?id=' .$id. '>Обновить</a>'?>
            <?php echo'<a href=../vendor/delete.php?id=' .$id. '>Удалить</a>'?>
        </div>
    </div>
</body>
</html>