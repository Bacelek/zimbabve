<?php

namespace controllers;

use models\MainModel;
use services\db;

class MainController
{
    public $model;

    public function __construct($modelClass = MainModel::class){
        $this->model = new $modelClass;
    }
    public function actionList(): void
    {
//        var_dump($_SERVER);
        $items = $this->model->getAll();
        include 'templates/' . (new \ReflectionClass($this->model))->getShortName() . '/list.php';
    }

    public function actionAdd(): void
    {
        $modelName = strtolower((new \ReflectionClass($this->model))->getShortName());

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item = new $this->model;

            $errors = $this->validateFields($this->getRequiredFields(), $_POST, $_FILES);

            if (empty($errors)) {
                $this->setModelProperties($item, $_POST, $_FILES);
//                var_dump($_FILES);
                if (empty($item->getError())) {
                    $item->save();
                    header('Location: /fotomaster/' . $modelName);
                    exit();
                } else {
                    $errors[] = $item->getError();
                    $data[0]['error'] = $errors;
                }
            } else {
                $data[0]['error'] = $errors;
            }
        }
        include 'templates/' . $modelName . '/add.php';
    }


    public function actionEdit($id = null): void
    {
        $modelName = strtolower((new \ReflectionClass($this->model))->getShortName());
        $item = $this->model->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->validateFields($this->getRequiredFields(), $_POST, $_FILES);

            if (empty($errors)) {
                $this->setModelProperties($item, $_POST, $_FILES);
                if (empty($item->getError())) {
                    $item->update();
                    header('Location: /fotomaster/' . $modelName);
                    exit();
                } else {
                    $errors[] = $item->getError();
                    $data[1]['error'] = $errors;
                }
            } else {
                $data[1]['error'] = $errors;
            }
            $data[0]['currentItem'] = $item;
        } else {
            $data[0]['currentItem'] = $item;
        }
        include 'templates/' . $modelName . '/edit.php';
    }

    public function actionDelete($id = null): void
    {
        $this->model->delete($id);
        $modelName = strtolower((new \ReflectionClass($this->model))->getShortName());
        header('Location: /fotomaster/' . $modelName);
        exit();
    }
    protected function setModelProperties($item, $postData, $fileData = null): void
    {}

    public function getRequiredFields(): array
    {
        return [];
    }

    public function validateFields(array $requiredFields, array $postData, array $fileData = null): array
    {
        $errors = [];
        foreach ($requiredFields as $field) {
            if (str_starts_with($field, 'file:')) {
                $fileField = substr($field, 5);
                if (empty($fileData[$fileField]) || $fileData[$fileField]['error'] != UPLOAD_ERR_OK) {
                    $errors[] = "Поле \"" . $fileField . "\" обязательно для загрузки.";
                }
            } else {
                if (empty($postData[$field])) {
                    $errors[] = "Поле \"" . $field . "\" обязательно для заполнения.";
                }
            }
        }
        return $errors;
    }

    public function getDetailedData()
    {
        $db = db::getInstance();
        $sql = "SELECT
            orders.id AS orders_id,
            orders.date,
            orders.cost,
            customer.first_name AS customer_first_name,
            customer.last_name AS customer_last_name,
            customer.number AS customer_number,
            photographer.first_name AS photographer_first_name,
            photographer.last_name AS photographer_last_name,
            photographer.image AS photographer_image,
            service.name AS service_name,
            service.cost AS service_cost,
            type_photography.name AS type_photography_name,
            type_photography.cost AS type_photography_cost,
        FROM orders
        LEFT JOIN customer ON orders.customer_id = customer.id
        LEFT JOIN photographer ON photographer.photographer_id = photographer.id
        LEFT JOIN service ON orders.service_id = service.id
        LEFT JOIN type_photography ON orders.type_photograpgy_id = type_photography.id";

        return $db->query($sql,[]);
    }

    public function actionHeader(): void
    {
        require_once 'templates/inc/header.html';
    }

}