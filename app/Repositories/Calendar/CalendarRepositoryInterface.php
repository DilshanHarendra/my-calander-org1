<?php


namespace App\Repositories\Calendar;

interface CalendarRepositoryInterface
{
    public function getAll();

    public function getPaginated(array $requestData);

    public function get($id);

    public function getByEmail($email);

    public function create(array $requestData);

    public function update(array $requestData, $id);

    public function delete($id);

}