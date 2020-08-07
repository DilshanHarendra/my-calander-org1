<?php

namespace App\Repositories\Event;

use App\Event\Registration;

class RegistrationRepository implements RegistrationRepositoryInterface
{
    public function getAll()
    {
        return Registration::get();
    }

    public function getPaginated(array $requestData)
    {
        $limit  = isset($requestData['per_page']) ? $requestData['per_page'] : 10;
        return Registration::paginate($limit);
    }

    public function get($id)
    {
        return Registration::findorfail($id);
    }

    public function getByEvent($event)
    {
        return Registration::where('event_id',$event->id)->get();
    }

    public function create(array $requestData)
    {
        return Registration::create($requestData);
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