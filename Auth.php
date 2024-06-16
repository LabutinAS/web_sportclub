<?php
session_start();
include 'Connect.php'; 

if(isset($_POST['login'])){
    $login = mysqli_real_escape_string($dp, $_POST['login']);
    $_POST['password'] = mysqli_real_escape_string($dp, $_POST['password']);
    
    $password = $_POST['password']; 

    $check_user = mysqli_query($dp, "SELECT * FROM `клиенты` WHERE `Логин` = '$login' AND `Пароль` = '$password'");
    
    if (mysqli_num_rows($check_user) > 0) {
        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user'] = [
            "id" => $user['Код_клиента'],
            "full_name" => $user['ФИО'],
            "login" => $user['Логин'],
            "number" => $user['Телефон'],
            "birth" => $user['Дата_рождения'],
            "date" => $user['Дата_регистрации']
        ];

        header('Location: main/Account.php'); 
        exit(); 
    } else {
        $_SESSION['message'] = 'Неверный логин или пароль';
        header('Location: Auth.php');
        exit();
    }
}

// Check if the user is already logged in and redirect to Profile.php
if (isset($_SESSION['user'])) {
    header('Location: main/Account.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/Home.css">
</head>
<body>
<header class="navbar">
        <div class="navbar-brand">
        <a href="../main/Main.php"><img src="../log.png" alt="Логотип"></a>
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

    <!-- jumbotron -->
    <div id="registration-form-container">
                
                <!-- Форма авторизации -->
                <form id="registration-form" action="Auth.php" method="post" enctype="multipart/form-data">
                <h1 class="features-t" id="Блог">Авторизация</h1>
                    <label>Логин</label>
                    <input type="text" name="login" placeholder="Введите свой логин">
                    <label>Пароль</label>
                    <input type="password" name="password" placeholder="Введите пароль">
                    <button type="submit">Войти</button>
                    <?php
                        if ($_SESSION['message']) {
                            echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
                        }
                        unset($_SESSION['message']);
                    ?>
                </form>
    </div>

    <!-- jumbotron end -->
    <?php
    if ($_SESSION['message']) {
        echo '<p class="error-message"> ' . $_SESSION['message'] . ' </p>';
    }
    unset($_SESSION['message']);
    ?>
    
</body>
</html>
