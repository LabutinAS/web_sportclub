<?php 
session_start();
if ($_SESSION['user']) {
    $flag = 1;
}
include '../Connect.php'; 
?>

<!DOCTYPE html>
<html>
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
	<div class="jumbotron">
	<div class="features-box">
		<h1>Фото из нашего клуба</h1>


			<?php $GAL = mysqli_query($dp, "SELECT * FROM галерея"); 
			while($outgal = mysqli_fetch_array($GAL))
			{
				echo '<img src="'.$outgal[1]. '" width="240" height="160">	';
			}
			?>

	</div>
	</div>
	</div>

</body>
</html>