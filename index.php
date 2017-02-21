<?php
require_once 'includes/functions.php';
require_once 'classes/DataBase.php';

$db = new DataBase();

$isAuthorised = false;
$id = '';
if(isset($_GET['id'])){
    $id = clearData($_GET['id']);
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if($id == ''){
        if(!empty($_POST['login']) && !empty($_POST['pass'])){
            $login = clearData($_POST['login']);
            $pass = clearData($_POST['pass']);
            if($db->isTrueUser($login, $pass)){
                $isAuthorised = true;
                //header("Location: " . $_SERVER['PHP_SELF']);
            }else{
                echo "Не совпадает логин или пароль";
            }         
        }else{
            
        }
    }elseif($id == "registry"){
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
           <div id="header-text">Тестовый сайт</div>
           <div id="wrap">
                <a href="index.php">Главная</a>
                <a href='index.php?id=page1'>Страница 1</a>
                <a href="index.php?id=page2">Страница 2</a>  
           </div>
        </header>
        <div id="content">
            <?php
            if($isAuthorised)
                echo 'Пользователь авторизован!!';
            
            switch($id){
                case 'page1': require 'templates/page1.php';break;
                case 'page2': require 'templates/page2.php';break;
                case 'registry': require 'templates/regForm.php';break;
                default: require 'templates/main.php';
            }
            ?>
        </div>
        <footer>
            Подвал  
        </footer>
    </body>
</html>