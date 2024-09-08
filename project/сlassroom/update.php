<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}
elseif ($_SESSION['user']['role'] === 'user'){
    header('Location: ../index.php');
    exit();
}
include_once '../connect_bd.php';
$id = $_GET['id'];
$humen = mysqli_query($conn, "SELECT * FROM classroom WHERE id_classroom='$id'");
$row = mysqli_fetch_assoc($humen);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
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
<form action="vendor/update.php" method="post">
        <h2>Обновить информацию об помещении</h2>
        <input type="hidden" name="id_classroom" value="<?php echo $id?>">
        <input type="text" id="address" name="address" placeholder="Ввод адресса" value="<?php echo $row['address']?>">
        <input type="text" id="id_creator_course" name="id_creator_course" placeholder="Ввод id создателя курса" value="<?php echo $row['id_creator_course']?>">
        <input type="text" id="id_renter" name="id_renter" placeholder="Ввод id арендодателя" value="<?php echo $row['id_renter']?>">
        <input type="submit" value="Сохранить">
    </form>
</body>
</html>