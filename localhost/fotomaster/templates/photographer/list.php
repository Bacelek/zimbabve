<?php include_once __DIR__ . "/../inc/header.html"; ?>
<h1>Список фотографов</h1>
<table class="table">
    <thead>
    <tr>
        <th>id</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Фото</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($items)): foreach($items as $good): ?>
        <tr>
            <th><?= intval($good->getId())?></th>
            <th><?= htmlspecialchars($good->getFirstName())?></th>
            <th><?= htmlspecialchars($good->getLastName())?></th>
            <th><img src="/fotomaster/templates/images/<?= htmlspecialchars($good->getImage()) ?>" alt="<?= htmlspecialchars($good->getFirstName()) ?>" style="width: 100px; height: auto;"></th>
            <th><a class="btn btn-primary" href="/fotomaster/photographer/<?= intval($good->getId()) ?>/edit">Редактировать</a></th>
            <th><a class="btn btn-danger" href="/fotomaster/photographer/<?= intval($good->getId()) ?>/delete">Удалить</a></th>
        </tr>
    <?php endforeach; endif;?>
    </tbody>
</table>
<a class="btn btn-primary" type="button"  href="/fotomaster/photographer/add">Добавить</a>
