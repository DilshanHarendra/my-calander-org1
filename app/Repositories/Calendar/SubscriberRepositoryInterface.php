<?php

namespace App\Repositories\Calendar;

interface SubscriberRepositoryInterface
{
    public function getAll();

    public function getPaginated(array $requestData);

    public function get($id);

    public function getByCalendar($email);

    public function create(array $requestData);

    public function update(array $requestData, $id);

    public function delete($id);

}