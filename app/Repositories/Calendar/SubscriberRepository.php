<?php

namespace App\Repositories\Calendar;

use App\Calendar\Subscriber;

class SubscriberRepository implements SubscriberRepositoryInterface
{
    public function getAll()
    {
        return Subscriber::get();
    }

    public function getPaginated(array $requestData)
    {
        $limit  = isset($requestData['per_page']) ? $requestData['per_page'] : 10;
        return Subscriber::paginate($limit);
    }

    public function get($id)
    {
        return Subscriber::findorfail($id);
    }

    public function getByCalendar($calendar)
    {
        return Subscriber::where('calendar_id',$calendar->id)->get();
    }

    public function create(array $requestData)
    {
        return Subscriber::create($requestData);
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