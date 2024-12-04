<?php

namespace controllers;

use models\customers\Customer;

class CustomerController extends MainController
{
    public function __construct()
    {
        parent::__construct(Customer::class);
    }

    public function setModelProperties($item, $postData, $fileData = null): void
    {
        $item->setFirstName($postData['setCustomerFirstName']);
        $item->setLastName($postData['setCustomerLastName']);
        $item->setNumber($postData['setCustomerNumber']);
    }

    public function getRequiredFields(): array
    {
        return ['setCustomerFirstName', 'setCustomerLastName', 'setCustomerNumber'];
    }
}
