<?php
    session_start();
    include '../Connect.php'; 

    if ($_SESSION['ADMIN']) {
        header('Location: Prof.php');
        exit();
    }

    $login = $_POST['login'];
    $password = $_POST['password'];

    $check_admins = mysqli_query($dp, "SELECT * FROM `сотрудники` WHERE `Логин` = '$login' AND `Пароль` = '$password'");
    if (mysqli_num_rows($check_admins) > 0) {

        $admin = mysqli_fetch_assoc($check_admins);

        $_SESSION['ADMIN'] = [
            "id" => $admin['Код_сотрудника'],
            "full_name" => $admin['ФИО'],
            "tel" => $admin['Зарплата'],
            "Dolzh" => $admin['Должность'],
            "login" => $admin['Логин']
        ];

        header('Location: Prof.php');
        exit();
    } else {

    }
    ?>

<pre>
    <?php
    print_r($check_user);
    print_r($user);
    ?>
</pre>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/Home.css">
    <link rel="stylesheet" href="../css/Text.css">
    <link rel="stylesheet" href="../css/Shadow.css">
    <link rel="icon" href="../logo1.png">
</head>
<body>
        <!-- navbar -->
        <div class="navbar">
            <div class="container">
                <div class="navbar-nav">
                    <div class="navbar-brand">
                        <a href="Authadmin.php"><img src="../log.png" alt="Логотип"></a><a>
                    </div>
                </div>
            </div>
        </div>
        <!-- navbar end -->     

<div id="registration-form-container">       
                <!-- Форма авторизации -->
                <form id="registration-form" action="Authadmin.php" method="post" enctype="multipart/form-data">
                <h1 class="features-t" id="Блог">Вход в AdminPanel</h1>
                    <label>Логин</label>
                    <input type="text" name="login" placeholder="Логин администратора">
                    <label>Пароль</label>
                    <input type="password" name="password" placeholder="Пароль администратора">
                    <button type="submit">Войти</button>
                    <?php
                        if ($_SESSION['message']) {
                            echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
                        }
                        unset($_SESSION['message']);
                    ?>
                </form>
    </div>
</body>
</html>
