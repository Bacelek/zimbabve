<?php

namespace controllers;

use models\service\Service;

    class ServiceController extends MainController
{
    public function __construct()
    {
        parent::__construct(Service::class);
    }

    public function setModelProperties($item, $postData, $fileData = null): void
    {
        $item->setName($postData['setServiceName']);
        if(filter_var($postData['setServiceCost'], FILTER_VALIDATE_INT) !== false){
            $item->setCost($postData['setServiceCost']);
        }
        else{
            $item->addError("Цена - целое число");
        }
    }

    public function getRequiredFields(): array
    {
        return ['setServiceName', 'setServiceCost'];
    }
}
