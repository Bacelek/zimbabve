<?php include_once __DIR__ . "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fotomaster/typephotography">Типы фотографий</a></li>
        <li class="breadcrumb-item active" >Новый тип</li>
    </ol>
</nav>
<h1>Добавить тип</h1>
<?php if(isset($data[0]['error'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($data[0]['error'] as $error): ?>
                <li><?=$error?></li>
            <?php endforeach?>
        </ul>
    </div>
<?php endif;?>

<form class="row row-cols-lg-auto g-3 align-items-center" name="addType" method="post" action="/fotomaster/typephotography/add" >
    <div class="col-12">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Название типа" name ="setTypeName"  maxlength="60" title="Название услуги">
            <input type="text" class="form-control" placeholder="Цена" name ="setTypeCost"  maxlength="60" title="Цена">
        </div>
    </div>
    <div class="col-12"><button  class="btn btn-primary" type="submit">Отправить</button>	</div>
</form>