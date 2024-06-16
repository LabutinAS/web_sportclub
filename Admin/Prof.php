<?php 
session_start();
if ($_SESSION['ADMIN']) {
    $flag = 1;
}
$usname = $_SESSION['ADMIN']['login'];
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
        <!-- navbar -->

        <div class="navbar">
                <div class="navbar-brand">
                        <a href="Prof.php"><img src="../log.png" alt="Логотип"></a><a>
                    </div>
                <nav class="nav">
                    <div class="nav-row">
                    <?php if($flag == 1): ?>
                        <a href="../Logout.php" class="btn">Выход</a>
                        <a href="Redcl.php" onclick="document.getElementById('registration-form').submit();" class="btn">Редактирование клиентов</a>
                        <a href="RedN.php" onclick="document.getElementById('registration-form').submit();" class="btn">Редактирование новостной ленты</a>
                        <a href="RedP.php" onclick="document.getElementById('registration-form').submit();" class="btn">Редактирование тарифов</a>
                    <?php endif; ?>
                    </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- navbar end -->     

        <!-- jumbotron -->

    <br> <br> <br> <br> <br> 
    <form id="registration-form" method="post" enctype="multipart/form-data">
    <h1 class="features-t">Профиль администратора</h1>
    <!-- Профиль -->
    <table class="user-info" align="center">
    </table>

    </form>
    <?php
    $CLIENTI = mysqli_query($dp, "SELECT * FROM клиенты");
    $selectedClient = isset($_GET['client']) ? $_GET['client'] : ''; // Получаем выбранный клиент из параметра GET, если он существует

    // Проверяем, был ли выбран клиент, и формируем условие WHERE для запроса корзины
    $condition = '';
    if ($selectedClient != '') {
        $condition = "WHERE покупка.Пользователь = '$selectedClient'";
    }
    ?>
    <div class="table">
        <div class="txt"></div>
        <form method="GET">
            <label for="client">Выберите клиента:</label>
            <select name="client" id="client">
                <option value="">Все клиенты</option>
                <?php while ($client = mysqli_fetch_array($CLIENTI)) : ?>
                    <option value="<?php echo $client['Логин']; ?>" <?php echo ($selectedClient == $client['Логин']) ? 'selected' : ''; ?>><?php echo $client['Логин']; ?></option>
                <?php endwhile; ?>
            </select>
            <input type="submit" value="Применить" onclick="document.getElementById('registration-form').submit();" class="btn">
            <a href="?" onclick="document.getElementById('registration-form').submit();" class="btn">Сбросить фильтр</a>
        </form>
        <table align="center" class="serv-tables">
            <tr>
                <th>Клиент</th>
                <th>Тренировка</th>
                <th>Добавление в корзину</th>
            </tr>
            <?php
            // Формируем запрос корзины с учетом условия WHERE
            $query = "SELECT * FROM покупка $condition";
            $SERV_query = mysqli_query($dp, $query);
            while ($outserv = mysqli_fetch_array($SERV_query)) {
                $service_query = mysqli_query($dp, "SELECT `Название_тренировки` FROM Расписание_тренировок WHERE Расписание_тренировок.`Код_тренировки` = $outserv[1]");
                $service_data = mysqli_fetch_array($service_query);
                if ($service_data) {
                    echo '<tr>
                    <td>' . $outserv['Пользователь'] . '</td>
                    <td>' . $service_data['Название_тренировки'] . '</td>
                    <td>' . date("d-m-Y", strtotime($outserv[3])) . '</td>
                    </tr>';
                }
            }
            ?>
        </table>
    </div>


    </div>
    </div>
    </div>
</body>
</html>