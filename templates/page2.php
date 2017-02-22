<?php if ($isAuthorized): ?>
    <div class="info-block">Этот текст только для юзеров</div>
<?php else: ?>
    <div class="error-block">Вам сюда нельзя</div>
<?php endif; ?>

