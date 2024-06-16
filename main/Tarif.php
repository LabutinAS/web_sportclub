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

	<div class="table">
	<div class="txt">
		<h1 class="features-t">Тарифы нашего клуба</h1>

		<table align="center" class="serv-tables" >
			<tr>
				<th>Название тарифа</th>
				<th>Описание</th>
                <th>Стоимость</th>
                <th>Задать вопрос</th>
			</tr>

			<?php $SERV = mysqli_query($dp, "SELECT * FROM тарифные_планы"); 
			while($outserv = mysqli_fetch_array($SERV))
			{
				echo '<tr>
				<td>'.$outserv[0].'</td><td>'.$outserv[1].'</td><td>'.$outserv[2].'</td><td><div class="navs-item notbtn"> <a href="#" class="txt-uppercase" onclick="openEmailForm(\''.$outserv[1].'\')">Написать на почту</a></div></td>
				</tr>';
			}
			echo "</table>"
			?>
		</table>
	</div>
	</div>

    <div class="table">
	<div class="txt">
		<h1 class="features-t">Тренировки в нашем клубе</h1>

		<table align="center" class="serv-tables" >
			<tr>
				<th>Название тренировки</th>
				<th>День недели</th>
                <th>Время начала</th>
                <th>Продолжительность</th>
			</tr>

			<?php $SERV = mysqli_query($dp, "SELECT * FROM расписание_тренировок"); 
			while($outserv = mysqli_fetch_array($SERV))
			{
				echo '<tr>
				<td>'.$outserv[1].'</td><td>'.$outserv[2].'</td><td>'.$outserv[3].'</td><td>'.$outserv[4].'</td>
				</tr>';
			}
			echo "</table>"
			?>
		</table>
	</div>
	</div>


    <!-- Скрытая форма для отправки письма -->
    <div id="emailForm" style="display:none;">
        <h2>Отправить письмо</h2>
        <form action="Home.php" method="post">
            <input type="email" name="recipient_email" id="recipient_email" placeholder="Почта спортивного клуба" value="<?php echo $outserv[1]; ?>" readonly>
            <?php if(isset($_SESSION['user'])): ?>
                <!-- Если пользователь аутентифицирован, выводим скрытое поле с его адресом почты -->
                <input type="hidden" name="sender_email" id="sender_email" value="<?php echo $_SESSION['user']; ?>">
            <?php else: ?>
                <!-- Если пользователь не аутентифицирован, предлагаем ввести свой адрес почты -->
                <input type="email" name="sender_email" id="sender_email" placeholder="Введите свой адрес почты" required>
            <?php endif; ?>
            <textarea name="message" placeholder="Введите ваше сообщение" required></textarea>
            <button type="submit">Отправить</button>
        </form>
    </div>

    <!-- JavaScript для открытия формы письма -->
    <script>
    function openEmailForm(email) {
        document.getElementById("recipient_email").value = email; // Заполнение поля адреса почты 
        document.getElementById("emailForm").style.display = "block"; // Открытие формы

        // Если пользователь не аутентифицирован, убедимся, что поле для его адреса почты отображается
        <?php if(!isset($_SESSION['user'])): ?>
            document.getElementById("sender_email").style.display = "block";
        <?php endif; ?>
    }
    </script>

</body>
</html>