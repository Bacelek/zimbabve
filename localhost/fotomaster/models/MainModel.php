<?php

namespace models;

use services\db;

class MainModel
{

    public $errorArray;

    public function save(){
        $array = $this->constructData();
        $db = db::getInstance();
        $sql = "INSERT INTO ".static::getTableName()." (". $array["dbColumns"] .") VALUES (". $array["params"] .")";
        $db->query($sql, $array["values"]);
        $this->errorArray = $db->getError();
    }
    public function update(){
        $array = $this->constructData();
        $db = db::getInstance();
        $sql = "UPDATE ".static::getTableName(). " SET ".$array["updateColumns"]." WHERE id = :id";
        $db->query($sql, $array["values"]);
        $this->errorArray = $db->getError();
    }
    public function getById($id){
        $db = db::getInstance();
        $sql = "SELECT * FROM ".static::getTableName()." WHERE id = :id";
        $result = $db->query($sql, ["id" => $id],static::class);
        return $result ? $result[0] : null;
    }

    public function getAll(){
        $db = db::getInstance();
        $sql = "SELECT * FROM ".static::getTableName();
        $result = $db->query($sql,[],static::class);
        return $result ? $result : null;
    }

    public function delete($id){
        $db = db::getInstance();
        $sql = "DELETE FROM ".static::getTableName()." WHERE id = :id";
        $db->query($sql, ["id" => $id]);
    }

    public function addError($error)
    {
        $this->errorArray = $error;
    }
    public function getError()
    {
        return $this->errorArray;
    }
    public function constructData(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        $valuePart = [];
        $dbColumns = [];
        $params = [];
        $updateColumns = [];
        foreach ($properties as $property) {
            if($property->getName()!="errorArray")
            {
                $propertyName = $property->getName();
                $propertyValue = $this->$propertyName;

                $params [] = ":" . $propertyName;
                $valuePart[":" . $propertyName] = $propertyValue;
                $dbColumns[] = $propertyName;

                $updateColumns [] = $propertyName . "=:" . $propertyName;
            }
        }
        $builtData["values"] = $valuePart;
        $builtData["dbColumns"] = implode(",", $dbColumns);
        $builtData["params"] = implode(",", $params);
        $builtData["updateColumns"] = implode(",", $updateColumns);
        return $builtData;
    }
}