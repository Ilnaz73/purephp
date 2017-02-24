<?php

$login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
$pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
$pass2 = filter_var($_POST['pass2'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

if (empty($login) || empty($pass) || empty($pass2) || empty($email)) {
    echo "<p>Заполните все поля формы</p>";
} else {
    if ($pass != $pass2) {
        echo "<p>Введенные пароли не совпадают</p>";
    } else {
        //Добавляем пользователя в БД
        $res = $db->insertUser($login, $pass, $email);
        if ($res) {
            echo "Пользователь успешно создан!";
        }
    }
}
