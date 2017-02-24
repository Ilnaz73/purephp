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
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Тестовый сайт</title>
        <meta charset="utf-8">
        <link href="/styles/style.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <div id="header-text">Привет 
                <?php
                if ($isAuthorized) {//Если юзер авторизован
                    echo $_SESSION['userName'];//Добавляем его ник
                } else {
                    echo "гость";
                }
                ?>
            </div>
            <div id="wrap">
                <a href="/index.php">Главная</a>
                <a href='/index.php/page1'>Страница 1</a>
                <a href="/index.php/page2">Страница 2</a>  
                <?php
                if ($isAuthorized)//Если юзер авторизован
                    echo '<a href="/index.php?id=close">Выйти</a>';// Добаляем кнопку выйти
                ?>
            </div>
        </header>
        <div id="content">
            <?php
            switch ($id) {//Выбираем нужный шаблон по параметру id из get
                case 'page1': 
                    require 'templates/page1.php';
                    break;
                case 'page2': 
                    require 'templates/page2.php';
                    break;
                case 'registry': 
                    require 'templates/regForm.php';
                    break;
                case 'close'://Если был передан параметр close
                    session_destroy();//Закрываем сессию
                    header("Location: " . $_SERVER['PHP_SELF']);//И отправляем на главную
                    break;
                default: 
                    require 'templates/main.php';//По стандарту направляем на главную страницу
                    break;
            }
            ?>
        </div>
        <footer>
            &#169; Подвал, 2017 г.   
        </footer>
    </body>
</html>