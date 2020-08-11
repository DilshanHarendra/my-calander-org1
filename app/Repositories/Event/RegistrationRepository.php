<?php

namespace App\Repositories\Event;

use App\Models\Event\Registration;

class RegistrationRepository implements RegistrationRepositoryInterface
{
    public function getAllData()
    {
        return Registration::get();
    }

    public function getPaginatedData(array $requestData)
    {
        $limit  = isset($requestData['per_page']) ? $requestData['per_page'] : 10;
        return Registration::paginate($limit);
    }

    public function getDataById($id)
    {
        return Registration::findorfail($id);
    }

    public function getDataByEvent($event)
    {
        return Registration::where('event_id',$event->id)->get();
    }

    public function createData(array $requestData)
    {
        return Registration::create($requestData);
    }

    public function updateData(array $requestData, $id)
    {
        $entity = $this->getDataById($id);
        $entity->update($requestData);
        return $entity;
    }

    public function deleteData($id)
    {
        $entity = $this->getDataById($id);
        return $entity->delete();
    }

}