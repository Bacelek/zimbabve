<?php

namespace models\orders;

use models\MainModel;

class Orders extends MainModel
{
    protected $id;
    protected $photographer_id;
    protected $customer_id;
    protected $service_id;
    protected $type_photograpgy_id;
    protected $date;
    protected $cost;
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getPhotographerId()
    {
        return $this->photographer_id;
    }
    public function setPhotographerId($photographer_id): void
    {
        $this->photographer_id = $photographer_id;
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function setCustomerId($customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    public function getServiceId()
    {
        return $this->service_id;
    }

    public function setServiceId($service_id): void
    {
        $this->service_id = $service_id;
    }

    public function getTypePhotographyId()
    {
        return $this->type_photograpgy_id;
    }

    public function setTypePhotographyId($type_photograpgy_id): void
    {
        $this->type_photograpgy_id = $type_photograpgy_id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }
    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($cost): void
    {
        $this->cost = $cost;
    }
    static function getTableName()
    {
        return "orders";
    }
}