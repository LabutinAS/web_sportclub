<?php
session_start();
include '../Connect.php'; // Убедитесь, что Connect.php содержит код для подключения к базе данных
$flag = 0; // Инициализируем $flag

if (isset($_SESSION['user'])) {
    $flag = 1;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/Home.css">
	<link rel="stylesheet" href="../css/Text.css">
</head>
<body>
<header class="navbar">
        <div class="navbar-brand">
        <a href="Main.php"><img src="../log.png" alt="Логотип"></a>
        </div>
        <nav class="nav">
            <div class="nav-row">
            <a href="../main/Gallery.php" class="btn">Галерея</a>
                <a href="../main/Contact.php" class="btn">Контакты</a>
                <a href="../main/Tarif.php" class="btn">Тарифы</a>
                <?php if($flag == 1): ?>
                    <a href="../main/Account.php" class="btn">Личный кабинет</a>
                <?php else: ?>
                    <a href="../Auth.php" class="btn">Войти</a>
                    <a href="../Reg.php" class="btn">Регистрация</a>
                <?php endif; ?>
            </div>
            <div class="nav-row">
                <?php if($flag == 1): ?>
                    <a href="../Logout.php" class="btn">Выход</a>
                <?php endif; ?>
            </div>
        </nav>
</header>

<!-- jumbotron -->
<div class="table">
	<div class="txt">
            <h1 class="features-t">Выбор тренировок</h1>

            <table align="center">
                <tr>
                    <th>Название тренировки</th>
                    <th>День недели</th>
                    <?php if($flag == 1): ?>
                        <th>Действие</th>
                    <?php endif; ?>
                </tr>
                <form method="POST">
                <?php 
                $prod1 = mysqli_query($dp, "SELECT * FROM расписание_тренировок"); 
                while($prod = mysqli_fetch_array($prod1)) {
                    echo '<tr>';
                    echo '<td>'.$prod['Название_тренировки'].'</td><td>'.$prod['День_недели'].'</td>';
                    if($flag == 1) { 
                ?>
                    <td>
                        <input value="<?= $prod['Код_тренировки'] ?>" name="ArrCart[]" type="checkbox">
                    </td>
                <?php
                    }
                    echo '</tr>';
                }
                ?>
            </table>
            <?php if($flag == 1): ?>
                <div align="center"><input type="submit" name="addcart" value="Добавить"></div>
            <?php endif; ?>

            </form>

            <?php 
            if(isset($_POST["addcart"])) {
                $user = $_SESSION['user']['login'];
                $date_added = date('Y-m-d H:i:s'); // Используем корректный формат даты

                foreach($_POST["ArrCart"] as $prod) {
                    mysqli_query($dp, "INSERT INTO `покупка` (`Код_корзины`, `Код_тренировки`, `Пользователь`, `Дата добавления тренировки в корзину`) 
                                      VALUES (NULL, '$prod', '$user', '$date_added')");
                }
                echo "Работы добавлены в корзину!";
            }
            ?>  
        </div>
    </div>
 </div>
</div>
</div>
</body>
</html>