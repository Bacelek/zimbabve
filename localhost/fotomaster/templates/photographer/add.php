<?php include_once __DIR__ . "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fotomaster/photographer">Фотографы</a></li>
        <li class="breadcrumb-item active" >Новый фотограф</li>
    </ol>
</nav>
<h1>Добавить фотографа</h1>
<?php if(isset($data[0]['error'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($data[0]['error'] as $error): ?>
                <li><?=$error?></li>
            <?php endforeach?>
        </ul>
    </div>
<?php endif;?>

<form class="row row-cols-lg-auto g-3 align-items-center" name="addPhotographer" method="post" action="/fotomaster/photographer/add" enctype="multipart/form-data" >
    <div class="col-12">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Имя" name ="setPhotographerFirstName"  maxlength="60" title="Имя">
            <input type="text" class="form-control" placeholder="Фамилия" name ="setPhotographerLastName"  maxlength="60" title="Фамилия">
            <input type="file" class="form-control" name="setPhotographerImage" title="Изображение фотографа">
        </div>
    </div>
    <div class="col-12"><button  class="btn btn-primary" type="submit">Отправить</button>	</div>
</form>