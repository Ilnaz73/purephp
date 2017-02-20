<?php
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
                <a href="#">Главная</a>
                <a href="#">Страница 1</a>
                <a href="#">Страница 2</a>  
           </div>
        </header>
        <div id="content">
            <form method="POST" action="handler.php">
                Логин<input type="text" name="login"><br>
                Пароль<input type="password" name="pass"><br>
                <input type="checkbox" name="remember">Запомнить меня<br>
                <input type="submit" value="Вход"><br>
            </form>
        </div>
        <footer>
            Подвал  
        </footer>
    </body>
</html>