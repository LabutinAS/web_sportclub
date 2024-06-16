<?php
session_start();
if ($_SESSION['ADMIN']) {
    $flag = 1;
}
$usname = $_SESSION['ADMIN']['login'];
include '../Connect.php'; 

# УДАЛЕНИЕ
$DELnews = $_GET['DELnews'] ?? 0;
    if ($DELnews > 0) {
        mysqli_query($dp, "DELETE FROM новости WHERE новости.`Код_новости` = '$DELnews'");
        header("Location: RedN.php");
    }

    if (isset($_POST["update_news"])) {
        $OutNEWS = mysqli_real_escape_string($dp, $_POST['news_id']);
        $newTEXT = mysqli_real_escape_string($dp, $_POST['newTEXT']);
        $newTITLE = mysqli_real_escape_string($dp, $_POST['newTITLE']);
        $newURL = mysqli_real_escape_string($dp, $_POST['newURL']);

        mysqli_query($dp, "UPDATE `новости` SET `Заголовок` = '$newTEXT', `Текст` = '$newTITLE', `Ссылка` = '$newURL' WHERE `Код_новости` = '$OutNEWS'");
        header("Location: RedN.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>AdminPANEL</title>
    <link rel="stylesheet" href="../css/Home.css">
    <link rel="stylesheet" href="../css/Text.css">
    <link rel="stylesheet" href="../css/Shadow.css">
    <link rel="icon" href="../log.png">
</head>
<body>
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

    <div class="table">
        <div class="txt">
            <h1 class="features-t">Просмотр новостей</h1>
            <table align="center">
                <tr>
                    <td>
                        <div align="center"><a href="Prof.php"><button>Вернуться назад</button></a></div>
                    </td>
                    <td>
                        <div align="center"><a href="../main/Main.php" target="_blank"><button>Перейти на страницу новостей</button></a></div>
                    </td>
                </tr>
            </table>
            <?php
            $IDnews = $_GET['IDnews'];
            $news = mysqli_query($dp, "SELECT * FROM новости");
            {
            ?>
            <table align="center" class="serv-tables">
                <tr>
                    <th>Заголовок</th>
                    <th>Текст новости</th>
                    <th>Ссылка</th>
                    <th colspan="3">Действие</th>
                </tr>
                <?php
                while ($OutNEWS = mysqli_fetch_array($news)) {

                    if (isset($_GET['edit']) && $_GET['edit'] == $OutNEWS['Код_новости']) {
                        ?>
                        <form method="POST">
                        <tr>
                            <input type="hidden" name="news_id" value="<?= $OutNEWS['Код_новости'] ?>">
                            <td><input type="text" name="newTEXT" value="<?= htmlspecialchars($OutNEWS['Заголовок']) ?>"></td>
                            <td><input type="text" name="newTITLE" value="<?= htmlspecialchars($OutNEWS['Текст']) ?>"></td>
                            <td><input type="text" name="newURL" value="<?= htmlspecialchars($OutNEWS['Ссылка']) ?>"></td>
            
                            <td colspan="1"><input type="submit" name="update_news" value="Обновить"></td>
                            <td colspan="1"><input type="button" id="cancel-button" name="RedN.php" value="Отменить"></td>
                    </tr>
                        </form>
                        <?php
                    } else{
                    echo '<tr>
                        <td>' . $OutNEWS['Заголовок'] . '</td>
                        <td>' . $OutNEWS['Текст'] . '</td>
                        <td>' . $OutNEWS['Ссылка'] . '</td>
                        <td>
                            <form action="RedN.php" method="get">
                                <input type="hidden" name="edit" value="' . $OutNEWS['Код_новости'] . '">
                                <button type="submit">Редактировать</button>
                            </form>
                        </td>
                        <td><div class="navs-item notbtn"><a href="RedN.php?DELnews=' . $OutNEWS['Код_новости'] . '"class="txt-uppercase">Удалить</a></div></td>
                    </tr>';
                }
            }
                ?>
                <form method="POST">
                    <tr>
                        <td><input type="text" name="add_news_text" placeholder="Введите описание к новости"></td>
                        <td><input type="text" name="add_news_title" placeholder="Введите оглавление новости"></td>
                        <td><input type="text" name="add_news_url" placeholder="Введите ссылку"></td>
                        <td colspan="2" align="center"><input type="submit" name="add_news" value="Добавить" class="btn"></td>
                    </tr>
                </form>
            </table>
            <?php } ?>

            <?php




            if (isset($_POST["add_news"])) {
                $add_news_text = $_POST["add_news_text"];
                $add_news_title = $_POST["add_news_title"];
                $add_news_url = $_POST["add_news_url"];
        
                $query = "INSERT INTO новости (`Код_новости`, `Заголовок`, `Текст`, `Ссылка`) VALUES (NULL, '$add_news_text', '$add_news_title', '$add_news_url')";
                if (mysqli_query($dp, $query)) {
                    echo "";
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($dp);
                }
                echo '<meta http-equiv="refresh" content="0; url=RedN.php">';
            }

            
            ?>
        </div>
    </div>
    <script>
document.getElementById("cancel-button").addEventListener("click", function() {
    location.href = "RedN.php";
});
</script>
</body>
</html>
