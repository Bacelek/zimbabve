<?php
    require_once 'logic.php';
    $products = getProductsFromDb();
    $valuesFromGet = getValuesFromGET();
    $brands = getBrandsFromDb();
?>



<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Импульсный моноблок</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header ">
    <div class="lang-navbar ">
        <div class="container-fluid ">
            <div class="mt-1">
                <ul class="nav justify-content-left" >
                    <li class="nav-item me-5" >
                        <a class="nav-link black " href="#"><img src="images/mark.png" alt="mark" width="20">Волгоград</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="#">Магазины</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">Доставка и оплата</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Гарантия и возврат</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">Покупка в кредит</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Эксперт</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">Дисконт</a>
                    </li>
                    <li class="nav-item mr-320" >
                        <a class="nav-link " href="#">Комиссионка</a>
                    </li>
                    <li class="nav-item " >
                        <a class="nav-link black " href="#">+7 (844) 296 51 14 <img src="images/i.png" alt="i" width="15"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="search-navbar p-2">
        <div class="container-flout">
            <ul class="nav justify-content-between">
                <li class="nav-item">
                    <img src="images/logo.svg" alt="logo">
                </li>
                <li class="nav-item">
                    <button class="sizecatolog"><span class="text-white">Каталог</span></button>
                </li>
                <div class="d-flex">
                    <form action="#">
                        <p>
                            <input  class="sizeinput" type="text" placeholder="Поиск товара..." size="80">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="height: 45px" >
                                Поиск...
                            </button>
                        </p>
                    </form>
                    <li class="nav-item">
                        <button class="buttonstyle"><a class="nav-link" href="#"><p class="ots"><img src="images/kyb.png" alt="kyb" width="25"></p><p>статус заказа</p></a></button>
                    </li>
                    <li class="nav-item">
                        <button class="buttonstyle"><a class="nav-link" href="#"><p class="ots"><img src="images/human.png" alt="human" width="25"></p><p>Кабинет</p></a></button>
                    </li>
                    <li class="nav-item">
                        <button class="buttonstyle"><a class="nav-link" href="#"><p class="ots"><img src="images/cart.png" alt="cart" width="25"></p><p>Корзина</p></a></button>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</div>

<div class="main py-3">
    <div class="container text-center">
        <form class=" mb-5" action="products.php" method="get">
            <div class="mb-3">
                <label for="inputName" class="form-label">Название</label>
                <input value="<?= $valuesFromGet['name']?>" name="name" type="text" class="form-control" id="inputName">
            </div>
            <div class="mb-3">
                <label for="inputSelect" class="form-label">Брэнд</label>
                <select name="id_brand" id="inputSelect" class="form-select">
                    <option <?= empty($_GET['id_brand']) ? 'selected' : '' ?> value="">Не выбрано</option>
                    <?php foreach ($brands as $brand): ?>
                        <?php if ($brand['id'] == $_GET['id_brand']): ?>
                            <option selected value="<?=htmlspecialchars($brand['id'])?>">
                                <?=htmlspecialchars($brand['name'])?>
                            </option>
                        <?php else: ?>
                            <option value="<?=htmlspecialchars($brand['id'])?>">
                                <?=htmlspecialchars($brand['name'])?>
                            </option>
                        <?php endif ?>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputPersonal" class="form-label">Описание</label>
                <textarea name="description" type="text" class="form-control" id="inputPersonal"><?=$valuesFromGet['description']?></textarea>
            </div>
            <div class="mb-3">
                <label for="inputCost" class="form-label">Цена</label>
                <input value="<?= $valuesFromGet['cost']?>" name="cost" type="number" min="0" max="10000000" class="form-control" id="inputCost">
            </div>
            <div class="">
                <button type="submit" class="btn btn-primary me-3">Применить фильтры</button>
                <a href="products.php" class="btn btn-danger">Сбросить фильтры</a>
            </div>
        </form>
        <table class="table table-hover">
            <thead>
            <tr class="row">
                <th scope="col" class="col-2">Фото</th>
                <th scope="col" class="col-3">Название</th>
                <th scope="col" class="col-2">Брэнд</th>
                <th scope="col" class="col-3">Описание</th>
                <th scope="col" class="col-2">Цена</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product):?>
                    <tr class="row">
                        <td class="col-2 d-block text-center">
                            <img height="100" src="catalog_images/<?=htmlspecialchars($product['img_path'])?>">
                        </td>
                        <td class="col-3"><?=htmlspecialchars($product['name'])?></td>
                        <td class="col-2"><?=htmlspecialchars($product['brand'])?></td>
                        <td class="col-3"><?=htmlspecialchars($product['description'])?></td>
                        <td class="col-2"><?=htmlspecialchars($product['cost'])?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>

