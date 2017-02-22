<?php

$login = clearData($_POST['login']);
$pass = clearData($_POST['pass']);
$pass2 = clearData($_POST['pass2']);
$email = clearData($_POST['email']);

if (empty($login) || empty($pass) || empty($pass2) || empty($email)) {
    echo "<p>Заполните все поля формы</p>";
} else {
    if ($pass != $pass2) {
        echo "<p>Введенные пароли не совпадают</p>";
    } else {
        //Добавляем пользователя в БД
        $res = $db->insertUser($login, password_hash($pass, PASSWORD_DEFAULT), $email);
        if (!$res) {
            echo "Пользователь успешно создан!";
        }
    }
}
