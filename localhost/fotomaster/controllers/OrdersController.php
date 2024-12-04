<?php

namespace controllers;

use models\customers\Customer;
use models\photogragher\Photographer;
use models\service\Service;
use models\typePhotography\TypePhotography;
use models\orders\Orders;
class OrdersController extends MainController
{
    public function __construct()
    {
        parent::__construct(Orders::class);
    }
    public function actionAdd(): void
    {
        $modelName = strtolower((new \ReflectionClass($this->model))->getShortName());

        $customers = (new Customer())->getAll();
        $photogragher = (new Photographer())->getAll();
        $service = (new Service())->getAll();
        $typephotography = (new TypePhotography())->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemClass = get_class($this->model);
            $item = new $itemClass;

            $errors = $this->validateFields($this->getRequiredFields(), $_POST);

            if (empty($errors)) {
                $this->setModelProperties($item, $_POST);
                var_dump($item);
                $item->save();

                if (empty($item->getError())) {
                    header('Location: /fotomaster/' . $modelName);
                    exit();
                } else {
                    $data[0]['error'] = $item->getError();
                }
            } else {
                $data[0]['error'] = $errors;
            }
        }

        $data['customers'] = $customers;
        $data['photogragher'] = $photogragher;
        $data['service'] = $service;
        $data['typephotography'] = $typephotography;

        include 'templates/' . $modelName . '/add.php';
    }

    public function actionEdit($id = null): void
    {
        $modelName = strtolower((new \ReflectionClass($this->model))->getShortName());

        $customers = (new Customer())->getAll();
        $photogragher = (new Photographer())->getAll();
        $service = (new Service())->getAll();
        $typephotography = (new TypePhotography())->getAll();

        $item = $this->model->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->validateFields($this->getRequiredFields(), $_POST);

            if (empty($errors)) {
                $this->setModelProperties($item, $_POST);
                $item->update();

                if (empty($item->getError())) {
                    header('Location: /fotomaster/' . $modelName);
                    exit();
                } else {
                    $data[0]['error'] = $item->getError();
                }
            } else {
                $data[0]['error'] = $errors;
            }
        }

        $data['currentItem'] = $item;
        $data['customers'] = $customers;
        $data['photogragher'] = $photogragher;
        $data['service'] = $service;
        $data['typephotography'] = $typephotography;

        include 'templates/' . $modelName . '/edit.php';
    }

    public function setModelProperties($item, $postData, $fileData = null): void
    {
        $item->setPhotographerId($postData['setPhotographerId']);
        $item->setCustomerId($postData['setCustomerId']);
        $item->setServiceId($postData['setServiceId']);
        $item ->setTypePhotographyId($postData['setTypePhotographyId']);
        $item->setDate($postData['setDate']);

        $serviceCost = (new Service())->getById($postData['setServiceId'])->getCost();

        $typePhotographyCost = (new TypePhotography())->getById($postData['setTypePhotographyId'])->getCost();

        $Cost = $serviceCost + $typePhotographyCost;

        $item->setCost($Cost);
    }

    public function getRequiredFields(): array
    {
        return ['setPhotographerId','setCustomerId', 'setServiceId','setTypePhotographyId','setDate'];
    }
}
