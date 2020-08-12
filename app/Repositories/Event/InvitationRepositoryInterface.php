<?php

namespace App\Repositories\Event;

interface InvitationRepositoryInterface
{
    public function getAllData();

    public function getPaginatedData(array $requestData);

    public function getDataById($id);

    public function getDataByEvent($event);

    public function createData(array $requestData,$event);

    public function deleteData($id);

}