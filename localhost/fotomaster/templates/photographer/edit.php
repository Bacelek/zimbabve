<?php include_once __DIR__ . "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fotomaster/photographer">Фотографы</a></li>
        <li class="breadcrumb-item active" aria-current="page">Редактирование фотографа</li>
    </ol>
</nav>

<h1>Редактировать фотографа</h1>
<?php if(isset($data[1]['error'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($data[1]['error'] as $error): ?>
                <li><?=$error?></li>
            <?php endforeach?>
        </ul>
    </div>
<?php endif;?>
<form class="row row-cols-lg-auto g-3 align-items-center" name="editPhotographer" method="post" action="/fotomaster/photographer/<?=$data[0]["currentItem"]->getId()?>/edit" enctype="multipart/form-data">
    <div class="col-12">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Имя фотографа" name ="setPhotographerFirstName"  maxlength="60"
                   value="<?=$data[0]["currentItem"]->getFirstName()?>" title="Имя фотографа">
            <input type="text" class="form-control" placeholder="Фамилия фотографа" name ="setPhotographerLastName"  maxlength="60"
                   value="<?=$data[0]["currentItem"]->getLastName()?>" title="Фамилия фотографа">
            <input type="file" class="form-control" name="setPhotographerImage" title="Изображение продукта">
        </div>
    </div>
    <div class="col-12"><button  class="btn btn-primary" type="submit">Отправить</button>	</div>
</form>