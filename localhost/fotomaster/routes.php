<?php


return [
    '#^/fotomaster/customer$#' => [controllers\CustomerController::class, 'actionList'],
    '#^/fotomaster/customer/add$#' => [controllers\CustomerController::class, 'actionAdd'],
    '#^/fotomaster/customer/(\d+)/edit$#' => [controllers\CustomerController::class, 'actionEdit'],
    '#^/fotomaster/customer/(\d+)/delete$#' => [controllers\CustomerController::class, 'actionDelete'],

    '#^/fotomaster/service/add$#' => [controllers\ServiceController::class, 'actionAdd'],
    '#^/fotomaster/service/(\d+)/edit$#' => [controllers\ServiceController::class, 'actionEdit'],
    '#^/fotomaster/service/(\d+)/delete$#' => [controllers\ServiceController::class, 'actionDelete'],
    '#^/fotomaster/service#' => [controllers\ServiceController::class, 'actionList'],

    '#^/fotomaster/typephotography/add$#' => [controllers\TypePhotographyController::class, 'actionAdd'],
    '#^/fotomaster/typephotography/(\d+)/edit$#' => [controllers\TypePhotographyController::class, 'actionEdit'],
    '#^/fotomaster/typephotography/(\d+)/delete$#' => [controllers\TypePhotographyController::class, 'actionDelete'],
    '#^/fotomaster/typephotography#' => [controllers\TypePhotographyController::class, 'actionList'],

    '#^/fotomaster/photographer/add$#' => [controllers\PhotographerController::class, 'actionAdd'],
    '#^/fotomaster/photographer/(\d+)/edit$#' => [controllers\PhotographerController::class, 'actionEdit'],
    '#^/fotomaster/photographer/(\d+)/delete$#' => [controllers\PhotographerController::class, 'actionDelete'],
    '#^/fotomaster/photographer#' => [controllers\PhotographerController::class, 'actionList'],

    '#^/fotomaster/orders/add$#' => [controllers\OrdersController::class, 'actionAdd'],
    '#^/fotomaster/orders/(\d+)/edit$#' => [controllers\OrdersController::class, 'actionEdit'],
    '#^/fotomaster/orders/(\d+)/delete$#' => [controllers\OrdersController::class, 'actionDelete'],
    '#^/fotomaster/orders#' => [controllers\OrdersController::class, 'actionList'],

    '#^#' => [controllers\MainController::class, 'actionHeader'],
];

