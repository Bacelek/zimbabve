<?php include_once __DIR__ . "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fotomaster/customer">Покупатели</a></li>
        <li class="breadcrumb-item active" aria-current="page">Редактирование покупателя</li>
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
<form class="row row-cols-lg-auto g-3 align-items-center" name="editCustomer" method="post" action="/fotomaster/customer/<?=$data[0]["currentItem"]->getId()?>/edit">
    <div class="col-12">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Имя покупателя" name ="setCustomerFirstName"  maxlength="60"
                   value="<?=$data[0]["currentItem"]->getFirstName()?>" title="Имя покупателя">
            <input type="text" class="form-control" placeholder="Фамилия покупателя" name ="setCustomerLastName"  maxlength="60"
                   value="<?=$data[0]["currentItem"]->getLastName()?>" title="Фамилия покупателя">
            <input type="text" class="form-control" placeholder="Почта" name="setCustomerNumber" maxlength="60"
                   value="<?=$data[0]["currentItem"]->getNumber()?>" title="Номер">
        </div>
    </div>
    <div class="col-12"><button  class="btn btn-primary" type="submit">Отправить</button>	</div>
</form>