<?php

namespace controllers;

use models\typePhotography\TypePhotography;

class TypePhotographyController extends MainController
{
    public function __construct()
    {
        parent::__construct(TypePhotography::class);
    }

    public function setModelProperties($item, $postData, $fileData = null): void
    {
        $item->setName($postData['setTypeName']);
        if(filter_var($postData['setTypeCost'], FILTER_VALIDATE_INT) !== false){
            $item->setCost($postData['setTypeCost']);
        }
        else{
            $item->addError("Цена - целое число");
        }
    }

    public function getRequiredFields(): array
    {
        return ['setTypeName', 'setTypeCost'];
    }
}
