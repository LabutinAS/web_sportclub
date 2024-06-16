<?php 
session_start();
if ($_SESSION['user']) {
    $flag = 1;
}
include '../Connect.php'; 

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/Home.css">
    <link rel="stylesheet" href="../css/Text.css">
    <link rel="stylesheet" href="../css/Shadow.css">
    <link rel="icon" href="../log.png">
 
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
<div class="container">
    <section class="jumbotron">
            <div class="jumbotron-items">
            <div class="jumbotron-item">
                <h1>Достигайте своих целей с нами!</h1>
                <p>В эпоху активного образа жизни забота о своем здоровье становится всё более важной. Мы - ваш партнер в достижении фитнес-целей. Наш клуб создан для того, чтобы сделать занятия фитнесом приятными, эффективными и доступными каждому.</p>
            </div>
            </div>
    </section>

    <section class="blog">
            <?php $NEWS = mysqli_query($dp, "SELECT * FROM Новости ORDER BY RAND() LIMIT 2"); 
            $outblog = mysqli_fetch_array($NEWS);
            ?>
            <h2>Блог</h2>
            <div class="blog-posts">
                <div class="blog-post">
                    <iframe src="<?php echo $outblog[3]?>"></iframe>
                    <div class="blog-post-info">
                        <h3><?php echo $outblog[2]?></h3>
                        <p><?php echo $outblog[1]?></p>
                    </div>
                </div>
            </div>
    </section>
    </div>
</body>
</html>