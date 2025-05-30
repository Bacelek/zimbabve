<?php include_once __DIR__ . "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fotomaster/service">Услуги</a></li>
        <li class="breadcrumb-item active" >Новая услуга</li>
    </ol>
</nav>
<h1>Добавить услугу</h1>
<?php if(isset($data[0]['error'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($data[0]['error'] as $error): ?>
                <li><?=$error?></li>
            <?php endforeach?>
        </ul>
    </div>
<?php endif;?>

<form class="row row-cols-lg-auto g-3 align-items-center" name="addService" method="post" action="/fotomaster/service/add" >
    <div class="col-12">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Название услуги" name ="setServiceName"  maxlength="60" title="Название услуги">
            <input type="text" class="form-control" placeholder="Цена" name ="setServiceCost"  maxlength="60" title="Цена">
        </div>
    </div>
    <div class="col-12"><button  class="btn btn-primary" type="submit">Отправить</button>	</div>
</form>