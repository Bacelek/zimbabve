<?php include_once __DIR__ . "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fotomaster/customer">Покупатели</a></li>
        <li class="breadcrumb-item active" >Новый покупатель</li>
    </ol>
</nav>
<h1>Добавить покупателя</h1>
<?php if(isset($data[0]['error'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($data[0]['error'] as $error): ?>
                <li><?=$error?></li>
            <?php endforeach?>
        </ul>
    </div>
<?php endif;?>

<form class="row row-cols-lg-auto g-3 align-items-center" name="addCustomer" method="post" action="/fotomaster/customer/add" >
    <div class="col-12">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Имя покупателя" name ="setCustomerFirstName"  maxlength="60" title="Имя покупателя">
            <input type="text" class="form-control" placeholder="Фамилия покупателя" name ="setCustomerLastName"  maxlength="60" title="Фамилия покупателя">
            <input type="text" class="form-control" placeholder="Номер телефона" name ="setCustomerNumber"  maxlength="60" title="Номер телефона">
        </div>
    </div>
    <div class="col-12"><button  class="btn btn-primary" type="submit">Отправить</button>	</div>
</form>