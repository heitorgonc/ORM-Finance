<?php

// DTO Data Transfer Obj
namespace App\Core\Entity;

class Finance
{
    private $id;
    private $title;
    private $value;
    private $data;

    public function __construct($id = null, $title, $value, $data){
        $this->id = $id;
        $this->title = $title;
        $this->value = $value;
        $this->data = $data;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
}
