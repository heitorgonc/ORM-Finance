<?php

namespace App\Infra;

class Database
{
    public function listAll(string $tableName)
    {
        $fileObj = new \SplFileObject(__DIR__ . '/databaseFiles/' . $tableName . '.db');
        $fileObj->setFlags(\SplFileObject::READ_CSV | \SplFileObject::SKIP_EMPTY);
        $list = [];
        foreach ($fileObj as $obj) {
            if ($obj) {
                $list[] = $obj;
            }
        }

        return $list;
    }

    public function find(string $tableName, int $id)
    {
        $fileObj = new \SplFileObject(__DIR__ . '/databaseFiles/' . $tableName . '.db');
        $fileObj->setFlags(\SplFileObject::READ_CSV);
        foreach ($fileObj as $obj) {
            if ($obj[0] == $id) {
                return $obj;
            }
        }

        return null;
    }

    public function create(string $tableName, array $entity)
    {
        $fileObj = new \SplFileObject(__DIR__ . '/databaseFiles/' . $tableName . '.db', 'a');
        $fileObj->fputcsv($entity);

        return $entity;
    }

    public function update(string $tableName, array $entity)
    {
        $fileObj = new \SplFileObject(__DIR__ . '/databaseFiles/' . $tableName . '.db', 'r');
        $fileObj->setFlags(\SplFileObject::READ_CSV);
        $fileObj->setFlags(\SplFileObject::SKIP_EMPTY);

        $tmpFileObj = new \SplFileObject(__DIR__ . '/databaseFiles/' . $tableName . '.tmp', 'w');

        foreach ($fileObj as $obj) {
            if ($obj) {
                if ($obj[0] == $entity[0]) {
                    $tmpFileObj->fputcsv($entity);
                } else {
                    $tmpFileObj->fputcsv($obj);
                }
            }
        }

        $fileObj = null; // fclose()
        $tmpFileObj = null;
        rename(__DIR__ . '/databaseFiles/' . $tableName . '.tmp', __DIR__ . '/databaseFiles/' . $tableName . '.db');
    }

    public function delete(string $tableName, int $id)
    {
        $fileObj = new \SplFileObject(__DIR__ . '/databaseFiles/' . $tableName . '.db', 'r');
        $fileObj->setFlags(\SplFileObject::READ_CSV);

        $tmpFileObj = new \SplFileObject(__DIR__ . '/databaseFiles/' . $tableName . '.tmp', 'w');

        foreach ($fileObj as $obj) {
            if ($obj[0] != $id) {
                $tmpFileObj->fputcsv($obj);
            }
        }

        $fileObj = null; // fclose()
        $tmpFileObj = null;
        rename(__DIR__ . '/databaseFiles/' . $tableName . '.tmp', __DIR__ . '/databaseFiles/' . $tableName . '.db');
    }
}