<?php if($isAuthorized): ?>
<div class="info-block">Поздравляем! Вы вошли!</div>
<?php else: ?>
<form method="POST" action="index.php">
    Логин<input type="text" name="login"><br>
    Пароль<input type="password" name="pass"><br>
    <input type="checkbox" name="remember">Запомнить меня<br>
    <input type="submit" value="Вход"><br>
</form>
<a href="index.php?id=registry">У вас нет аккаунта?</a>
<?php endif; ?>