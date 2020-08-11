<?php


namespace App\Repositories\Event;


interface EventRepositoryInterface
{
    public function getAllData();

    public function getPaginatedData(array $requestData);

    public function getDataById($id);

    public function getDataByEmail($email);

    public function createData(array $requestData);

    public function updateData(array $requestData, $id);

    public function deleteData($id);

}