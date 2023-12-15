<?php
require_once  __DIR__ . '/src/helperFunctions.php';
checkGuest();
require_once  __DIR__ . '/header.php';

?>
    <div class="container text-center">
        <form action="src/login.php" method="post">
            <div class="form-group pb-4">
                <label class="form-label" for="email">email(логин)<br></label>
                <input type="text" name="email" id="email" value="<?php getOldValues('email'); ?>" placeholder="pochta@mail.ru" class="form-control mt-2">
                <small><?php getValidationMessage('email'); ?></small>
            </div>
            <div class="form-group pb-4">
                <label class="form-label" for="password">Пароль<br></label>
                <input type="password" name="password" id="password" class="form-control mt-2" placeholder="****">
                <small><?php getValidationMessage('password'); ?></small>
            </div>
            <div >
                <button type="submit" class="btn btn-success">Продолжить</button>
            </div>
            <div>
                <a href="/LR/register.php">Регистрация</a>
            </div>
        </form>
        <?php clearOldValues(); ?>
        <?php clearValidation(); ?>
    </div>
<?php
require_once  __DIR__ . '/footer.php';
?>