<?php include_once __DIR__ . "/../inc/header.html"; ?>
<h1>Список заказов</h1>
<table class="table">
    <thead>
    <tr>
        <th>id</th>
        <th>id фотографа</th>
        <th>id покупателя</th>
        <th>id услуги</th>
        <th>id типа фотографии</th>
        <th>Дата</th>
        <th>Цена</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($items)): foreach($items as $order): ?>
        <tr>
            <th><?= intval($order->getId())?></th>
            <th><?= htmlspecialchars($order->getPhotographerId())?></th>
            <th><?= htmlspecialchars($order->getCustomerId())?></th>
            <th><?= htmlspecialchars($order->getServiceId())?></th>
            <th><?= htmlspecialchars($order->getTypePhotographyId())?></th>
            <th><?= htmlspecialchars($order->getDate())?></th>
            <th><?= htmlspecialchars($order->getCost())?></th>
            <th><a class="btn btn-primary" href="/fotomaster/orders/<?= intval($order->getId()) ?>/edit">Редактировать</a></th>
            <th><a class="btn btn-danger" href="/fotomaster/orders/<?= intval($order->getId()) ?>/delete">Удалить</a></th>
        </tr>
    <?php endforeach; endif;?>
    </tbody>
</table>
<a class="btn btn-primary" type="button"  href="/fotomaster/orders/add">Добавить</a>
