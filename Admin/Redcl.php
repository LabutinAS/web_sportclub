<?php 
session_start();
if ($_SESSION['ADMIN']) {
    $flag = 1;
}
$usname = $_SESSION['ADMIN']['login'];
include '../Connect.php'; 

# УДАЛЕНИЕ
$DELclient = $_GET['DELclient'] ?? 0;
if ($DELclient > 0) {
    mysqli_query($dp, "DELETE FROM клиенты WHERE `Код_клиента` = '$DELclient'");
    header("Location: redcl.php");
    exit();
}

if (isset($_POST["update_client"])) {
    $OutCL = mysqli_real_escape_string($dp, $_POST['client_id']);
    $clientName = mysqli_real_escape_string($dp, $_POST['clientName']);
    $clientRoz = mysqli_real_escape_string($dp, $_POST['clientRoz']);
    $clientPhone = mysqli_real_escape_string($dp, $_POST['clientPhone']);
    $clientDate = mysqli_real_escape_string($dp, $_POST['clientDate']);

    mysqli_query($dp, "UPDATE `клиенты` SET `ФИО` = '$clientName', `Дата_рождения` = '$clientRoz', `Телефон` = '$clientPhone', `Дата_регистрации` = '$clientDate' WHERE `Код_клиента` = '$OutCL'");
    header("Location: redcl.php");
    exit();
}
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
                <nav class="nav">
                    <div class="nav-row">
                        <?php if($flag == 1): ?>
                        <a href="../Logout.php" class="btn">Выход</a>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- navbar end -->     
    <!-- jumbotron -->
    <div class="table">
        <div class="txt">
            <h1 class="features-t">Информация о клиентах</h1>
            <table align="center">
                <tr>
                    <td>
                        <div align="center"><a href="Prof.php"><button>Вернуться назад</button></a></div>
                    </td>
                    <td>
                        <!-- <div align="center"><a href="../#" target="_blank"><button>Перейти на страницу клиента</button></a></div> -->
                    </td>
                </tr>
            </table>

            <?php
            $IDclient = $_GET['IDclient'] ?? 0;
            $CLIENTI = mysqli_query($dp, "SELECT * FROM клиенты");

            if($IDclient > 0) {
                $CLIENTIS = mysqli_fetch_assoc(mysqli_query($dp, "SELECT * FROM клиенты WHERE `Код_клиента` = $IDclient"));
                ?>
                <table align="center" class="serv-tables">
                <?php
            } else {
                ?>
                <table align="center" class="serv-tables" >
                    <tr>
                        <th>Клиент</th>
                        <th>Дата_рождения</th>
                        <th>Телефон</th>
                        <th>Дата регистрации</th>
                        <th colspan="3">Действие</th>
                    </tr>
                    <?php
                    while($OutCL = mysqli_fetch_array($CLIENTI)) {
                        if (isset($_GET['edit']) && $_GET['edit'] == $OutCL['Код_клиента']) {
                            ?>
                            <form method="POST">
                            <tr>
                                <input type="hidden" name="client_id" value="<?= $OutCL['Код_клиента'] ?>">
                                <td><input type="txt" name="clientName" value="<?= htmlspecialchars($OutCL['ФИО']) ?>"></td>
                                <td><input type="txt" name="clientRoz" value="<?= htmlspecialchars($OutCL['Дата_рождения']) ?>"></td>
                                <td><input type="txt" name="clientPhone" value="<?= htmlspecialchars($OutCL['Телефон']) ?>"></td>
                                <td><input type="txt" name="clientDate" value="<?= htmlspecialchars($OutCL['Дата_регистрации']) ?>"></td>
                
                                <td colspan="1"><input type="submit" name="update_client" value="Обновить" ></td>
                                <td colspan="1"><input type="button" id="cancel-button" name="Redcl.php" value="Отменить" ></td>
                            </tr>
                            </form>
                            <?php
                        } else {
                            echo '<tr>
                                <td>' . $OutCL['ФИО'] . '</td>
                                <td>' . date("d-m-Y", strtotime($OutCL['Дата_рождения'])) . '</td>
                                <td>' . $OutCL['Телефон'] . '</td>  
                                <td>' . date("d-m-Y", strtotime($OutCL['Дата_регистрации'])) . '</td>
                                <td>
                                <form action="Redcl.php" method="get">
                                    <input type="hidden" name="edit" value="' . $OutCL['Код_клиента'] . '">
                                    <button type="submit">Редактировать</button>
                                </form>
                                </td>
                                <td><div class="navs-item notbtn"><a href="redcl.php?DELclient=' . $OutCL['Код_клиента'] . '"class="txt-uppercase">Удалить</a></div></td>
                             </tr>';
                        } 
                    }
                    ?>
                    
                </table>
            <?php } ?>
        </div>
    </div>
</body>
</html>
