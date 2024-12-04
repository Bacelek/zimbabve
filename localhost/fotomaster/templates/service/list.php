<?php include_once __DIR__ . "/../inc/header.html"; ?>
<h1>Список услуг</h1>
<table class="table">
    <thead>
    <tr>
        <th>id</th>
        <th>Название</th>
        <th>Цена</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($items)): foreach($items as $service): ?>
        <tr>
            <th><?= intval($service->getId())?></th>
            <th><?= htmlspecialchars($service->getName())?></th>
            <th><?= htmlspecialchars($service->getCost())?></th>
            <th><a class="btn btn-primary" href="/fotomaster/service/<?= intval($service->getId()) ?>/edit">Редактировать</a></th>
            <th><a class="btn btn-danger" href="/fotomaster/service/<?= intval($service->getId()) ?>/delete">Удалить</a></th>
        </tr>
    <?php endforeach; endif;?>
    </tbody>
</table>
<a class="btn btn-primary" type="button"  href="/fotomaster/service/add">Добавить</a>
