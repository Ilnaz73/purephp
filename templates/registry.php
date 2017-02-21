<?php
$isFieldEmpty = false;
$isPassNotEqual = false;

$login = clearData($_POST['login']);
$pass = clearData($_POST['pass']);
$pass2 = clearData($_POST['pass2']);
$email = clearData($_POST['email']);
if (empty($login) || empty($pass) || empty($pass2) || empty($email)) {
    $isFieldEmpty = true;
} else {
    if ($pass != $pass2) {
        $isPassNotEqual = true;
    } else {
        $res = $db->insertUser($login, 
                password_hash($pass, PASSWORD_DEFAULT), $email);
        if (!$res) {
            //print_r($db->sqlError());
        } else {
            echo "Пользователь успешно создан!";
        }
    }
}

if ($isFieldEmpty) {
    echo "<p>Заполните все поля формы</p>";
} elseif ($isPassNotEqual) {
    echo "<p>Введенные пароли не совпадают</p>";
}
?>