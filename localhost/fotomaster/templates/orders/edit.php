<?php include_once __DIR__ . "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fotomaster/orders">Заказы</a></li>
        <li class="breadcrumb-item active" >Редактирование заказа</li>
    </ol>
</nav>
<h1>Редактировать заказ</h1>
<?php if(isset($data[0]['error'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($data[0]['error'] as $error): ?>
                <li><?=$error?></li>
            <?php endforeach?>
        </ul>
    </div>
<?php endif;?>

<form class="row row-cols-lg-auto g-3 align-items-center" name="addOrder" method="post" action="/fotomaster/orders/add">
    <div class="col-12">
        <div class="input-group">
            <label for="setPhotographerId" class="input-group-text">Фотограф</label>
            <select class="form-select" name="setPhotographerId" id="setPhotographerId" required>
                <option value="" disabled selected>Выберите фотографа</option>
                <?php foreach ($data['photogragher'] as $photogragher): ?>
                    <option value="<?= htmlspecialchars($photogragher->getId()) ?>" <?= $photogragher->getId() == $data['currentItem']->getPhotographerId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($photogragher->getFirstName() . ' ' . $photogragher->getLastName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="setCustomerId" class="input-group-text">Покупатель</label>
            <select class="form-select" name="setCustomerId" id="setCustomerId" required>
                <option value="" disabled selected>Выберите покупателя</option>
                <?php foreach ($data['customers'] as $customer): ?>
                    <option value="<?= htmlspecialchars($customer->getId()) ?>" <?= $customer->getId() == $data['currentItem']->getCustomerId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($customer->getFirstName() . ' ' . $customer->getLastName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>


            <label for="setServiceId" class="input-group-text">Услуга</label>
            <select class="form-select" name="setServiceId" id="setServiceId" required>
                <option value="" disabled selected>Выберите услугу</option>
                <?php foreach ($data['service'] as $service): ?>
                    <option value="<?= htmlspecialchars($service->getId()) ?>" <?= $service->getId() == $data['currentItem']->getServiceId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($service->getName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="setTypePhotographyId" class="input-group-text">Тип фотографии</label>
            <select class="form-select" name="setTypePhotographyId" id="setTypePhotographyId">
                <option value="" selected>Тип</option>
                <?php foreach ($data['typephotography'] as $typephotography): ?>
                    <option value="<?= htmlspecialchars($typephotography->getId()) ?>" <?= $typephotography->getId() == $data['currentItem']->getTypePhotographyId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($typephotography->getName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="setDate" class="input-group-text">Дата</label>
            <input type="date" class="form-control" name="setDate" id="setDate" value="<?= htmlspecialchars($data['currentItem']->getDate()) ?>">


        </div>
    </div>
    <div class="col-12"><button class="btn btn-primary" type="submit">Отправить</button></div>
</form>