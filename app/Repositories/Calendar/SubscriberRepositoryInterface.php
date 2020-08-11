<?php

namespace App\Repositories\Calendar;

interface SubscriberRepositoryInterface
{
    public function getAllData();

    public function getPaginatedData(array $requestData);

    public function getDataById($id);

    public function getDataByCalendar($email);

    public function createData(array $requestData);

    public function updateData(array $requestData, $id);

    public function deleteData($id);

}