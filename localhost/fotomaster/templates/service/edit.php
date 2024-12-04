<?php include_once __DIR__ . "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fotomaster/service">Услуги</a></li>
        <li class="breadcrumb-item active" aria-current="page">Редактирование услуги</li>
    </ol>
</nav>

<h1>Редактировать покупателя</h1>
<?php if(isset($data[1]['error'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($data[1]['error'] as $error): ?>
                <li><?=$error?></li>
            <?php endforeach?>
        </ul>
    </div>
<?php endif;?>
<form class="row row-cols-lg-auto g-3 align-items-center" name="editCustomer" method="post" action="/fotomaster/service/<?=$data[0]["currentItem"]->getId()?>/edit">
    <div class="col-12">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Название услуги" name ="setServiceName"  maxlength="60"
                   value="<?=$data[0]["currentItem"]->getName()?>" title="Название услуши">
            <input type="text" class="form-control" placeholder="Цена" name ="setServiceCost"  maxlength="60"
                   value="<?=$data[0]["currentItem"]->getCost()?>" title="Цена">
        </div>
    </div>
    <div class="col-12"><button  class="btn btn-primary" type="submit">Отправить</button>	</div>
</form>