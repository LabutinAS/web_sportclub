<?php
session_start();
include 'Connect.php'; 

if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

$CAPTCHA = mysqli_query($dp, "SELECT * FROM captcha ORDER BY RAND() LIMIT 2"); 
$outCAPTCHA = mysqli_fetch_array($CAPTCHA);
function convert($text){
    $text = trim($text);
    $text = stripcslashes($text);
    $text = strip_tags($text);
    $text = htmlspecialchars($text);
    return $text;
}

function checklength($text, $min, $max){
    $check = (mb_strlen($text) >= $min && mb_strlen($text) <= $max);
    return $check;
}

// Unset CAPTCHA session if page is reloaded
if (!isset($_POST['C_C']) && !isset($_POST['REGISTR'])) {
    unset($_SESSION['CAPTCHA']);
}

if(isset($_POST['C_C'])) {
    // Protect against SQL injection using prepared statements
    $checkCAP = mysqli_prepare($dp, "SELECT * FROM `captcha` WHERE text_cap = ?");
    mysqli_stmt_bind_param($checkCAP, "s", $_POST['CHECK_CAPTCHA']);
    mysqli_stmt_execute($checkCAP);
    $outcheckCAP = mysqli_stmt_get_result($checkCAP);
    mysqli_stmt_close($checkCAP);

    if(mysqli_num_rows($outcheckCAP) > 0) {
        $_SESSION['CAPTCHA'] = 1;
        $_SESSION['message'] = "Капча засчитана, продолжайте регистрацию!";
    } else {
        $_SESSION['CAPTCHA'] = 0;
        $_SESSION['message'] = "Введите капчу!";
    }
}

if(isset($_POST['REGISTR']) && $_SESSION['CAPTCHA']){
    $full_name = convert($_POST['full_name']);
    $login = convert($_POST['login']);
    $number = convert($_POST['number']);
    $birth = convert($_POST['birth_date']);
    $password = convert($_POST['password']);
    $password_confirm = convert($_POST['password_confirm']);

    // Protect against SQL injection using prepared statements
    $CheckUserQuery = mysqli_prepare($dp, "SELECT * FROM клиенты WHERE `Логин` = ?");
    mysqli_stmt_bind_param($CheckUserQuery, "s", $login);
    mysqli_stmt_execute($CheckUserQuery);
    $CheckUserResult = mysqli_stmt_get_result($CheckUserQuery);
    $CheckUser = mysqli_fetch_array($CheckUserResult);
    mysqli_stmt_close($CheckUserQuery);

    if(empty($CheckUser)){
        if(!checklength($login, 3, 8)) {
            $_SESSION['message'] = "Длина логина должна быть от 3 до 8 символов!";
            header('Location: Reg.php');
            exit();
        } elseif (!checklength($password, 4, 16)) {
            $_SESSION['message'] = "Длина пароля должна быть от 4 до 16 символов!";
            header('Location: Reg.php');
            exit();
        } else {
            if ($password === $password_confirm) {
                // Добавляем текущую дату регистрации
                $date = date('Y-m-d');
                $insertUserQuery = mysqli_prepare($dp, "INSERT INTO `клиенты` (`Дата_регистрации`, `ФИО`, `Телефон`, `Логин`, `Пароль`, `Дата_рождения`) VALUES (?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($insertUserQuery, "ssssss", $date, $full_name, $number, $login, $password, $birth);
                mysqli_stmt_execute($insertUserQuery);
                mysqli_stmt_close($insertUserQuery);
                
                header('Location: Auth.php');
                exit();
            } else {
                $_SESSION['message'] = 'Пароли не совпадают';
                header('Location: Reg.php');
                exit();
            }
        }
    } else {
        $_SESSION['message'] = 'Аккаунт с данным логином уже существует в системе';
        header('Location: Reg.php');
        exit();
    }
}

// Если пользователь уже авторизован, перенаправляем на страницу профиля
if ($_SESSION['user']) {
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

    <!-- jumbotron -->
    <div id="registration-form-container">
    <!-- Форма регистрации -->

    <form id="registration-form" action="Reg.php" method="post" enctype="multipart/form-data">
        <h1 class="features-t">Капча</h1>
        <h4 align="center">Перед регистрацией пройдите капчу</h4>
        <div align="center"><img src='<?php echo $outCAPTCHA[1] ?>' width="150" height="80"/></div>
        <label>Ввод капчи</label>
        <input type="text" name="CHECK_CAPTCHA" placeholder="Введите текст с картинки">
        <button type="submit" name="C_C">Проверить капчу</button>
    </form>

        <form id="registration-form" action="Reg.php" method="post" enctype="multipart/form-data">
        <h1 class="features-t">Регистрация</h1>
            <fieldset>
                <label>ФИО</label>
                <input type="text" name="full_name" placeholder="Только буквы и пробелы">
                <label>Логин</label>
                <input type="text" name="login" required placeholder="Логин. Длина от 3 до 8">
                <label>Номер телефона</label>
                <input type="text" name="number" required placeholder="Только цифры">
                <label>Дата рождения</label>
                <input type="date" name="birth_date" required placeholder="Введите вашу дату рождения">
                <label>Пароль</label>
                <input type="text" name="password" required placeholder="Пароль. Длина от 4 до 16.">
                <label>Подтверждение пароля</label>
                <input type="text" name="password_confirm" required placeholder="Подтвердите пароль">
                <?php if(!empty($_SESSION['CAPTCHA'])): ?>
                <button type="submit" name="REGISTR">Зарегистрироваться</button>
                <?php endif; ?>

            </fieldset>
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
