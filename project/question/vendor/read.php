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
$result = mysqli_query($conn, "SELECT * FROM question WHERE id_question='$id';");
$row = mysqli_fetch_array($result);
$text_of_question = $row['text_of_question'];
$id_creator_course = $row['id_creator_course'];
$id_expert = $row['id_expert'];
?>
    <div id="info-container">
        <div id="id">ID: <?php echo $id?></div>
        <div id="text_of_question">Текст вопроса: <?php echo $row['text_of_question']?></div>
        <div id="id_creator_course">Id создателя курса: <?php echo $row['id_creator_course']?></div>
        <div id="id_expert">Id эксперта: <?php echo $row['id_expert']?></div>
        <div id="links">
            <a href="..">Назад</a>
            <?php echo'<a href=../update.php?id=' .$id. '>Обновить</a>'?>
            <?php echo'<a href=../vendor/delete.php?id=' .$id. '>Удалить</a>'?>
        </div>
    </div>
</body>
</html>