<div class="footer pt-3">
    <div class="container-fluid">
        <div class="row bg-dark py-5">
            <div class="col-md-3">
                <h3>Персональные предложения и акции</h3>
                <div class="row">
                    <input type="email" name="email" class="email" placeholder="email">
                </div>
                <p class="fslink gray pt-2">
                    Подписываясь на рассылку, вы соглашаетесь на обработку <a href="#" class="linkh text-white " >персональных данных</a>
                </p>
                <a href="#"><img src="" alt="g"></a>
                <a href="#"><img src="" alt="f"></a>
                <a href="#"><img src="" alt="d"></a>
                <a href="#"><img src="" alt="f"></a>
                <a href="#"><img src="" alt="g"></a>
            </div>
            <div class="col-md-3">
                <h5>Компания фотосклад</h5>
                <h6><a href="#" class="linkh">О компании</a></h6>
                <h6><a href="#" class="linkh">Акции и скидки</a></h6>
                <h6><a href="#" class="linkh">Новости компании</a></h6>
                <h6><a href="#" class="linkh">Эксклюзивные обзоры фототехники</a></h6>
                <h6><a href="#" class="linkh">Вакансии компании</a></h6>
                <h6><a href="#" class="linkh">Пользовательское соглашение</a></h6>
                <h6><a href="#" class="linkh">Соглашение об обработке персональных данных</a></h6>
                <h6><a href="#" class="linkh">Terms and Conditions for client from EU</a></h6>
            </div>
            <div class="col-md-3">
                <h5>Помощь покупателю</h5>
                <h6><a href="#" class="linkh">Адреса магазинов и пунктов выдачи</a></h6>
                <h6><a href="#" class="linkh">Доставка и оплата</a></h6>
                <h6><a href="#" class="linkh">Гарантия, возврат и обмен</a></h6>
                <h6><a href="#" class="linkh">Покупки в кредит и рассрочку</a></h6>
                <h6><a href="#" class="linkh">Подарочные сертификаты</a></h6>
                <h6><a href="#" class="linkh">Не устраивает цена?</a></h6>
                <h6><a href="#" class="linkh">Вопрос-ответ (FAQ)</a></h6>
                <h6><a href="#" class="linkh">Личный кабинет</a></h6>
                <h6><a href="#" class="linkh">Скупка б/у фотоаппаратов</a></h6>
                <h6><a href="#" class="linkh">Помощь в Телеграмм</a></h6>
            </div>
            <div class="col-md-3">
                <h5>Информация</h5>
                <h6><a href="#" class="linkh">Отзывы о магазине</a></h6>
                <h6><a href="#" class="linkh">Оплата банковскими картами</a></h6>
                <h6><a href="#" class="linkh">Корпоративным клиентам</a></h6>
                <h6><a href="#" class="linkh">Поставщикам</a></h6>
                <h6><a href="#" class="linkh">Аренда площадей</a></h6>
                <h6><a href="#" class="linkh">СМИ о нас</a></h6>
                <h6><a href="#" class="linkh">Контакты</a></h6>
                <h6><a href="#" class="linkh">Обратная связь</a></h6>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <p class="gray">Все права защищены законом об авторском праве. Никакая часть содержимого сайта не может быть использована, репродуцирована, передана любым электронным, копировальным или другим способом без предварительного письменного разрешения владельца авторских прав.</p>
                </div>
                <div class="col-md-3">
                    <img src="images/visa.png" alt="gfds">
                    <img src="images/mk.png" alt="gfds">
                    <img src="images/mir.png" alt="gfds">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>