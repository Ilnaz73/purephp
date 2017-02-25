<!DOCTYPE html>
<html>
    <head>
        <title>Тестовый сайт</title>
        <meta charset="utf-8">
        <link href="/styles/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
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
                <nav>
                    <a href="/index.php">Главная</a>
                    <a href='/index.php/page1'>Страница 1</a>
                    <a href="/index.php/page2">Страница 2</a>  
                    <?php
                    if ($isAuthorized)//Если юзер авторизован
                        echo '<a href="/index.php?id=close">Выйти</a>';// Добаляем кнопку выйти
                    ?>
                </nav>
            </header>
            <article>
                <?php
                switch ($id) {//Выбираем нужный шаблон по параметру id из get
                    case 'page1': 
                        require 'layouts/page1.php';
                        break;
                    case 'page2': 
                        require 'layouts/page2.php';
                        break;
                    case 'registry': 
                        require 'layouts/regForm.php';
                        break;
                    case 'close'://Если был передан параметр close
                        session_destroy();//Закрываем сессию
                        header("Location: " . $_SERVER['PHP_SELF']);//И отправляем на главную
                        break;
                    default: 
                        require 'layouts/main.php';//По стандарту направляем на главную страницу
                        break;
                }
                ?>
            </article>
            <footer>
                &#169; Подвал, 2017 г.   
            </footer>
        </div>
    </body>
</html>