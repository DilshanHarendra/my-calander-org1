<?php

namespace App\Repositories\Event;

use App\Event;

class EventRepository implements EventRepositoryInterface
{
    public function getAll()
    {
        return Event::get();
    }

    public function getPaginated(array $requestData)
    {
        $limit  = isset($requestData['per_page']) ? $requestData['per_page'] : 10;
        return Event::paginate($limit);
    }

    public function get($id)
    {
        return Event::findorfail($id);
    }

    public function getByEmail($email)
    {
        return Event::where('creator_email',$email)->get();
    }

    public function create(array $requestData)
    {
        return Event::create($requestData);
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