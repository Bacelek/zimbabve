<?php
    require_once  __DIR__ . '/src/helperFunctions.php';
    checkGuest();
    require_once  __DIR__ . '/header.php';

?>
<div class="container text-center">
    <form action="src/register.php" method="post">
        <div class="form-group pb-4">
            <label class="form-label" for="email">email(логин)<br></label>
            <input type="text" name="email" id="email" value="<?php getOldValues('email'); ?>" placeholder="pochta@mail.ru" class="form-control mt-2">
            <small><?php getValidationMessage('email'); ?></small>
        </div>
        <div class="form-group pb-4">
            <label class="form-label" for="birthDate">Дата рождения<br></label>
            <input type="date" name="birthDate" id="birthDate" value="<?php getOldValues('birthDate'); ?>" class="form-control mt-2">
            <small><?php getValidationMessage('birthDate'); ?></small>
        </div>
        <div class="form-group pb-4">
            <label class="form-label" for="address">Адрес<br></label>
            <input type="text" name="address" id="address" value="<?php getOldValues('address'); ?>" class="form-control mt-2" placeholder="г.Волгоград">
            <small><?php getValidationMessage('address'); ?></small>
        </div>
        <div class="form-group pb-4">
            <label class="form-label mt-2" for="gender">Пол<br></label>
            <select name="gender" class="form-select"  id="gender">
                <option value="man" <?php echo getOldOption('gender', 'man'); ?>>Мужской</option>
                <option value="woman" <?php echo getOldOption('gender', 'woman'); ?>>Женский</option>
            </select>
        </div>
        <div class="form-group pb-4">
            <label class="form-label" for="interests">Интересы<br></label>
            <textarea name="interests" id="interests"  class="form-control mt-2" placeholder="Интересы"><?php getOldValues('interests'); ?></textarea>
            <small><?php getValidationMessage('interests'); ?></small>
        </div>
        <div class="form-group pb-4">
            <label class="form-label" for="linkVK">Ссылка на профиль VK<br></label>
            <input type="text" name="linkVK" id="linkVK" value="<?php getOldValues('linkVK'); ?>" class="form-control mt-2" placeholder="https://vk.com/id1">
            <small><?php getValidationMessage('linkVK'); ?></small>
        </div>
        <div class="form-group pb-4">
            <label class="form-label mt-2" for="bloodType">Группа крови<br></label>
            <select name="bloodType" class="form-select" id="bloodType">
                <option value="one" <?php echo getOldOption('bloodType', 'one'); ?>>1</option>
                <option value="two" <?php echo getOldOption('bloodType', 'two'); ?>>2</option>
                <option value="three" <?php echo getOldOption('bloodType', 'three'); ?>>3</option>
                <option value="four" <?php echo getOldOption('bloodType', 'four'); ?>>4</option>
            </select>
        </div>
        <div class="form-group pb-4">
            <label class="form-label mt-2" for="RHfactor">Резус-фактор<br></label>
            <select name="RHfactor" class="form-select" id="RHfactor">
                <option value="plus" <?php echo getOldOption('RHfactor', 'plus'); ?>>Положительный</option>
                <option value="minus" <?php echo getOldOption('RHfactor', 'minus'); ?>>Отрицательный</option>
            </select>
        </div>
        <div class="form-group pb-4">
            <label class="form-label" for="password">Пароль<br></label>
            <input type="password" name="password" id="password" class="form-control mt-2" placeholder="****">
            <small><?php getValidationMessage('password'); ?></small>
        </div>
        <div class="form-group pb-4">
            <label class="form-label" for="passwordConfirm">Подтвердите пароль<br></label>
            <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control mt-2" placeholder="****">
        </div>
        <div >
            <button type="submit" class="btn btn-success">Продолжить</button>
        </div>
        <div>
            <a href="/LR/login.php">Авторизация</a>
        </div>
    </form>
    <?php clearValidation(); ?>
    <?php clearOldValues(); ?>

</div>
<?php
require_once  __DIR__ . '/footer.php';
?>
