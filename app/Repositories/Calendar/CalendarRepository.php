<?php

namespace App\Repositories\Calendar;

use App\Calendar;

class CalendarRepository implements CalendarRepositoryInterface
{
    public function getAll()
    {
        return Calendar::get();
    }

    public function getPaginated(array $requestData)
    {
        $limit  = isset($requestData['per_page']) ? $requestData['per_page'] : 10;
        return Calendar::paginate($limit);
    }

    public function get($id)
    {
        return Calendar::findorfail($id);
    }

    public function getByEmail($email)
    {
        return Calendar::where('owner_email',$email)->get();
    }

    public function create(array $requestData)
    {
        return Calendar::create($requestData);
    }

    public function update(array $requestData, $id)
    {
        $entity = $this->get($id);
        $entity->update($requestData);
        return $entity;
    }

    public function delete($id)
    {
        $entity = $this->get($id);
        return $entity->delete();
    }


}