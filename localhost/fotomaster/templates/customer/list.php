<?php include_once __DIR__ . "/../inc/header.html"; ?>
<h1>Список покупателей</h1>
<table class="table">
    <thead>
    <tr>
        <th>id</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Номер</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($items)): foreach($items as $customer): ?>
        <tr>
            <th><?= intval($customer->getId())?></th>
            <th><?= htmlspecialchars($customer->getFirstName())?></th>
            <th><?= htmlspecialchars($customer->getLastName())?></th>
            <th><?= htmlspecialchars($customer->getNumber())?></th>
            <th><a class="btn btn-primary" href="/fotomaster/customer/<?= intval($customer->getId()) ?>/edit">Редактировать</a></th>
            <th><a class="btn btn-danger" href="/fotomaster/customer/<?= intval($customer->getId()) ?>/delete">Удалить</a></th>
        </tr>
    <?php endforeach; endif;?>
    </tbody>
</table>
<a class="btn btn-primary" type="button"  href="/fotomaster/customer/add">Добавить</a>
