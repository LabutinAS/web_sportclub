<?php
session_start();

if ($_SESSION['ADMIN']) {
    unset($_SESSION['ADMIN']); // Удаляем данные администратора из сессии
    header('Location: Admin/Authadmin.php'); // Перенаправляем на страницу аутентификации для администратора
} else {
unset($_SESSION['user']);
header('Location: Auth.php');
}
?>