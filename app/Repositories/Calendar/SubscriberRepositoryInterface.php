<?php

namespace App\Repositories\Calendar;

interface SubscriberRepositoryInterface
{
    public function getAllData();

    public function getPaginatedData(array $requestData);

    public function getDataById($id);

    public function getDataByCalendar($calendar);

    public function createData(array $requestData,$calendar);

    public function deleteData(array $requestData,$calendar);

}