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
        <h1 class="features-t">Тарифные планы клуба</h1>
        <table align="center">
            <tr>
                <td>
                    <div align="center"><a href="Prof.php"><button>Вернуться назад</button></a></div>
                </td>
                <td>
                    <div align="center"><a href="../main/Tarif.php" target="_blank"><button>Перейти на страницу тарифов</button></a></div>
                </td>
            </tr>
        </table>
    <?php
    $IDprod  =  $_GET ['IDprod'];
    $prod = mysqli_query($dp, "SELECT * FROM Тарифные_планы");


    if($IDprod > 0)
    {
    $prods = mysqli_fetch_assoc((mysqli_query($dp, "SELECT * FROM Тарифные_планы WHERE Тарифные_планы.`Код_тарифа` = $IDprod")));
?>
</br><table align="center" class="serv-tables">
<form method="POST">
<tr><th align="center"><b>Обновление данных тарифных планов</b></th>

    <tr><td> <p>Название:<b> <?php echo $prods['Название_тарифа']; ?></b></p>  
    <input  type= "text"  name= "new_prod_nazv"></p></td>

    <tr><td> <p>Описание:<b> <?php echo $prods['Описание']; ?></b></p>  
    <input  type= "text"  name= "new_prod_op"></p></td>

    <tr><td> <p>Стоимость:<b> <?php echo $prods['Стоимость']; ?></b></p>  
    <input  type= "text"  name= "new_prod_sum"></p></td>

    <tr><td><input  type= "submit"  name = "update_prod" value= "Обновить" onclick="document.getElementById('registration-form').submit();" class="btn">
        <a href="redP.php" onclick="document.getElementById('registration-form').submit();" class="btn">Отмена</a></td>


<!-- ЗАКАЗЫ -->

<?php 
    }else{
?>
    <table align="center" class="serv-tables" >
    <tr>
        <th>Название</th>
        <th>Описание</th>
        <th>Стоимость</th>
        <th colspan=3>Действие</th>
    </tr>
<?php
    while($OutPROD = mysqli_fetch_array($prod)){
    echo '<tr>
        <td>' . $OutPROD['Название_тарифа'] . '</td>  
        <td>' . $OutPROD['Описание'] . '</td>  
        <td>' . $OutPROD['Стоимость'] . '</td>  
        <td><div class="navs-item notbtn"><a href="redP.php?IDprod=' . $OutPROD['Код_тарифа'] . '">Редактировать</a></td>
        <td><div class="navs-item notbtn"><a href="redP.php?DELprod=' . $OutPROD['Код_тарифа'] . '">Удалить</a></td>';
    }
?>
<form method="POST">
    </tr><td> <input  type= "text"  name= "add_prod_name" placeholder="Введите название">  </td>
    <td> <input  type= "text"  name= "add_prod_op" placeholder="Введите описание">  </td>
    <td>  <input  type= "text"  name= "add_prod_summa" placeholder="Введите цену">  </td>
    <td colspan="2" align="center">  <input  type= "submit"  name = "add_prod" value= "Добавить" onclick="document.getElementById('registration-form').submit();" class="btn">  </td>
</form>    
</table>
<?php 
    }
    # <!-- УДАЛЕНИЕ -->
    $DELprod =  $_GET ['DELprod'];
    if($DELprod > 0){
        mysqli_query($dp , "DELETE FROM  Тарифные_планы WHERE  Тарифные_планы.`Код_тарифа` = '$DELprod'");
    }

    if (isset($_POST["update_prod"])){
    $new_prod_nazv = $_POST["new_prod_nazv"];
    $new_prod_op = $_POST["new_prod_op"];
    $new_prod_sum = $_POST["new_prod_sum"];
    
    if(!empty($new_prod_nazv)){
        mysqli_query($dp, "UPDATE Тарифные_планы SET `Название_тарифа` = '$new_prod_nazv' WHERE Тарифные_планы.`Код_тарифа` = '$IDprod'" );
    }
    if(!empty($new_prod_op)){
        mysqli_query($dp, "UPDATE Тарифные_планы SET `Описание` = '$new_prod_op' WHERE Тарифные_планы.`Код_тарифа` = '$IDprod'" );
    }
    if(!empty($new_prod_sum)){
        mysqli_query($dp, "UPDATE Тарифные_планы SET `Стоимость` = '$new_prod_sum' WHERE Тарифные_планы.`Код_тарифа` = '$IDprod'" );
    }
    }

    if (isset($_POST["add_prod"])){
        $add_prod_name = $_POST["add_prod_name"];
        $add_prod_op = $_POST["add_prod_op"];
        $add_prod_summa = $_POST["add_prod_summa"] . "";
        mysqli_query($dp , "INSERT INTO `Тарифные_планы` (`Код_тарифа`, `Название_тарифа`, `Описание`, `Стоимость`) VALUES (NULL, '$add_prod_name', '$add_prod_op', '$add_prod_summa');");
    }
    ?>

    </table>
    </table>






    </div>
    </div>
    </div>



</body>
</html>