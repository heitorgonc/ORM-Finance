<?php

namespace App\Infra\Repository;

use App\Core\Entity\Finance;
use App\Infra\Database;

class FinanceRepository
{
    private $database;
    private $tableName;

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tableName = 'finance';
    }

    public function listAllGuests()
    {
        $list = [];
        /**
         * batabase --> obj --> [ 0: id; 1: title; 2: value; 3: date ]
         */
        foreach ($this->database->listAll($this->tableName) as $obj) {
            $finance = new Finance($obj[0], $obj[1], $obj[2], $obj[3]);
            $list[] = $finance;
        }

        return $list;
    }

    public function find(int $id)
    {
        $obj = $this->database->find($this->tableName, $id);
        if (!$obj) {
            return null;
        }

        return new Finance($obj[0], $obj[1], $obj[2], $obj[3]);
    }

    public function create(Finance $finance)
    {
        if (!$finance->getId()) {
            $finance->setId(rand(100, 999));
        }

        /**
         * batabase --> obj --> [ 0: id; 1: title; 2: value, 3: date ]
         */
        $this->database->create($this->tableName, [$finance->getId(), $finance->getTitle(), $finance->getValue(), $finance->getDate()]);
    }

    public function update(Finance $finance)
    {
        /**
         * batabase --> obj --> [ 0: id; 1: title; 2: value; 3: date ]
         */
        $this->database->update($this->tableName, [$finance->getId(), $finance->getTitle(), $finance->getValue(), $finance->getDate()]);
    }

    public function delete(Finance $finance)
    {
        $this->database->delete($this->tableName, $finance->getId());
    }
}