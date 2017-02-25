<?php
require_once 'classes/DataBase.php';//Класс базы данных

if (isset($_COOKIE['session'])) {//Проверяем есть ли в куках данные о сессии
    session_id($_COOKIE['session']);//Если есть записываем их
}
session_start();


$db = new \Ilnaz\DataBase;
$isAuthorized = isset($_SESSION['isAuthorized']) && $_SESSION['isAuthorized'];
$id = '';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {//Если данные отправились постом
    if ($id == '') {
        if (!empty($_POST['login']) && !empty($_POST['pass'])) {
            $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
            $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
            if ($db->isTrueUser($login, $pass)) {//Проверка логина и пароля в БД
                $_SESSION['isAuthorized'] = true;
                $_SESSION['userName'] = $login;
                
                if (isset($_POST['remember'])) {//Если была выбрана кнопка "Запомнить меня"
                    setcookie("session", session_id(), time() + 3600);//Устанавливаем куки
                } else {
                    setcookie("session", '', time() + 60);//Если нет присваиваем пустые
                }
                
                header("Location: " . $_SERVER['PHP_SELF']);
            } else {
                echo "Не совпадает логин или пароль";
            }
        } else {
            echo "Заполните поля формы";
        }
    } elseif ($id == "registry") {//Если в методе get также выбрана регистрация
        require 'templates/registry.php';
    }
}

require "layouts/mainwindow.php";
?>
