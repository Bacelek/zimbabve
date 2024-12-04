<?php include_once __DIR__ . "/../inc/header.html"; ?>
<h1>Список типов фотографии</h1>
<table class="table">
    <thead>
    <tr>
        <th>id</th>
        <th>Название</th>
        <th>Цена</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($items)): foreach($items as $type): ?>
        <tr>
            <th><?= intval($type->getId())?></th>
            <th><?= htmlspecialchars($type->getName())?></th>
            <th><?= htmlspecialchars($type->getCost())?></th>
            <th><a class="btn btn-primary" href="/fotomaster/typephotography/<?= intval($type->getId()) ?>/edit">Редактировать</a></th>
            <th><a class="btn btn-danger" href="/fotomaster/typephotography/<?= intval($type->getId()) ?>/delete">Удалить</a></th>
        </tr>
    <?php endforeach; endif;?>
    </tbody>
</table>
<a class="btn btn-primary" type="button"  href="/fotomaster/typephotography/add">Добавить</a>
