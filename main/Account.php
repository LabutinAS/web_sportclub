<?php 
session_start();
if ($_SESSION['user']) {
    $flag = 1;
}
$usname = $_SESSION['user']['login'];
include '../Connect.php'; 

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
                    <a href="../main/CART.php" class="btn">Выбрать тренировку</a>
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
        <!-- navbar end -->     

    <br> <br> <br> <br> <br> 
    <form id="registration-form" method="post" enctype="multipart/form-data">
    <h1 class="features-t">Личный кабинет</h1>
    <!-- Профиль -->
    <table class="user-info" align="center">
            <tr>
                <td>
                    <p>Профиль: <?= $_SESSION['user']['full_name'] ?></p>
                </td>
            </tr>
            <tr>
                <td align="left">
                    
                    <div>Логин: <?= $_SESSION['user']['login'] ?></div>
                    <div>Телефон: <?= $_SESSION['user']['number'] ?></div>
                    <div>Дата рождения: <?= date('d-m-Y', strtotime($_SESSION['user']['birth'])) ?></div>
                    <div>Дата регистрации на сайте: <?= date('d-m-Y', strtotime($_SESSION['user']['date'])) ?></div>
                </td>
            </tr>

    </table>
    </form>

    <h1>

    </h1>

    <div class="table">
	<div class="txt">
    <h1 class="features-t">Выбранные тренировки</h1>

<!-- Корзина -->
<?php
$SERV = mysqli_query($dp, "SELECT * FROM покупка WHERE покупка.Пользователь = '$usname'");
echo "<table align='center'>
<tr>
    <th>Название тренировки</th>
    <th>День тренировки</th>
    <th>Дата добавления в избранное</th>
    <th>Удаление из избранного</th>
</tr>";

while($outserv = mysqli_fetch_array($SERV)) {
    $service_id = $outserv[1];
    $service_query = mysqli_query($dp, "SELECT Название_тренировки, День_недели FROM `расписание_тренировок` WHERE `Код_тренировки` = $service_id");
    $service_data = mysqli_fetch_array($service_query);

    // Форматируем дату
    $formatted_date = date('d-m-Y H:i:s', strtotime($outserv[3]));

    echo '<tr>
    <td>'. $service_data[0] . '</td>
    <td>'. $service_data[1] . '</td>
    <td>' . $formatted_date . '</td>
    <td><a href="Account.php?DELbacket=' . $outserv[1] . '">Удалить</a></td>
    </tr>';
}


$DELbacket = isset($_GET['DELbacket']) ? $_GET['DELbacket'] : 0;
if($DELbacket > 0) {
    $deleted_backet = mysqli_real_escape_string($dp, $DELbacket); // Экранирование для безопасности
    mysqli_query($dp, "DELETE FROM `покупка` WHERE `Код_тренировки` = '$deleted_backet'");
    header("location: Account.php");
}

?>

    </table>
    </div>
    </div>
    </div>
    </div>
    </div>
</body>
</html>