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
        $res = $db->insertUser($login, $pass, $email, "fsfsfaaa");
        if (!$res) {
            echo $db->sqlError();
        } else {
            echo "Пользователь успешно создан!";
        }
    }
}
//хэшировать пароль

if ($isFieldEmpty) {
    echo "<p>Заполните все поля формы</p>";
} elseif ($isPassNotEqual) {
    echo "<p>Введенные пароли не совпадают</p>";
}
?>