<?php if ($isAuthorized): ?>
    <div class="info-block">Поздравляем! Вы вошли!</div>
<?php else: ?>
    <h3>Форма авторизации</h3>
    <form method="POST" action="index.php">
        <table>
            <tr>
                <td>Логин</td>
                <td><input type="text" name="login"></td>
            </tr>
            <tr>
                <td>Пароль</td>
                <td><input type="password" name="pass"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="checkbox" name="remember">Запомнить меня</td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Вход"></td>
            </tr>
            <tr>
                <td></td>
                <td><a href="index.php?id=registry">У вас нет аккаунта?</a></td>
            </tr>
        </table> 
    </form>
<?php endif; ?>