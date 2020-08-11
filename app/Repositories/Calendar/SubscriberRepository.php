<?php

namespace App\Repositories\Calendar;

use App\Models\Calendar\Subscriber;

class SubscriberRepository implements SubscriberRepositoryInterface
{
    public function getAllData()
    {
        return Subscriber::get();
    }

    public function getPaginatedData(array $requestData)
    {
        $limit  = isset($requestData['per_page']) ? $requestData['per_page'] : 10;
        return Subscriber::paginate($limit);
    }

    public function getDataById($id)
    {
        return Subscriber::findorfail($id);
    }

    public function getDataByCalendar($calendar)
    {
        return Subscriber::where('calendar_id',$calendar->id)->get();
    }

    public function createData(array $requestData)
    {
        return Subscriber::create($requestData);
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