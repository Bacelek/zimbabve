<?php
    require_once __DIR__ . '/src/helperFunctions.php';
    $user = checkUser();
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
                <ul class="nav justify-content-between" >
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
                    <li class="nav-item" >
                        <a class="nav-link " href="products.php">секретная</a>
                    </li>
                    <li class="nav-item " >
                        <?php if(!authBlock()){ ?>
                        <div>
                            <p class="m-0">Вы не авторизованы</p>
                            <p><a href="/LR/login.php">Ввести логин и пароль</a> или <a href="/LR/register.php">зарегистрироваться</a></p>
                        </div>
                        <?php } else{?>
                            <div>
                                <p>Вы вошли как <?php echo $user['email'] ?>.</p>
                                <p>
                                <form action="src/logout.php" method="post">
                                    <button>Выйти.</button>
                                </form></p>
                            </div>
                        <?php }?>
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
