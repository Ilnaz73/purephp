<?php
if (isset($_COOKIE['session'])) {
    session_id($_COOKIE['session']);
}
session_start();

require_once 'includes/functions.php';
require_once 'classes/DataBase.php';

$db = new DataBase();
$isAuthorized = isset($_SESSION['isAuthorized']) && $_SESSION['isAuthorized'];

$id = '';
if (isset($_GET['id'])) {
    $id = clearData($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($id == '') {
        if (!empty($_POST['login']) && !empty($_POST['pass'])) {
            $login = clearData($_POST['login']);
            $pass = clearData($_POST['pass']);
            if ($db->isTrueUser($login, $pass)) {
                $_SESSION['isAuthorized'] = true;
                $_SESSION['userName'] = $login;
                if (isset($_POST['remember'])) {
                    setcookie("session", session_id(), time() + 3600);
                } else {
                    setcookie("session", '', time() + 60);
                }

                header("Location: " . $_SERVER['PHP_SELF']);
            } else {
                echo "Не совпадает логин или пароль";
            }
        } else {
            
        }
    } elseif ($id == "registry") {
        require 'templates/registry.php';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Тестовый сайт</title>
        <meta charset="utf-8">
        <link href="styles/style.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <div id="header-text">Привет 
                <?php
                if ($isAuthorized) {
                    echo $_SESSION['userName'];
                } else {
                    echo "гость";
                }
                ?>
            </div>
            <div id="wrap">
                <a href="index.php">Главная</a>
                <a href='index.php?id=page1'>Страница 1</a>
                <a href="index.php?id=page2">Страница 2</a>  
                <?php
                if ($isAuthorized)
                    echo '<a href="index.php?id=close">Выйти</a>';
                ?>
            </div>
        </header>
        <div id="content">
            <?php
            switch ($id) {
                case 'page1': require 'templates/page1.php';
                    break;
                case 'page2': require 'templates/page2.php';
                    break;
                case 'registry': require 'templates/regForm.php';
                    break;
                case 'close':
                    session_destroy();
                    header("Location: " . $_SERVER['PHP_SELF']);
                    break;
                default: require 'templates/main.php';
            }
            ?>
        </div>
        <footer>
            &#169; Подвал, 2017 г.   
        </footer>
    </body>
</html>