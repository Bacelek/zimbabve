<?php

namespace models\service;

use models\MainModel;

class Service extends MainModel
{
    public $id;
    public $name;
    public $cost;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    static function getTableName()
    {
        return "service";
    }
}